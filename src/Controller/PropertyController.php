<?php

namespace App\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Entity\Property;
use App\Repository\PropertyRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\SearchProperty;
use App\Form\SearchPropertyType;
use App\Entity\Contact;
use App\Form\ContactType;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use App\Notification\ContactNotification;
//use Symfony\Component\Form\Extension\Core\Type\SearchPropertyType;
//use Symfony\Component\HttpFoundation\File\UploadedFile;
//use Symfony\Component\HttpFoundation\File\Exception\FileException;




class PropertyController extends AbstractController
{

/**
 *@var PropertyRepository
 */

	public function __construct(PropertyRepository $repository)
	{
		$this->repository = $repository;
	}

/**
 *@route("/biens", name="property.index") 
 *@return Response
 */
	
	function index(PaginatorInterface $paginator, Request $request)
	{
		
			$search = new SearchProperty();
			$form = $this->createForm(SearchPropertyType::class, $search);
			$form->handleRequest($request);

			$properties = $paginator->paginate(
				$this->repository->findAllVisibleQuery($search),
				$request->query->getInt('page', 1),
				12
			);
		return $this->render('property/index.html.twig', [
			'current_menu' => 'properties',
			'properties' => $properties,
			'form' => $form->createView()
	]);
	}

/**
 *@route("/biens/{slug}-{id}", name="property.show", requirements={"slug": "[a-z0-9\-]*"}) 
 *@param Property $property
 *@return Response
 */
	public function show(Property $property, string $slug, Request $request, ContactNotification $notification): Response
	{
		//Important for the referencement. if someone change the slug our id, it will redirect
		$contact = new Contact();
		$contact->setProperty($property);
		$form = $this->createForm(ContactType::class, $contact);

		$form->handleRequest($request);

		if ($form->isSubmitted() && $form->isValid()) {
			$notification->notify($contact);
			$this->addFlash('success', 'Votre message a bien été envoyé !');
			return $this->redirectToRoute('property.show', [
			'id' => $property->getId(),
			'slug' => $property->getSlug()
			]);
		}

		if ($property->getSlug() !== $slug) 
		{
			return $this->redirectToRoute('property.show', [
				'id' => $property->getId(),
				'slug' => $property->getSlug()
			], 301);
		}
		 return $this->render('property/show.html.twig', [
			'property' => $property,
			'current_menu' => 'properties',
			'form' => $form->createView()
	]);
	}
}