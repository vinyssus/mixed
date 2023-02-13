<?php

namespace App\Controller;

use App\Entity\VinylMixe;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MixeController extends AbstractController
{
    #[Route('/mixe/new')]
    public function new(EntityManagerInterface $entityManager): Response
    {
        $mix = new VinylMixe();
        $mix->setTitle('Do you Remember... Phil Collins?!');
        $mix->setDescription('A pure mix of drummers turned singers!');
        $mix->setGenre('pop');
        $mix->setTrackCount(rand(5, 20));
        $mix->setVotes(rand(-50, 50));
        $entityManager->persist($mix);
        $entityManager->flush();

        return new Response(sprintf(
            'mix %d is %d track of pure 80\'s heaven',
            $mix->getId(),
            $mix->getTrackCount(),
        ));
    }
}
