<?php

namespace App\Controller;

use App\Entity\Agent;
use App\Entity\Fiche;
use App\Form\EditFicheType;
use App\Form\FicheType;
use App\Repository\FicheRepository;
use App\Services\SendMail;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class FicheController
 * @package App\Controller
 * @Route("/fiche")
 * @Security("is_fully_authenticated()")
 */
class FicheController extends AbstractController
{

	/**
	 * @param Fiche $fiche
	 *
	 * @param EntityManagerInterface $entity_manager
	 *
	 * @param Request $request
	 *
	 * @return JsonResponse
	 * @Route("/seen/{id}", name="seen")
	 */
	public function isRecordingSeen(Fiche $fiche, EntityManagerInterface $entity_manager, Request $request): JsonResponse
	{
		$message = 'error';
		if ($request->isXmlHttpRequest())
		{
			$fiche->setIsSeen(true);
			$entity_manager->flush();
			$message = 'success';

		}
		return new JsonResponse($message);
	}

	/**
	 * @Route("/new", name="fiche.new")
	 * @param Request $request
	 *
	 * @param EntityManagerInterface $em
	 *
	 * @param SendMail $mail
	 *
	 * @return Response
	 * @throws \Exception
	 * @IsGranted("ROLE_AGENT", message="Vous n'avez pas le droit à cet action")
	 */
    public function addFiche(Request $request, EntityManagerInterface $em, SendMail $mail): Response {

	    /** @var Agent $agent */
	    $agent = $this->get('security.token_storage')->getToken()->getUser();
    	$fiche = new Fiche();
    	$form  = $this->createForm(FicheType::class, $fiche, array('agent' => $agent));
    	$form->handleRequest($request);
    	if ($form->isSubmitted() && $form->isValid())
	    {
	    	$client = $form['client']->getData();
	    	$fiche->setAgent($agent);
	    	$em->persist($fiche);
	    	$em->flush();
	    	$mail->sendMailClient($client);
	    	$this->addFlash('success', 'La fiche est bien ajouté');
	    	return $this->redirectToRoute('admin');
	    }

    	return $this->render('fiche/new.html.twig', array(
    		'form' => $form->createView(),
	    ));
    }
	/**
	 * @Route("/{id}", name="fiche.show", methods={"GET"})
	 * @param Fiche $fiche
	 * @return Response
	 */
	public function show(Fiche $fiche): Response
	{
		return $this->render('fiche/show.html.twig', ['fiche' => $fiche]);
	}
	/**
	 * @Route("/{id}/edit", name="fiche.edit", methods={"GET","POST"})
	 * @param Request $request
	 * @param Fiche $fiche
	 *@IsGranted("ROLE_ADMIN", message="Vous n'avez pas le droit à cet action")
	 * @return Response
	 */
	public function edit(Request $request, Fiche $fiche): Response
	{
		$form = $this->createForm(EditFicheType::class, $fiche);
		$form->handleRequest($request);

		if ($form->isSubmitted() && $form->isValid()) {


			$this->getDoctrine()->getManager()->flush();
			$this->addFlash('success', 'La fiche du client à été modifié avec succés');

			return $this->redirectToRoute('admin');
		}

		return $this->render('fiche/edit.html.twig', [
			'fiche' => $fiche,
			'form' => $form->createView(),
		]);
	}

	/**
	 * @Route("/{id}", name="fiche.delete", methods={"DELETE"})
	 * @param Request $request
	 * @param Fiche $fiche
	 * @IsGranted("ROLE_ADMIN", message="Vous n'avez pas le droit à fire cet action")
	 * @return Response
	 */
	public function delete(Request $request, Fiche $fiche): Response
	{
		if ($this->isCsrfTokenValid('delete'.$fiche->getId(), $request->request->get('_token'))) {
			$entityManager = $this->getDoctrine()->getManager();
			$entityManager->remove($fiche);
			$entityManager->flush();
		}
		$this->addFlash('success', 'La fiche du client à été supprimé avec succés');
		return $this->redirectToRoute('admin');
	}


}
