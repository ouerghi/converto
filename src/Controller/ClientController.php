<?php

namespace App\Controller;

use App\Entity\Client;
use App\Form\Client1Type;
use App\Repository\ClientRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

/**
 * @Route("/client")
 */
class ClientController extends AbstractController
{
	/**
	 * @Route("/", name="client_index", methods={"GET"})
	 * @param ClientRepository $clientRepository
	 *
	 * @return Response
	 */
    public function index(ClientRepository $clientRepository): Response
    {
	   $clients = $clientRepository->findAll();
//	   dd($clients);
        return $this->render('client/index.html.twig', ['clients' => $clients]);
    }

	/**
	 * @Route("/nouveau", name="client_new", methods={"GET","POST"})
	 * @param Request $request
	 *
	 * @param UserPasswordEncoderInterface $userPassword
	 *
	 * @return Response
	 * @throws \Exception
	 */
    public function new(Request $request, UserPasswordEncoderInterface $userPassword ): Response
    {
        $client = new Client();
        $form = $this->createForm(Client1Type::class, $client);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
        	$password = $userPassword->encodePassword($client, $client->getPassword());
        	$client->setPassword($password);
        	$client->setRoles('ROLE_CLIENT');
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($client);
            $entityManager->flush();

            return $this->redirectToRoute('client_index');
        }

        return $this->render('client/new.html.twig', [
            'client' => $client,
            'form' => $form->createView(),
        ]);
    }

	/**
	 * @Route("/{id}", name="client_show", methods={"GET"})
	 * @param Client $client
	 *
	 * @return Response
	 */
    public function show(Client $client): Response
    {
        return $this->render('client/show.html.twig', ['client' => $client]);
    }

	/**
	 * @Route("/{id}/edit", name="client_edit", methods={"GET","POST"})
	 * @param Request $request
	 * @param Client $client
	 *
	 * @return Response
	 */
    public function edit(Request $request, Client $client): Response
    {
        $form = $this->createForm(Client1Type::class, $client);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('client_index', ['id' => $client->getId()]);
        }

        return $this->render('client/edit.html.twig', [
            'client' => $client,
            'form' => $form->createView(),
        ]);
    }

	/**
	 * @Route("/{id}", name="client_delete", methods={"DELETE"})
	 * @param Request $request
	 * @param Client $client
	 *
	 * @return Response
	 */
    public function delete(Request $request, Client $client): Response
    {
        if ($this->isCsrfTokenValid('delete'.$client->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($client);
            $entityManager->flush();
        }

        return $this->redirectToRoute('client_index');
    }
}
