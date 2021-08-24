<?php

namespace App\Entity;

use App\Repository\FactionUnitRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Ignore;
use Symfony\Component\Serializer\Annotation\Groups;


/**
 * @ORM\Entity(repositoryClass=FactionUnitRepository::class)
 */
class FactionUnit
{
    /**
     * @Groups("main")
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @Groups("main")
     * @ORM\ManyToOne(targetEntity=Faction::class, inversedBy="factionUnits")
     * @ORM\JoinColumn(nullable=false)
     */
    private $faction_id;

    /**
     * @Groups("main")
     * @ORM\ManyToOne(targetEntity=Unit::class, inversedBy="factionUnits")
     * @ORM\JoinColumn(nullable=false)
     */
    private $unit_id;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFaction(): ?Faction
    {
        return $this->faction_id;
    }

    public function setFaction(?Faction $faction_id): self
    {
        $this->faction_id = $faction_id;

        return $this;
    }

    public function getUnit(): ?Unit
    {
        return $this->unit_id;
    }

    public function setUnit(?Unit $unit_id): self
    {
        $this->unit_id = $unit_id;

        return $this;
    }
}
