<?php

namespace App\Controller;

use App\Entity\Starship;
use App\Repository\StarshipRepository;
use Doctrine\ORM\EntityManagerInterface;
use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;


#[Route('/api/starships')]
class StarshipApiController extends AbstractController
{
    #[Route('')]
    // #[Route('', methods:['GET'])] // esta opción ahora no se puede probar
    public function getCollection(LoggerInterface $logger, StarshipRepository $repository): Response
    {
        $logger->info('Starship collection retrieved');
        $starships = $repository->findAll();

        return $this->json($starships);
    }

    #[Route('/{id<\d+>}')]
    // #[Route('/{id<\d+>}', methods:['GET'])]// esta opción ahora no se puede probar
    public function get(int $id, StarshipRepository $repository) : Response
    {        
        $starships = $repository->find($id);

        if(!$starships){
            throw $this->createNotFoundException('Starship not Found');
        }

        return $this->json($starships);
    }
    #[Route('/starships/{id<\d+>}', name: 'app_starship_show')]
    public function show(int $id, EntityManagerInterface $em): Response
    {
        $ship = $em->find(Starship::class, $id);
        if (!$ship) {
            throw $this->createNotFoundException('Starship not found');
        }
        return $this->render('starship/show.html.twig', [
            'ship' => $ship,
        ]);
    }
}