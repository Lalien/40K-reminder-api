<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Faction;
use Doctrine\ORM\EntityManagerInterface;

class FactionController extends AbstractController
{
    function __construct(EntityManagerInterface $em) {
        $this->em = $em;
    }

    /**
     * @Route("/faction/all", name="all-factions")
     */
    public function all(): Response
    {
        $factions = $this->em->getRepository(Faction::class,'faction')->findAll();
        return $this->json($factions);
    }
}
