<?php
namespace App\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
//use Doctrine\Common\Persistence\ObjectManager; DEPRECATED, 
use Doctrine\ORM\EntityManagerInterface;		// now we use  Doctrine\ORM\EntityManagerInterface
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Property;
use App\Repository\PropertyRepository;
use App\Form\PropertyType;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\UploadedFile;





class AdminPropertyController extends AbstractController
{
	/**
 	* @var PropertyRepository
 	*/
	private $repository;

	/**
 	* @var EntityManagerInterface
 	*/
	private $em;
	
	function __construct(PropertyRepository $repository, EntityManagerInterface $em)
	{
		$this->repository = $repository;
		$this->em = $em;
	}

	/**
	*@Route("/admin", name="admin.property.index")
 	* @return \Symfony\Component\HttpFoundation\Response;
 	*/

	function index()
	{
		$properties = $this->repository->findAll();
		return $this->render('admin/property/index.html.twig', compact('properties'));
	}

	/**
	*@Route("/admin/property/new.html.twig", name="admin.property.new")
 	*/

 	function new(Request $request)	// FORM FOR CREATE NEW PROPERTY
 	{
 		$property = new Property();
 		$form = $this->createForm(PropertyType::class, $property);
		$form->handleRequest($request);	//handling the form

		if ($form->isSubmitted() && $form->isValid()) //cheick if the form is send and is valid
		{
			$this->em->persist($property); // HERE WE NEED TO PERSIST BEFORE FLUSHING, BECAUSE THE DATA DO NOT EXIST IN DB
			$this->em->flush();
			$this->addFlash('success', 'Bien ajouté avec succès !');
			$imageFile = $form->get('image')->getData(); // Uploading the file

			if($imageFile)
			{
				$originalFileName = pathinfo($imageFile->getClientOriginalName(), PATHINFO_FILENAME);
				$safeFileName = transliterator_transliterate('Any-Latin; Latin-ASCII; [^A-Za-z0-9_] remove; Lower()', $originalFilename);
				$newFilename = $safeFilename.'-'.uniqid().'.'.$imageFile->guessExtension();
				try {
                    $imageFile->move(
                        $this->getParameter('images_directory'),
                        $newFilename
                    );
                } catch (FileException $e) {
                    // ... handle exception if something happens during file upload
                }

                // updates the 'brochureFilename' property to store the PDF file name
                // instead of its contents
                $product->setBrochureFilename($newFilename);
			}
			return $this->redirectToRoute('admin.property.index');
		}


		return $this->render('admin/property/new.html.twig', [
			'property' => $property,
			'form' => $form->createView()
		]);


 	}


	/**
	*@Route("/admin/property/{id}", name="admin.property.edit", methods="GET|POST")
	*@param Property $property
	*@param Property $property
 	* @return \Symfony\Component\HttpFoundation\Response
 	*/

	function edit(Property $property, Request $request)
	{
		$form = $this->createForm(PropertyType::class, $property);
		$form->handleRequest($request);	//handling the form

		if ($form->isSubmitted() && $form->isValid()) //cheick if the form is send and is valid
		{
			$this->em->flush();
			$this->addFlash('success', 'Bien modifié avec succès !');
			return $this->redirectToRoute('admin.property.index');
		}
		return $this->render('admin/property/edit.html.twig', [
			'property' => $property,
			'form' => $form->createView()
		]);

	}

	/**
	*@Route("/admin/property/{id}", name="admin.property.delete", methods="DELETE")
	*@param Property $property
	*@param Request $request
	*@return \Symfony\Component\HttpFoundation\RedirectResponse
	*/

	public function delete(Property $property, Request $request)
	{
		if ($this->isCsrfTokenValid('delete', $property->getId(), $request->get('_token'))) 
		{
			
			$this->em->remove($property);
			$this->em->flush();
			$this->addFlash('success', 'Bien supprimé avec succès !');			
		}
		
		return $this->redirectToRoute('admin.property.index');
		
	}
}