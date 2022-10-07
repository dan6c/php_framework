<?php
namespace App\Controller;

    class CountryController {
        #[Route('/', name : "country.index", method : ['GET'])]

        public function index() {
            dd('page index');
        }
    }