<?php

namespace App\DataFixtures;
use App\Entity\Agent;
use App\Entity\Client;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class DataUser extends Fixture
{
	/**
	 * @var UserPasswordEncoderInterface
	 */
	private $encoder;

	/**
	 * DataUser constructor.
	 *
	 * @param UserPasswordEncoderInterface $encoder

	 */
	public function __construct(UserPasswordEncoderInterface $encoder)
	{

		$this->encoder = $encoder;
	}

	/**
	 * @param ObjectManager $manager
	 *
	 * @throws \Exception
	 */
	public function load(ObjectManager $manager)
    {

	    $faker = Faker\Factory::create('fr_FR');

	    /** @var  Agent[] */
	   $agent = [];
	   $ag = new Agent();
	   $password = $this->encoder->encodePassword($ag,123456);

	    /** @var Fiches[] $clients */
	    $clients = [];
	    for ($k=0; $k<20; $k++)
	    {

		    /** @var Client[] $clients */
		    $clients[$k] = new Client();
		    //*
		    $clients[$k]->setFullName($faker->name);
		    $clients[$k]->setRoles('ROLE_CLIENT');
		    $clients[$k]->setMail($faker->email);
		    $clients[$k]->setUsername($faker->userName);
		    $clients[$k]->setPassword($password);
		    $manager->persist($clients[$k]);
	    }
	    for ($i=0; $i<5; $i++)
	    {

		    $agent[$i] = new Agent();
		    //*
		    $agent[$i]->setFullName($faker->name);
		    $agent[$i]->setRoles('ROLE_AGENT');
		    $agent[$i]->setUsername($faker->userName);
		    $agent[$i]->setPassword($password);

		    $randomClients = (array) array_rand($clients, random_int(1, count($clients)));
		    foreach ($randomClients as $key => $value) {
			    $agent[$i]->addClient($clients[$key]);

		    }

		    $manager->persist($agent[$i]);

	    }

	    $manager->flush();
    }
}
