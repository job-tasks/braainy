<?php

namespace App\Tests\Controller;

use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ProductControllerTest extends WebTestCase
{
    public function testIndexWhileLoggedIn()
    {
        $client = static::createClient(array(
            'debug'       => true,
        ));

        $this->logInUser($client);

        $client->request('GET', 'http://localhost:8088/product/');
        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h1', 'Product List');
    }

    public function testIndexWhileNotLoggedIn()
    {
        $client = static::createClient(array(
            'debug'       => true,
        ));

        $client->request('GET', 'http://localhost:8088/product/');
        $this->assertResponseStatusCodeSame(302);
    }

    private function logInUser(KernelBrowser $client)
    {
        $userRepository = static::getContainer()->get(UserRepository::class);
        $testUser = $userRepository->findOneByEmail('admin@admin.com');

        // simulate $testUser being logged in
        $client->loginUser($testUser);
    }
}
