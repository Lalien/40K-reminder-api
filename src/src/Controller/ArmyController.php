<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Army;

class ArmyController extends AbstractController
{   
    /**
     * @Route("/army", name="army")
     */
    public function index(): Response
    {
        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/ArmyController.php',
        ]);
    }

    /**
     * @Route("/army/new", name="new-army", methods={"POST"})
     */
    public function newArmy(): Response
    {
        $entityManager = $this->getDoctrine()->getManager();
        $newArmy = new Army();
        $newArmy->setUserId(1);
        $newArmy->setFactionId(1);
        $newArmy->setDateCreated(new \DateTime());
        $newArmy->setDateUpdated(new \DateTime());
        $entityManager->persist($newArmy);
        $entityManager->flush();
        return $this->json([
            'user_id' => $newArmy->getUserId(),
            'id' => $newArmy->getId()
        ]);
    }
}
