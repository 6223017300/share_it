<?php

namespace App\Controller;

use Doctrine\DBAL\Connection;
use Psr\Http\Message\ResponseInterface;

class HomeController extends AbstractController
{
    public function homepage(ResponseInterface $response, Connection $connection)
    {
        //$database = $connection->getDatabase();

        return $this->template($response, 'home.html.twig' );
            //'database_name' => $database,
            //'users' => ['Pierre', 'Paul', 'Jacque'],
            //'xss' => '<script> window.alert ("Coucou"); </script>'
       
    }

   /* public function test(){

        return $this->redirect('about');
    }

    public function about(ResponseInterface $response){

        $response->getBody()->write('<h1> A propos de nous </h1>');
        return $response;
    }*/

    public function download(ResponseInterface $response, int $id){
        $response->getBody()->write(sprintf('Identifiant: %d', $id));
        return $response;
    }
}
