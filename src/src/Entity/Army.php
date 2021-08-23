<?php

namespace App\Entity;

use App\Repository\ArmyRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ArmyRepository::class)
 */
class Army
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
    private $faction_id;

    /**
     * @ORM\Column(type="integer")
     */
    private $user_id;

    /**
     * @ORM\Column(type="datetime")
     */
    private $date_created;

    /**
     * @ORM\Column(type="datetime")
     */
    private $date_updated;

    /**
     * 
     * @ORM\OneToMany(targetEntity="UserUnit",mappedBy="army",cascade={"persist", "remove", "merge"})
     */
    private $units;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getUserId(): ?int
    {
        return $this->user_id;
    }

    public function setUserId(int $user_id): self
    {
        $this->user_id = $user_id;
        return $this;
    }

    public function getDateCreated(): ?\DateTimeInterface
    {
        return $this->date_created;
    }

    public function setDateCreated(\DateTimeInterface $date_created): self
    {
        $this->date_created = $date_created;

        return $this;
    }

    public function getDateUpdated(): ?\DateTimeInterface
    {
        return $this->date_updated;
    }

    public function setDateUpdated(\DateTimeInterface $date_updated): self
    {
        $this->date_updated = $date_updated;
        return $this;
    }
}
