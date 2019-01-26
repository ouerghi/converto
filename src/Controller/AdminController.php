<?php

namespace App\Controller;

use App\Entity\Filter;
use App\Form\FilterType;
use App\Repository\FicheRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class AdminController
 * @package App\Controller
 *  * @Security("is_fully_authenticated()")
 */

class AdminController extends AbstractController
{
	/**
	 * @Route("/admin", name="admin")
	 * @param Request $request
	 * @param FicheRepository $fiche_repository
	 *
	 * @return Response
	 */
    public function index(Request $request, FicheRepository $fiche_repository): Response {

    	$user = $this->getUser();
    	$filter = new Filter();
    	$form = $this->createForm(FilterType::class, $filter);
    	$form->handleRequest($request);


    	 if ($this->isGranted('ROLE_AGENT'))
	     {
		     if ($form->isSubmitted() && $form->isValid())
		     {
			     /** @var Filter $data */
			     $data = $form->getData();

			     $start = $data->getStart();
			     $end   = $data->getEnd();
			     $end = $end->modify('+1 day');
			     $fiche = $fiche_repository->findFichesFilterAgent($user,$start, $end);

		     }else{
		     	$fiche = $fiche_repository->findFichesAgent($user);
		     }

	     }


	    if ($this->isGranted('ROLE_CLIENT'))
	    {
		    if ($form->isSubmitted() && $form->isValid())
		    {
			    /** @var Filter $data */
			    $data = $form->getData();

			    $start = $data->getStart();
			    $end   = $data->getEnd();
			    $end = $end->modify('+1 day');
			    $fiche = $fiche_repository->findFicheFilterClient($user,$start, $end);

		    }else{
			    $fiche = $fiche_repository->findFicheClient($user);
		    }

	    }


	    if ($this->isGranted('ROLE_ADMIN'))
	    {
		    if ($form->isSubmitted() && $form->isValid())
		    {
			    /** @var Filter $data */
			    $data = $form->getData();

			    $start = $data->getStart();
			    $end   = $data->getEnd();
			    $end = $end->modify('+1 day');
			    $fiche = $fiche_repository->findFilterFiche($start, $end);

		    } else{
			    $fiche = $fiche_repository->findBy(array(), array('id' => 'DESC'));
		    }

	    }
        return $this->render('admin/index.html.twig', [
        	'fiches' => $fiche,
	        'user' => $user,
	        'form' => $form->createView()
        ]);
    }
}
