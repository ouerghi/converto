<?php

namespace App\Controller;

use App\Entity\Fiche;
use App\Form\FicheType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class FicheController
 * @package App\Controller
 * @Route("/fiche")
 */
class FicheController extends AbstractController
{
	/**
	 * @Route("/", name="index.fiche")
	 * @param Request $request
	 *
	 * @return Response
	 */
    public function index(Request $request): Response{

    	$fiche = new Fiche();
    	$form = $this->createForm(FicheType::class, $fiche);
    	$form->handleRequest($request);
    	if ($form->isSubmitted() && $form->isValid())
	    {
	    	dd($form->all());
	    }
        return $this->render('fiche/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }

	/**
	 * @Route("/new", name="fiche.new")
	 * @param Request $request
	 *
	 * @return Response
	 */
    public function addFiche(Request $request): Response {
    	$agent = $this->get('security.token_storage')->getToken()->getUser();
//    	dd($agent);
    	$fiche = new Fiche();
    	$form = $this->createForm(FicheType::class, $fiche, array('agent' => $agent));
    	$form->handleRequest($request);
    	if ($form->isSubmitted() && $form->isValid())
	    {
	    	dd($form->getData());
	    }

    	return $this->render('fiche/new.html.twig', array(
    		'form' => $form->createView(),
	    ));
    }
}
