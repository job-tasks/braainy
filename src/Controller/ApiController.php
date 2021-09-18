<?php

namespace App\Controller;

use App\Service\CurlService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class ApiController.
 *
 * @Route("/api", defaults={"_format": "json"})
 */
class ApiController extends AbstractController
{

}