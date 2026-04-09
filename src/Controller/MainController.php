<?php

declare(strict_types=1);

namespace App\Controller;

use App\Repository\StarshipRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class MainController extends AbstractController
{
    #[Route('/')]
    public function homepage(StarshipRepository $starshipRepository): Response
    {
        //$starshipCount = 457;

        // return new Response('<strong>Starshop</strong>: your monopoly-busting option for Starship parts!');
        // return $this->render('main/homepage.html.twig');
        // return $this->render('main/homepage.html.twig', [
        //     'numberOfStarships' => $starshipCount,
        // ]);

        // Añadiendo el servicio
        $ships = $starshipRepository->findAll();
        $starshipCount = count($ships);
        $myShip = $ships[array_rand($ships)];
        
        // Para hacer el recuento dentro de Twig, eliminamos la variable starShipCount y le pasamos ships
        return $this->render('main/homepage.html.twig', [
            'numberOfStarships' => $starshipCount,
            'myShip' => $myShip,//matriz asociativa
            'ships' => $ships,//objeto
        ]);
    }
}
