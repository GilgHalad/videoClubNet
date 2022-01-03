<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class RentalControllerTest extends WebTestCase
{
    public function testReturnMovieOl(): void
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/rental/11/return');

        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h1','Return ok');
    }

    public function testReturnMovieError1(): void
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/rental/0/return');

        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h1','Return fail');
    }
   
}
