<?php

namespace App\Controller\Admin;

use App\Entity\CompanyType;
use App\Form\CompanyTypeType;
use App\Repository\CompanyTypeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/company/type")
 */
class CompanyTypeController extends AbstractController
{
    /**
     * @Route("/", name="company_type_index", methods={"GET"})
     */
    public function index(CompanyTypeRepository $companyTypeRepository): Response
    {
        return $this->render('admin/company_type/index.html.twig', [
            'company_types' => $companyTypeRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="company_type_new", methods={"GET","POST"})
     */
    public function new(Request $request, CompanyTypeRepository $companyTypeRepository): Response
    {
        $companyType = new CompanyType();
        $form = $this->createForm(CompanyTypeType::class, $companyType);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $companyTypeRepository->save($companyType);

            return $this->redirectToRoute('company_type_index');
        }

        return $this->render('admin/company_type/new.html.twig', [
            'company_type' => $companyType,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}/edit", name="company_type_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, CompanyType $companyType, CompanyTypeRepository $companyTypeRepository): Response
    {
        $form = $this->createForm(CompanyTypeType::class, $companyType);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $companyTypeRepository->save();

            return $this->redirectToRoute('company_type_index');
        }

        return $this->render('admin/company_type/edit.html.twig', [
            'company_type' => $companyType,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="company_type_delete", methods={"DELETE"})
     */
    public function delete(Request $request, CompanyType $companyType, CompanyTypeRepository $companyTypeRepository): Response
    {
        if ($this->isCsrfTokenValid('delete' . $companyType->getId(), $request->request->get('_token'))) {
            $companyTypeRepository->remove($companyType);
        }

        return $this->redirectToRoute('company_type_index');
    }
}
