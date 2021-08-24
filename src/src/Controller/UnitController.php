<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Unit;
use App\Entity\Faction;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

class UnitController extends AbstractController
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
     * @Route("/units/factions/{id}", name="units-by-faction")
     */
    public function all(String $id): Response
    {
        $units = $this->em->getRepository(Faction::class,'faction')->find($id)->getFactionUnits();
        return $this->json(json_decode($this->serializer->serialize($units,'json',['groups' => 'main'])));
    }

    /**
     * @Route("/units/{id}", name="view-unit")
     */
    public function view(String $id): Response
    {
        $unit = $this->em->getRepository(Unit::class,'unit')->findOneById($id);
        return $this->json(
            $unit ? json_decode($this->serializer->serialize($unit,'json',['groups' => 'main'])) : false
        );
    }
}
