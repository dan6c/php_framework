<?php
namespace App\Z\HttpKernel;

use Symfony\Component\HttpFoundation\Response;

    interface HttpKernelInterface {
        /**
         * cette méthode du noyan lui permet de soumettre la requête 
         * et de récupérer la réponse correspondante
         * 
         * grâce au router 
         * @return void Response
         */
        
        public function handleRequest(): Response;
    }