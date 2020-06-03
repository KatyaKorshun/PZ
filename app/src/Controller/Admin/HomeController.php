<?php

namespace App\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/admin", name="admin_homepage")
     */
    public function index()
    {
        if (!$this->getUser()) {
            return $this->redirectToRoute('login');
        }

        return $this->render('admin/index.html.twig', []);
    }
}
