<?php

namespace App\Controller;

use App\Entity\Agent;
use App\Form\AgentType;
use App\Repository\AgentRepository;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;


/**
 * @Route("/agent")
 */
class AgentController extends AbstractController
{
	/**
	 * @Route("/", name="agent.index")
	 * @param AgentRepository $agents
	 *
	 * @return \Symfony\Component\HttpFoundation\Response
	 */
    public function index( AgentRepository $agents): Response {
        return $this->render('agent/index.html.twig', [
            'agents' => $agents->findAll(),
        ]);
    }

	/**
	 * @Route("/nouveau", name="agent.add")
	 * @param Request $request
	 * @param UserPasswordEncoderInterface $passwordEncoder
	 * @param ObjectManager $em
	 *
	 * @return \Symfony\Component\HttpFoundation\RedirectResponse|Response
	 * @throws \Exception
	 */
	public function addAgent(Request $request, UserPasswordEncoderInterface $passwordEncoder, ObjectManager $em)
    {
    	$agent = new Agent();
    	$form = $this->createForm(AgentType::class, $agent);
    	$form->handleRequest($request);
    	if($form->isSubmitted() && $form->isValid())
	    {
		    $password = $passwordEncoder->encodePassword($agent, $agent->getPassword());

		    $clients = $form['clients']->getData();
		    foreach ($clients as $client)
		    {
		    	$agent->addClient($client);
		    }
		    $agent->setPassword($password);
		    $agent->setRoles('ROLE_AGENT');
		    $em->persist($agent);
		    $em->flush();
		    $this->addFlash('success', 'l\'agent '.$agent->getUsername().' est enregistré dans la base de donnée');
		    return $this->redirectToRoute('agent.index');
	    }

    	return $this->render('agent/new.html.twig', array(
    		'form' => $form->createView()
	    ));


    }

	/**
	 * @Route("/{id}", name="agent.show", methods={"GET"})
	 * @param Agent $agent
	 *
	 * @return Response
	 */
	public function show(Agent $agent): Response
	{
		return $this->render('Agent/show.html.twig', ['client' => $agent]);
	}

	/**
	 * @Route("/{id}/edit", name="agent.edit", methods={"GET","POST"})
	 * @param Request $request
	 * @param Agent $agent
	 *
	 * @return Response
	 */
	public function edit(Request $request, Agent $agent): Response
	{
		$form = $this->createForm(AgentType::class, $agent);
		$form->handleRequest($request);

		if ($form->isSubmitted() && $form->isValid()) {

			$clients = $form['clients']->getData();
				foreach ($clients as $client)
				{
					$agent->addClient($client);
				}

			$this->getDoctrine()->getManager()->flush();

			return $this->redirectToRoute('agent.index', ['id' => $agent->getId()]);
		}

		return $this->render('agent/edit.html.twig', [
			'agent' => $agent,
			'form' => $form->createView(),
		]);
	}
	/**
	 * @Route("/{id}", name="agent.delete", methods={"DELETE"})
	 * @param Request $request
	 * @param Agent $agent
	 *
	 * @return Response
	 */
	public function delete(Request $request, Agent $agent): Response
	{
		if ($this->isCsrfTokenValid('delete'.$agent->getId(), $request->request->get('_token'))) {
			$entityManager = $this->getDoctrine()->getManager();
			$entityManager->remove($agent);
			$entityManager->flush();
		}

		return $this->redirectToRoute('agent.index');
	}

}
