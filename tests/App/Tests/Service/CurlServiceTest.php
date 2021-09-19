<?php

namespace App\Tests\Service;

use App\Service\CurlService;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class CurlServiceTest extends KernelTestCase
{
    public function testSend()
    {
        // (1) boot the Symfony kernel
        self::bootKernel();

        // (2) use static::getContainer() to access the service container
        $container = static::getContainer();

        // (3) run some service & test the result
        /** @var CurlService $curlService */
        $curlService = $container->get(CurlService::class);
        $this->assertIsString($curlService->send('ifconfig.me'));
    }

    public function testGetProductsFromErp()
    {
        // (1) boot the Symfony kernel
        self::bootKernel();

        // (2) use static::getContainer() to access the service container
        $container = static::getContainer();

        // (3) run some service & test the result
        /** @var CurlService $curlService */
        $curlService = $container->get(CurlService::class);
        $this->assertJson($curlService->send($_ENV["ERP_URL"].'products'));
    }


}
