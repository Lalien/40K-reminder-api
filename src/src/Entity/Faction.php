<?php

namespace App\Entity;

use App\Repository\FactionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=FactionRepository::class)
 */
class Faction
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
    private $name;

    /**
     * @ORM\OneToMany(targetEntity=FactionUnit::class, mappedBy="faction_id")
     */
    private $factionUnits;

    public function __construct()
    {
        $this->factionUnits = new ArrayCollection();
    }

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

    /**
     * @return Collection|FactionUnit[]
     */
    public function getFactionUnits(): Collection
    {
        return $this->factionUnits;
    }

    public function addFactionUnit(FactionUnit $factionUnit): self
    {
        if (!$this->factionUnits->contains($factionUnit)) {
            $this->factionUnits[] = $factionUnit;
            $factionUnit->setFactionId($this);
        }

        return $this;
    }

    public function removeFactionUnit(FactionUnit $factionUnit): self
    {
        if ($this->factionUnits->removeElement($factionUnit)) {
            // set the owning side to null (unless already changed)
            if ($factionUnit->getFactionId() === $this) {
                $factionUnit->setFactionId(null);
            }
        }

        return $this;
    }
}
