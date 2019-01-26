<?php

namespace App\DataFixtures;

use App\Entity\Fiche;
use App\Repository\AgentRepository;
use App\Repository\ClientRepository;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Faker;

class Fiches extends Fixture implements DependentFixtureInterface
{

	/**
	 * @var ClientRepository
	 */
	private $client_repository;
	/**
	 * @var AgentRepository
	 */
	private $agent_repository;

	public function __construct(ClientRepository $client_repository, AgentRepository $agent_repository)
	{

		$this->client_repository = $client_repository;
		$this->agent_repository = $agent_repository;
	}

	/**
	 * @param ObjectManager $manager
	 *
	 * @throws \Exception
	 */
	public function load(ObjectManager $manager)
    {
	    $faker = Faker\Factory::create('fr_FR');
	    $all_clients = $this->client_repository->findAll();
	    foreach ($all_clients as $cli)
	    {
		    $fiche = new Fiche();
		    $fiche->setTel($faker->phoneNumber);
		    $fiche->setContactPerson($faker->company);
		    $fiche->setAddress($faker->address);
		    $fiche->setCity($faker->city);
		    $fiche->setZipCode($faker->postcode);
		    $fiche->setComment($faker->text);
		    $fiche->setType('pro');
		    $fiche->setMail($faker->email);
		    $fiche->setClient($cli);
		    	$agent = $this->agent_repository->find(1);
			    $fiche->setAgent($agent);
		    $manager->persist($fiche);

	    }

        $manager->flush();
    }


	/**
	 * This method must return an array of fixtures classes
	 * on which the implementing class depends on
	 *
	 * @return array
	 */
	public function getDependencies() {
		return array(
			DataUser::class
		);
	}
}
