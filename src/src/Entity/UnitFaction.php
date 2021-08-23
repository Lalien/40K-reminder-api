<?php

namespace App\Entity;

use App\Repository\UnitFactionRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=UnitFactionRepository::class)
 */
class UnitFaction
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $unit_id;

    /**
     * @ORM\Column(type="integer")
     */
    private $faction_id;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUnitId(): ?int
    {
        return $this->unit_id;
    }

    public function setUnitId(int $unit_id): self
    {
        $this->unit_id = $unit_id;

        return $this;
    }

    public function getFactionId(): ?int
    {
        return $this->faction_id;
    }

    public function setFactionId(int $faction_id): self
    {
        $this->faction_id = $faction_id;

        return $this;
    }
}
