<?php

namespace App\Controller\Admin;

use App\Entity\Industry;
use App\Form\IndustryType;
use App\Repository\IndustryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/industry")
 */
class IndustryController extends AbstractController
{
    /**
     * @Route("/", name="industry_index", methods={"GET"})
     */
    public function index(IndustryRepository $industryRepository): Response
    {
        return $this->render('admin/industry/index.html.twig', [
            'industries' => $industryRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="industry_new", methods={"GET","POST"})
     */
    public function new(Request $request, IndustryRepository $industryRepository): Response
    {
        $industry = new Industry();
        $form = $this->createForm(IndustryType::class, $industry);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $industryRepository->save($industry);

            return $this->redirectToRoute('industry_index');
        }

        return $this->render('admin/industry/new.html.twig', [
            'industry' => $industry,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}/edit", name="industry_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Industry $industry, IndustryRepository $industryRepository): Response
    {
        $form = $this->createForm(IndustryType::class, $industry);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $industryRepository->save();

            return $this->redirectToRoute('industry_index');
        }

        return $this->render('admin/industry/edit.html.twig', [
            'industry' => $industry,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="industry_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Industry $industry, IndustryRepository $industryRepository): Response
    {
        if ($this->isCsrfTokenValid('delete' . $industry->getId(), $request->request->get('_token'))) {
            $industryRepository->remove($industry);
        }

        return $this->redirectToRoute('industry_index');
    }
}
