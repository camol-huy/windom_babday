<?php

namespace App\Entity;

use App\Repository\ProgrammeRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ProgrammeRepository::class)
 */
class Programme
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=10)
     */
    private $dtg_start;

    /**
     * @ORM\Column(type="string", length=10)
     */
    private $dtg_end;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $description;

    /**
     * @ORM\Column(type="boolean")
     */
    private $air;

    /**
     * @ORM\Column(type="boolean")
     */
    private $fr;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDtgStart(): ?string
    {
        return $this->dtg_start;
    }

    public function setDtgStart(string $dtg_start): self
    {
        $this->dtg_start = $dtg_start;

        return $this;
    }

    public function getDtgEnd(): ?string
    {
        return $this->dtg_end;
    }

    public function setDtgEnd(string $dtg_end): self
    {
        $this->dtg_end = $dtg_end;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function isAir(): ?bool
    {
        return $this->air;
    }

    public function setAir(bool $air): self
    {
        $this->air = $air;

        return $this;
    }

    public function isFr(): ?bool
    {
        return $this->fr;
    }

    public function setFr(bool $fr): self
    {
        $this->fr = $fr;

        return $this;
    }
}
