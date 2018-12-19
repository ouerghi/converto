<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Form\ContactType;
use App\Services\SendMail;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
	/**
	 * @Route("/", name="homepage")
	 * @param Request $request
	 *
	 * @param SendMail $mailer
	 *
	 * @return \Symfony\Component\HttpFoundation\Response
	 * @throws \Twig_Error_Loader
	 * @throws \Twig_Error_Runtime
	 * @throws \Twig_Error_Syntax
	 */
	public function indexAction(Request $request, SendMail $mailer)
	{
		$contact = new Contact();
		$form = $this->createForm(ContactType::class, $contact);
		$form->handleRequest($request);
		if ($form->isSubmitted() && $form->isValid())
		{
			$mailer->sendMail($contact);
			$this->addFlash('notice', 'Votre Message à été bien envoyé, vous serez contacté dans les plus brefs délais ');
			return $this->redirectToRoute('homepage', ['_fragment' => 'contact']);
		}


		// replace this example code with whatever you need
		return $this->render('home/index.html.twig', array(
			'form' => $form->createView()
		));
	}
}
