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
//use Symfony\Component\Form\Extension\Core\Type\SearchPropertyType;





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
	public function show(Property $property, string $slug): Response
	{
		//Important for the referencement. if someone change the slug our id, it will redirect
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