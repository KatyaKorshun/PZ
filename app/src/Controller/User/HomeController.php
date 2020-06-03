<?php

namespace App\Controller\User;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="user_homepage")
     */
    public function index()
    {
        if (!$this->getUser()) {
            return $this->redirectToRoute('login');
        }

        if (in_array('ROLE_ADMIN', $this->getUser()->getRoles())) {
            return $this->redirectToRoute('admin_homepage');
        }

        return $this->render('user/index.html.twig', []);
    }
}
