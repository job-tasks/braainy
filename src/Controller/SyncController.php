<?php

namespace App\Controller;

use App\Service\ContactService;
use App\Service\CurlService;
use App\Service\EntityServiceInterface;
use App\Service\ProductService;
use Doctrine\ORM\EntityManagerInterface;
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
     * @var EntityManagerInterface
     */
    private EntityManagerInterface $entityManager;

    /**
     * ImportController constructor.
     * @param CurlService $curlService
     * @param ContactService $contactService
     * @param ProductService $productService
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(CurlService $curlService, ContactService $contactService, ProductService $productService, EntityManagerInterface $entityManager)
    {
        $this->curlService = $curlService;
        $this->contactService = $contactService;
        $this->productService = $productService;
        $this->entityManager = $entityManager;
    }

    /**
     * @Route("/from-erp", name="sync_from_erp")
     */
    public function fromErp(): Response
    {
        try {
            $this->getAndSync('contacts', $this->contactService);
            $this->getAndSync('products', $this->productService);
            $this->addFlash('success', "Sync from ERP has been successful!");
        } catch (\Exception $exception) {
            $this->addFlash('error', $exception->getMessage());
        }

        return $this->redirectToRoute('dashboard_index');
    }

    /**
     * @Route("/to-erp", name="sync_to_erp")
     */
    public function toErp(): Response
    {
        try {
            $this->getPrepareAndSendBack('contacts', $this->contactService);
            $this->getPrepareAndSendBack('products', $this->productService);
            $this->addFlash('success', "Sync to ERP has been successful!");
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
     * @return mixed
     * @throws \Exception
     */
    private function getInfo(string $what)
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
                        return $response[$what];
                    }
                } else {
                    throw new \Exception('There is a problem with JSON response!');
                }
            } else {
                throw new \Exception('Response is not json!');
            }
        } else {
            throw new \Exception('Failed to get response from ERP!');
        }
    }

    /**
     * @param string $what
     * @param EntityServiceInterface $service
     * @throws \Exception
     */
    private function getAndSync(string $what, EntityServiceInterface $service)
    {
        $service->sync($this->getInfo($what));
    }

    /**
     * @param string $what
     * @param EntityServiceInterface $service
     * @throws \Exception
     */
    private function getPrepareAndSendBack(string $what, EntityServiceInterface $service)
    {
        $allFromDb = $service->getAll();
        $allFromErp = $this->getInfo($what);

        $updateIds = [];
        $newIds = [];
        foreach ($allFromDb as $fromDb) {
            $newIds[$fromDb['id']] = $fromDb;
            foreach ($allFromErp as $fromErp) {
                if ($fromErp['id'] === $fromDb['billyId']) {
                    $updateIds[$fromDb['billyId']] = $fromDb;
                    unset($newIds[$fromDb['id']]);
                }
            }
        }

        //Update records in ERP
        foreach ($updateIds as $oldId => $newArray) {
           $updateArray[$what][] = $service->prepareArray($newArray);
        }

        $response = $this->curlService->send($_ENV["ERP_URL"] . $what, "PATCH", $updateArray);
        $result = json_decode($response, true);
        if (!$result) {
            throw new \Exception('Error during synchronization!');
        }

        //Create new records in ERP
        foreach ($newIds as $newId => $newArray) {
            $response = $this->curlService->send($_ENV["ERP_URL"] . $what, "PATCH", [
                $what => [$service->prepareArray($newArray, true)]
            ]);

            $result = json_decode($response, true);

            if ($result && array_key_exists('meta', $result) && $result['meta']['statusCode'] === RESPONSE::HTTP_OK) {
                $service->updateId($newId,current($result[$what])['id']);
            } else {
                throw new \Exception('Error during synchronization! Create new Records!');
            }
        }

        //Delete records in ERP
        $deleteIds = [];
        foreach ($allFromErp as $fromErp) {
            $deleteIds[$fromErp['id']] = $fromErp['id'];
            foreach ($allFromDb as $fromDb) {
                if ($fromErp['id'] === $fromDb['billyId']) {
                    unset($deleteIds[$fromErp['id']]);
                }
            }
        }
        foreach ($deleteIds as $deleteId) {
            $this->curlService->send($_ENV["ERP_URL"] . $what . '/' . $deleteId, "DELETE");
        }

    }
}
