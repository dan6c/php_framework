<?php
namespace App\Z\Routing;

    interface RouteInterface {
        // méthode de récupération de l'URI de la route ---
        // @return string 
        public function getPath(): string;

        // méthode de récupération de l'URI de la route ---
        // @return string 
        public function getName(): string;

        // méthode de récupération des MERTHODES ou VERBES DE pour accéder à la route ---
        // @return array 
        public function getMethods(): array;

        // méthode de varifiaction si l'URL de la route contient des params ---
        // @return array 
        public function hasParams(): bool;

        // Cette méthode récupère dans la clé du tableau des paramètres, leur nom
        // * @return array
        public function fetchParams() : array;
    }