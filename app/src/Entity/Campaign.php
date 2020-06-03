<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CampaignRepository")
 * @ORM\Table(name="campaigns")
 */
class Campaign
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=500)
     */
    private $name;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\CompanyType", cascade={"persist", "remove"})
     * @ORM\JoinColumn(name="type_company_id", referencedColumnName="id", onDelete="CASCADE")
     */
    private $typeCompany;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $ynp;

    /**
     * @ORM\Column(type="string", length=500)
     */
    private $address;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Industry", cascade={"persist", "remove"})
     * @ORM\JoinColumn(name="industry_id", referencedColumnName="id", onDelete="CASCADE")
     */
    private $industry;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $phone;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $email;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $additionalInformation;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $contactPerson;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    private $user;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getTypeCompany(): ?CompanyType
    {
        return $this->typeCompany;
    }

    public function setTypeCompany(?CompanyType $typeCompany): self
    {
        $this->typeCompany = $typeCompany;

        return $this;
    }

    public function getYnp(): ?string
    {
        return $this->ynp;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser($user): self
    {
        $this->user = $user;

        return $this;
    }

    public function setYnp(string $ynp): self
    {
        $this->ynp = $ynp;

        return $this;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(string $address): self
    {
        $this->address = $address;

        return $this;
    }

    public function getIndustry(): ?Industry
    {
        return $this->industry;
    }

    public function setIndustry(?Industry $industry): self
    {
        $this->industry = $industry;

        return $this;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function setPhone(?string $phone): self
    {
        $this->phone = $phone;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(?string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getAdditionalInformation(): ?string
    {
        return $this->additionalInformation;
    }

    public function setAdditionalInformation(?string $additionalInformation): self
    {
        $this->additionalInformation = $additionalInformation;

        return $this;
    }

    public function getContactPerson(): ?string
    {
        return $this->contactPerson;
    }

    public function setContactPerson(?string $contactPerson): self
    {
        $this->contactPerson = $contactPerson;

        return $this;
    }
}
