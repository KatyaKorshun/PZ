<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\RiskRepository")
 * @ORM\Table(name="risks")
 */
class Risk
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(name="key_reserved", type="string", length=50)
     */
    private $key;

    /**
     * @ORM\Column(type="string", length=500)
     */
    private $name;

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

    public function getKey()
    {
        return $this->key;
    }

    public function setKey($key): self
    {
        $this->key = $key;

        return $this;
    }
}
