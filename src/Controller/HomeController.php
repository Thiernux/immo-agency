<?php

namespace App\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Repository\PropertyRepository;
use App\Entity\Property;



class HomeController extends AbstractController
{

	/**
	*@Route("/", name="home")
	*@param PropertyRepository $repository
	*@return Response
	*/

	public function index(PropertyRepository $repository): Response

	{
		//$repository = $this->getDoctrine()->getRepository(Property::class);
		$properties = $repository->findLatest();
		return $this->render('pages/home.html.twig', [
			'properties' => $properties
		]);
	}
}