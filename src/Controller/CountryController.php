<?php
namespace App\Controller;

use App\Z\Routing\Route;
use App\Z\Abstract\AbstractController;
use Symfony\Component\HttpFoundation\Response;

    class CountryController extends AbstractController {
        
        #[Route('/', name : "country.index", methods : ['GET'])]
        public function index() : Response {
            $pays ="France";    
            return $this->render("country/index.html.twig", array('pays' => $pays) );
        }

        #[Route('/create', name : "country.create", methods : ['GET'])]
        public function create() {
            $response = new Response(
            'Page create',
            Response::HTTP_OK,
            ['content-type' => 'text/html']
            );
        }

        #[Route('/edit/{id}', name : "country.edit", methods : ['GET'])]
        public function edit($params) {
            $response = new Response(
                'Page edit avec le paramètre'. $params[0],
                Response::HTTP_OK,
                ['content-type' => 'text/html']
            );
        }
    }