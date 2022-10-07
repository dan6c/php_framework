<?php
namespace App\Z\Routing;

    interface RouterInterface {
        
        /**   @return void */
    
    public function sortRoutesByName(array $controllers) : void;

    // Cette méthode du routeur permet de l'exécuter
    // Et elle nous retourne une réponse qui peut être : 
    //  - nulle si l'uri de l'url ne match pas avec l'uri de la route 
    //        dont l'application attend la réception
    //   - ou un tableau contenant le contrôleur censé gérer la requête si ça match 
    // @return array|null
    public function run() : ?array;
    }