<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CampaignRiskRepository")
 * @ORM\Table(name="campaign_risks")
 */
class CampaignRisk
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $quantile;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $volatility;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $openPositionValue;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $k1;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $k2;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $k3;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $k4;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Campaign", cascade={"persist", "remove"})
     * @ORM\JoinColumn(name="campaign_id", referencedColumnName="id", onDelete="CASCADE")
     */
    private $campaign;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Risk", cascade={"persist", "remove"})
     * @ORM\JoinColumn(name="risk_id", referencedColumnName="id", onDelete="CASCADE")
     */
    private $risk;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $response;

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getResponse()
    {
        return $this->response;
    }

    /**
     * @param mixed $response
     */
    public function setResponse($response): void
    {
        $this->response = $response;
    }

    public function getQuantile(): ?float
    {
        return $this->quantile;
    }

    public function setQuantile(?float $quantile): self
    {
        $this->quantile = $quantile;

        return $this;
    }

    public function getVolatility(): ?float
    {
        return $this->volatility;
    }

    public function setVolatility(?float $volatility): self
    {
        $this->volatility = $volatility;

        return $this;
    }

    public function getOpenPositionValue(): ?float
    {
        return $this->openPositionValue;
    }

    public function setOpenPositionValue(?float $openPositionValue): self
    {
        $this->openPositionValue = $openPositionValue;

        return $this;
    }

    public function getK1(): ?float
    {
        return $this->k1;
    }

    public function setK1(?float $k1): self
    {
        $this->k1 = $k1;

        return $this;
    }

    public function getK2(): ?float
    {
        return $this->k2;
    }

    public function setK2(?float $k2): self
    {
        $this->k2 = $k2;

        return $this;
    }

    public function getK3(): ?float
    {
        return $this->k3;
    }

    public function setK3(?float $k3): self
    {
        $this->k3 = $k3;

        return $this;
    }

    public function getK4(): ?float
    {
        return $this->k4;
    }

    public function setK4(?float $k4): self
    {
        $this->k4 = $k4;

        return $this;
    }

    public function getCampaign(): ?Campaign
    {
        return $this->campaign;
    }

    public function setCampaign(?Campaign $campaign): self
    {
        $this->campaign = $campaign;

        return $this;
    }

    public function getRisk()
    {
        return $this->risk;
    }

    public function setRisk($risk): void
    {
        $this->risk = $risk;
    }
}
