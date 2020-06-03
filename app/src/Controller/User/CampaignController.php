<?php

namespace App\Controller\User;

use App\Entity\Campaign;
use App\Entity\CampaignRisk;
use App\Form\CampaignRiskType;
use App\Form\CampaignType;
use App\Repository\CampaignRepository;
use App\Repository\CampaignRiskRepository;
use App\Service\User\UserService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

/**
 * @Route("/my-campaign")
 */
class CampaignController extends AbstractController
{
    /**
     * @Route("/", name="my_campaign_index", methods={"GET"})
     */
    public function index(CampaignRepository $campaignRepository): Response
    {
        return $this->render('user/campaign/index.html.twig', [
            'campaigns' => $campaignRepository->findBy(['user' => $this->getUser()]),
        ]);
    }

    /**
     * @Route("/new", name="my_campaign_new", methods={"GET","POST"})
     */
    public function new(
        Request $request,
        CampaignRepository $campaignRepository,
        CampaignRiskRepository $campaignRiskRepository
    ): Response
    {
        $campaign = new Campaign();
        $form = $this->createForm(CampaignType::class, $campaign);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $campaign->setUser($this->getUser());

            $campaignRepository->save($campaign);

            $campaignRisk = new CampaignRisk();
            $campaignRisk->setCampaign($campaign);
            $campaignRiskRepository->save($campaignRisk);

            return $this->redirectToRoute('my_campaign_index');
        }

        return $this->render('user/campaign/new.html.twig', [
            'campaign' => $campaign,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}/edit", name="my_campaign_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Campaign $campaign, CampaignRepository $campaignRepository): Response
    {
        $form = $this->createForm(CampaignType::class, $campaign);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $campaignRepository->save();

            return $this->redirectToRoute('my_campaign_index');
        }

        return $this->render('user/campaign/edit.html.twig', [
            'campaign' => $campaign,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="my_campaign_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Campaign $campaign, CampaignRepository $campaignRepository): Response
    {
        if ($this->isCsrfTokenValid('delete' . $campaign->getId(), $request->request->get('_token'))) {
            $campaignRepository->remove($campaign);
        }

        return $this->redirectToRoute('my_campaign_index');
    }

    /**
     * @Route("/check/{id}", name="my_campaign_check", methods={"GET","POST"})
     */
    public function check(
        Request $request,
        Campaign $campaign,
        CampaignRiskRepository $campaignRiskRepository,
        UserService $userService
    ): Response {
        /* @var CampaignRisk $campaignRisk */
        $campaignRisk = $campaignRiskRepository->findOneBy(['campaign' => $campaign]);

        if (!$campaignRisk) {
            throw new AccessDeniedException();
        }

        $form = $this->createForm(CampaignRiskType::class, $campaignRisk);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();

            $campaignRisk->setResponse($userService->getRiskResponse($data));

            $campaignRiskRepository->save($campaignRisk);

            return $this->redirectToRoute('my_campaign_check', ['id' => $campaign->getId()]);
        }

        return $this->render('user/campaign/check.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
