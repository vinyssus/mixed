<?php

namespace App\Controller;

use App\Entity\VinylMixe;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MixeController extends AbstractController
{
    #[Route('/mixe/new')]
    public function index(): Response
    {
        $mix = new VinylMixe();
        $mix->setTitle('Do you Remember... Phil Collins?!');
        $mix->setDescription('A pure mix of drummers turned singers!');
        $mix->setGenre('pop');
        $mix->setTrackCount(rand(5, 20));
        $mix->setVotes(rand(-50, 50));
        dd($mix);
    }
}
