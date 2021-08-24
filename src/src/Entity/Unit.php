<?php

namespace App\Entity;

use App\Repository\UnitRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=UnitRepository::class)
 */
class Unit
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
     * @ORM\Column(type="boolean")
     */
    private $is_character;

    /**
     * @ORM\OneToMany(targetEntity=App\Entity\UnitAbility::class, mappedBy="unit_id")
     */
    private $unitAbilities;

    /**
     * @ORM\OneToMany(targetEntity=FactionUnit::class, mappedBy="unit_id")
     */
    private $factionUnits;

    public function __construct()
    {
        $this->unitAbilities = new ArrayCollection();
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

    public function getIsCharacter(): ?bool
    {
        return $this->is_character;
    }

    public function setIsCharacter(bool $is_character): self
    {
        $this->is_character = $is_character;

        return $this;
    }

    /**
     * @return Collection|UnitAbility[]
     */
    public function getUnitAbilities(): Collection
    {
        return $this->unitAbilities;
    }

    public function addUnitAbility(UnitAbility $unitAbility): self
    {
        if (!$this->unitAbilities->contains($unitAbility)) {
            $this->unitAbilities[] = $unitAbility;
            $unitAbility->setUnitId($this);
        }

        return $this;
    }

    public function removeUnitAbility(UnitAbility $unitAbility): self
    {
        if ($this->unitAbilities->removeElement($unitAbility)) {
            // set the owning side to null (unless already changed)
            if ($unitAbility->getUnitId() === $this) {
                $unitAbility->setUnitId(null);
            }
        }

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
            $factionUnit->setUnitId($this);
        }

        return $this;
    }

    public function removeFactionUnit(FactionUnit $factionUnit): self
    {
        if ($this->factionUnits->removeElement($factionUnit)) {
            // set the owning side to null (unless already changed)
            if ($factionUnit->getUnitId() === $this) {
                $factionUnit->setUnitId(null);
            }
        }

        return $this;
    }
}
