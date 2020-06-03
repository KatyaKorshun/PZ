<?php

namespace App\Service\User\Risk;

use App\Entity\CampaignRisk;

interface RiskInterface
{
    public function getResponse(): string;

    public function processResponse(CampaignRisk $data): void;
}