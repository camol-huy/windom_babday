<?php

namespace App\Entity;

use App\Repository\CRCRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CRCRepository::class)
 */
class CRC
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $mail;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $rrn;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $car;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $bbq;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $coffee;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $activity;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $visite;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMail(): ?string
    {
        return $this->mail;
    }

    public function setMail(string $mail): self
    {
        $this->mail = $mail;

        return $this;
    }

    public function getRrn(): ?string
    {
        return $this->rrn;
    }

    public function setRrn(string $rrn): self
    {
        $this->rrn = $rrn;

        return $this;
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

    public function getCar(): ?string
    {
        return $this->car;
    }

    public function setCar(string $car): self
    {
        $this->car = $car;

        return $this;
    }

    public function getBbq(): ?string
    {
        return $this->bbq;
    }

    public function setBbq(string $bbq): self
    {
        $this->bbq = $bbq;

        return $this;
    }

    public function getCoffee(): ?string
    {
        return $this->coffee;
    }

    public function setCoffee(string $coffee): self
    {
        $this->coffee = $coffee;

        return $this;
    }

    public function getActivity(): ?string
    {
        return $this->activity;
    }

    public function setActivity(string $activity): self
    {
        $this->activity = $activity;

        return $this;
    }

    public function getVisite(): ?string
    {
        return $this->visite;
    }

    public function setVisite(string $visite): self
    {
        $this->visite = $visite;

        return $this;
    }
}
