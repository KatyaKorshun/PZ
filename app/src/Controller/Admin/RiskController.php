<?php

namespace App\Controller\Admin;

use App\Entity\Risk;
use App\Form\RiskType;
use App\Repository\RiskRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/risk")
 */
class RiskController extends AbstractController
{
    /**
     * @Route("/", name="risk_index", methods={"GET"})
     */
    public function index(RiskRepository $riskRepository): Response
    {
        return $this->render('admin/risk/index.html.twig', [
            'risks' => $riskRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="risk_new", methods={"GET","POST"})
     */
    public function new(Request $request, RiskRepository $riskRepository): Response
    {
        $risk = new Risk();
        $form = $this->createForm(RiskType::class, $risk);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $riskRepository->save($risk);

            return $this->redirectToRoute('risk_index');
        }

        return $this->render('admin/risk/new.html.twig', [
            'risk' => $risk,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}/edit", name="risk_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Risk $risk, RiskRepository $riskRepository): Response
    {
        $form = $this->createForm(RiskType::class, $risk);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $riskRepository->save();

            return $this->redirectToRoute('risk_index');
        }

        return $this->render('admin/risk/edit.html.twig', [
            'risk' => $risk,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="risk_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Risk $risk, RiskRepository $riskRepository): Response
    {
        if ($this->isCsrfTokenValid('delete' . $risk->getId(), $request->request->get('_token'))) {
            $riskRepository->remove($risk);
        }

        return $this->redirectToRoute('risk_index');
    }
}
