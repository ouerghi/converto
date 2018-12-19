<?php

namespace App\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class HomeControllerTest extends WebTestCase
{
    public function testHomePage()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/');

        $this->assertSame(200, $client->getResponse()->getStatusCode());
        $this->assertGreaterThan(0, $crawler->filter('html:contains("contact")')->count());
        $link = $crawler
	        ->filter('a:contains("accueil")')
	        ->eq(1)
	        ->link()
	        ;
        $crawler = $client->click($link);
    }
}
