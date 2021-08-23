<?php

namespace App\Entity;

use App\Repository\UserUnitRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=UserUnitRepository::class)
 */
class UserUnit
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
    private $army_id;

    /**
     * @ORM\Column(type="integer")
     */
    private $unit_id;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getArmyId(): ?int
    {
        return $this->army_id;
    }

    public function setArmyId(int $army_id): self
    {
        $this->army_id = $army_id;

        return $this;
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
}
