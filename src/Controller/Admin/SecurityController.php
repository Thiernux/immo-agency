<?php
namespace App\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\User;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

/**
 * 
 */
class SecurityController extends AbstractController
{

 /**
 * @Route("/login", name="login")
 *
 */
	
	public function login(AuthenticationUtils $AuthenticationUtils)
	{
		$lastUsername = $AuthenticationUtils->getLastUsername();
		$error = $AuthenticationUtils->getLastAuthenticationError();
		return $this->render('security/login.html.twig', [
			'last_username' => $lastUsername,
			'error' => $error
		]);
	}
}