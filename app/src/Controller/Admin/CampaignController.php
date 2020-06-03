<?php

namespace App\Controller\Admin;

use App\Entity\Campaign;
use App\Form\CampaignType;
use App\Repository\CampaignRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/campaign")
 */
class CampaignController extends AbstractController
{
    /**
     * @Route("/", name="campaign_index", methods={"GET"})
     */
    public function index(CampaignRepository $campaignRepository): Response
    {
        return $this->render('admin/campaign/index.html.twig', [
            'campaigns' => $campaignRepository->findAll(),
        ]);
    }

    /**
     * @Route("/{id}/edit", name="campaign_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Campaign $campaign, CampaignRepository $campaignRepository): Response
    {
        $form = $this->createForm(CampaignType::class, $campaign);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $campaignRepository->save();

            return $this->redirectToRoute('campaign_index');
        }

        return $this->render('admin/campaign/edit.html.twig', [
            'campaign' => $campaign,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="campaign_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Campaign $campaign, CampaignRepository $campaignRepository): Response
    {
        if ($this->isCsrfTokenValid('delete' . $campaign->getId(), $request->request->get('_token'))) {
            $campaignRepository->remove($campaign);
        }

        return $this->redirectToRoute('campaign_index');
    }
}
