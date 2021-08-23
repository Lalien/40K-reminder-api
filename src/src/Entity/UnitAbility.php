<?php

namespace App\Entity;

use App\Repository\UnitAbilityRepository;
use Doctrine\ORM\Mapping as ORM;
use App\Entity\Ability;
use App\Entity\Unit;

/**
 * @ORM\Entity(repositoryClass=UnitAbilityRepository::class)
 */
class UnitAbility
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Unit::class, inversedBy="unitAbilities")
     * @ORM\JoinColumn(nullable=false)
     */
    private $unit_id;

    /**
     * @ORM\ManyToOne(targetEntity=Ability::class, inversedBy="unitAbilities")
     * @ORM\JoinColumn(nullable=false)
     */
    private $ability_id;
    
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUnitId(): ?Unit
    {
        return $this->unit_id;
    }

    public function setUnitId(Unit $unit_id): self
    {
        $this->unit_id = $unit_id;
        return $this;
    }

    public function getAbilityId(): ?Ability
    {
        return $this->ability_id;
    }

    public function setAbilityId(Ability $ability_id): self
    {
        $this->ability_id = $ability_id;

        return $this;
    }
}
