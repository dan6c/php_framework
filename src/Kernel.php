<?php
namespace App;

use App\Z\Routing\RouterInterface;
use Psr\Container\ContainerInterface;
use App\Z\HttpKernel\HttpKernelInterface;
use Symfony\Component\HttpFoundation\Response;

/**
     * --------------------------------------------------------------------------
     * Kernel
     * 
     * C'est le noyau de notre application
     * 
     * Ses rôles pricipaux : 
     *              - Soummettre la requête
     *              - Récupérer la réponse correspondante
     *              - Retourner cette réponse au "FrontController" (index.php)
     * 
     * @author: Jean-Claude AZIAHA <aziaha.formations@gmail.com>
     * @version: 1.0.0
     * --------------------------------------------------------------------------
    */

    class Kernel implements HttpKernelInterface {
        
        //  Cette propriété représente le conteneur de dépendances
        //  @var ContainerInterface
        
        private $container;
        
        // A chaque fois qu'une nouvelle instance du noyau est créé : 
        //      - On récupère le conteneur de dépendances
        //
        // @param ContainerInterface $container

        public function __construct($container) {
            $this->container = $container;
            // dd($this->$container);
        }

        // cette méthode du noyan lui permet de soumettre la requête 
        // et de récupérer la réponse correspondante
        // grâce au router 
        // @return void Response
        
        public function handleRequest(): Response {
            // le noyau récupère le routeur depuis le conteneur de dépendances ---
            $router = $this->container->get(RouterInterface::class);

            // le noyau demande au routeur de s'exécuter
            // puis le routeur retourne la réponse au noyau ---
            $router_response = $router->run();
            dd($router_response);
        }
    }