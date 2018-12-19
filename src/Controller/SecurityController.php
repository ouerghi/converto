<?php

namespace App\Controller;

use App\Entity\Admin;
use App\Form\UserType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends AbstractController
{
	/**
	 * @Route("/login", name="login")
	 * @param AuthenticationUtils $authenticationUtils
	 *
	 * @return Response
	 */
    public function login( AuthenticationUtils $authenticationUtils): Response
    {
    	$error = $authenticationUtils->getLastAuthenticationError();
    	$lastUsername = $authenticationUtils->getLastUsername();

        return $this->render( 'security/login.html.twig', array(
        	'last_username' => $lastUsername,
	        'error' => $error
        ));
    }

	/**
	 * @Route("/register", name="register")
	 * @param Request $request
	 *
	 * @param UserPasswordEncoderInterface $passwordEncoder
	 *
	 * @param EntityManagerInterface $em
	 *
	 * @return \Symfony\Component\HttpFoundation\Response
	 * @throws \Exception
	 */
	public function register(Request $request, UserPasswordEncoderInterface $passwordEncoder, EntityManagerInterface $em ): Response
	{
		$user = new Admin();
		$form = $this->createForm(UserType::class, $user);
		$form->handleRequest($request);
		if ($form->isSubmitted() && $form->isValid())
		{
			$password = $passwordEncoder->encodePassword($user, $user->getPassword());
			$user->setPassword($password);
			$user->setRoles('ROLE_ADMIN');
			$em->persist($user);
			$em->flush();

			$this->addFlash('success', 'L\'utilisateur est bien ajouté à la base de donnée');
			return $this->redirectToRoute('register');
	}
		return $this->render( 'security/register.html.twig', array(
			'form' => $form->createView()
		));
	}

	/**
	 * @Route("/logout", name="logout")
	 */
	public function logout(): void {}
}
