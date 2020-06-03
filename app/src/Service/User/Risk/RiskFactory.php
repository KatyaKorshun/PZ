<?php

namespace App\Service\User\Risk;

class RiskFactory
{
    public static function getRisk(string $type): RiskInterface
    {
        switch ($type) {
            case 'market_risk':
                $result = new MarkerRIsk();
                break;

            case 'liquidity_risk':
                $result = new LiquidityRisk();
                break;

            default:
                throw new \ErrorException('Такого риска не существует');
        }

        return $result;
    }
}