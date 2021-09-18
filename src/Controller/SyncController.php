<?php

namespace App\Controller;

use App\Service\ContactService;
use App\Service\CurlService;
use App\Service\EntityServiceInterface;
use App\Service\ProductService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/sync")
 */
class SyncController extends AbstractController
{
    /**
     * @var CurlService
     */
    private CurlService $curlService;
    /**
     * @var ContactService
     */
    private ContactService $contactService;
    /**
     * @var ProductService
     */
    private ProductService $productService;

    /**
     * ImportController constructor.
     * @param CurlService $curlService
     * @param ContactService $contactService
     * @param ProductService $productService
     */
    public function __construct(CurlService $curlService, ContactService $contactService, ProductService $productService)
    {
        $this->curlService = $curlService;
        $this->contactService = $contactService;
        $this->productService = $productService;
    }

    /**
     * @Route("/from-erp", name="sync_from_erp")
     */
    public function fromErp(): Response
    {
        try {
            $this->getAndSync('contacts', $this->contactService);
            $this->getAndSync('products', $this->productService);
            $this->addFlash('success', "Sync from Billy has been successful!");
        } catch (\Exception $exception) {
            $this->addFlash('error', $exception->getMessage());
        }

        return $this->redirectToRoute('dashboard_index');
    }

    /**
     * @param string $string
     * @return bool
     */
    private function isJson(string $string)
    {
        json_decode($string);
        return json_last_error() === JSON_ERROR_NONE;
    }

    /**
     * @param string $what
     * @param EntityServiceInterface $service
     * @throws \Exception
     */
    private function getAndSync(string $what, EntityServiceInterface $service)
    {
        if ($responseString = $this->curlService->send($_ENV["ERP_URL"] . $what)) {
            if ($this->isJson($responseString)) {
                $response = json_decode($responseString, true);
                if (
                    array_key_exists('meta', $response) &&
                    array_key_exists('statusCode', $response['meta']) &&
                    $response['meta']['statusCode'] === RESPONSE::HTTP_OK
                ) {
                    if (array_key_exists($what, $response)) {
                        $service->sync($response[$what]);
                    }
                } else {
                    throw new \Exception('There is a problem with JSON response!');
                }
            } else {
                throw new \Exception('Response is not json!');
            }
        }
    }
}
