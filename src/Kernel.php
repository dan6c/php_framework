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

        // Cette propriété représente le noyau dans lui-même ---
        private static $kernel;

        // A chaque fois qu'une nouvelle instance du noyau est créé : 
        //      - On récupère le conteneur de dépendances
        // @param ContainerInterface $container

        public function __construct($container) {
            self::$kernel = $this;
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
            // dd($router_response);

            // le KERNEL appelle le CONTROLEUR concerné et récupère sa réponse ---
            return $this->getControllerResponse($router_response); 
        }
        private function getControllerResponse($router_response) : Response {
            
            // Si la réponse du routeur n'est pas un tableau et qu'elle est nulle,
            if (!is_array($router_response) && ($router_response === null)){

                // Le noyau appelle le contrôleur qui est censé gérer les erreurs ---
                $controller_needed = $this->container->get('controllers')['ErrorController'];
                
                $error_controller = new $controller_needed();
                return $error_controller->notFound();
                // Il lui demande ensuite de s'exécuter et de lui retourner ce que contient comme réponse sa méthode notFound();
            }

            // Si la réponse du router est un tableau et que ce n'est pas vide ---
            if ( is_array($router_response) && !empty($router_response)){
                $controller = $router_response["route"]["class"];
                $method = $router_response["route"]["method"];

                // dd($controller);
            }

                // S'il y a des paramètres, le noyau demande au contrôleur de s'exécuter 
                // en lui passant en arguments, les paramètres
                // et de lui retourner ce que contient comme réponse sa méthode concernée;
                if ( isset($router_response["parameters"]) && !empty($router_response["parameters"])) {
                    $parameters =$router_response["parameters"];
                    return $this->call([$controller, method],[$parameters]);
                }
                
                // Dans le cas contraire, le noyau demande au contrôleur de s'exécuter 
                // en ne lui passant aucun paramètre
                // et de lui retourner ce que contient comme réponse sa méthode concernée;
                return $this->container->call([$controller, $method]);
        }

        public static function getKernel() {
            return self::$kernel;
        }

        public function getContainer(){
            return $this->container;
        }
    }