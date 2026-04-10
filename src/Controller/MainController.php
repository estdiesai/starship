<?php

declare(strict_types=1);

namespace App\Controller;

use App\Repository\StarshipRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Console\Input\ArrayInput;
use Symfony\Component\Console\Output\BufferedOutput;
use Symfony\Component\DependencyInjection\Attribute\Autowire;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Contracts\Cache\CacheInterface;
use Symfony\Contracts\Cache\ItemInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class MainController extends AbstractController
{
    #[Route('/')]
    public function homepage(StarshipRepository $starshipRepository, 
        HttpClientInterface $client, 
        CacheInterface $issLocationPool, 
        #[Autowire(param: 'iss_location_cache_ttl')]
        $issLocationPoolonCacheTtl)
        : Response
    {
        //dd($this->getParameter('iss_location_cache_ttl'));
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
        
        // para que la petición sea más rápida utilizamos la caché
        $issData = $issLocationPool->get('iss_location_data', function () use ($client): array {
            
            // Hace una petición http a una API que nos va a devolver la coordenadas
            $response = $client->request('GET', 'https://api.wheretheiss.at/v1/satellites/25544');
            return $response->toArray();
            // al poner dump en la barra aparece un simbolo nuevo con la información y si lo pulsas se abre el profiler
            //dump($issData);
        });
  
        // Para hacer el recuento dentro de Twig, eliminamos la variable starShipCount y le pasamos ships
        return $this->render('main/homepage.html.twig', [
            'numberOfStarships' => $starshipCount,
            'myShip' => $myShip,//matriz asociativa
            'ships' => $ships,//objeto
            'issData' => $issData
        ]);
    }
}
