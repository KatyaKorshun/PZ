<?php

namespace App\Service\User\Risk;

use App\Entity\CampaignRisk;

class MarkerRIsk implements RiskInterface
{
    private string $response;

    public function getResponse(): string
    {
        return $this->response;
    }

    public function processResponse(CampaignRisk $data): void
    {
        //VaR = V* λ *σ
        $formula = $data->getOpenPositionValue() * $data->getQuantile() * $data->getVolatility();

        $this->response = $formula;
    }
}
