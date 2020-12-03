<?php

namespace App\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Entity\Property;
use App\Repository\PropertyRepository;





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
	
	function index()
	{
		/**$property =  new Property();
		$property->setTitle('Mon premier bien')
			->setPrice(200000)
			->setCity('Grenoble')
			->setAdress(' 27 Rue Marcel Bourette')
			->setRooms(4)
			->setBedrooms(3)
			->setDescription('Une petite description')
			->setSurface(60)
			->setFloor(4)
			->setHeat(1)
			->setPostalCode('38100');
			$em = $this->getDoctrine()->getManager();
			$em->persist($property);
			$em->flush();**/

			/**$repository = $this->getDoctrine()->getRepository(Property::class);
			dump($repository);**/

			/*$property = $this->repository->findAllVisible();
			dd($property);*/
		return $this->render('property/index.html.twig', [
			'current_menu' => 'properties'
	]);
	}

/**
 *@route("/biens/{slug}-{id}", name="property.show", requirements={"slug": "[a-z0-9\-]*"}) 
 *@param Property $property
 *@return Response
 */
	public function show(Property $property, string $slug): Response
	{
		if ($property->getSlug() !== $slug) {
			return $this->redirectToRoute('property.show', [
				'id' => $property->getId(),
				'slug' => $property->getSlug()
			], 301);
		}
		return $this->render('property/show.html.twig', [
			'property' => $property,
			'current_menu' => 'properties'
	]);
	}
}