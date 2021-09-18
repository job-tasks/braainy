<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;



/**
 * Class DashboardController.
 *
 * @Route("/dashboard")
 */
class DashboardController extends AbstractController
{

    /**
     * @Route("/", name="dashboard_index")
     *
     * @return Response
     */
    public function index(): Response
    {
        return $this->render('admin/main.html.twig');
    }


}