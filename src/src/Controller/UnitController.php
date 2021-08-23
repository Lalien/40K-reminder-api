<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Unit;
use App\Entity\Faction;

class UnitController extends AbstractController
{
    function __construct(EntityManagerInterface $em) {
        $this->em = $em;
    }

    /**
     * @Route("/units/{id}", name="units")
     */
    public function all(String $id): Response
    {
        $faction = $this->em->getRepository(Faction::class,'unit')->find($id);
        $unit = $this->em->getRepository(Unit::class,'unit')->find(1);
        $abilities = $unit->getUnitAbilities()->getValues();
        return $this->json([]);
    }
}
