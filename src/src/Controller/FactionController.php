<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Faction;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

class FactionController extends AbstractController
{
    function __construct(EntityManagerInterface $em, SerializerInterface $serializer) {
        $this->em = $em;
        $encoder = new JsonEncoder();
        $defaultContext = [
            AbstractNormalizer::CIRCULAR_REFERENCE_HANDLER => function ($object, $format, $context) {
                return $object->getId();
            },
        ];
        $normalizer = new ObjectNormalizer(null, null, null, null, null, null, $defaultContext);
        $this->serializer = new Serializer([$normalizer], [$encoder]);
    }

    /**
     * @Route("/faction/all", name="all-factions")
     */
    public function all(): Response
    {
        $factions = $this->em->getRepository(Faction::class,'faction')->findAll();
        return $this->json($factions);
    }

    /**
     * @Route("/faction/{id}", name="view-faction")
     */
    public function view(String $id): Response
    {
        $faction = $this->em->getRepository(Faction::class,'faction')->findOneById($id);
        return $this->json(
            $faction ? json_decode($this->serializer->serialize($faction,'json')) : false
        );
    }
}
