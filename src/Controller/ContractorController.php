<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ContractorController
{
    
    /**
     * @Route("/contractor" , name="app_contractor")
     */
    public function employeeView()
    {

        return new Response(
            '<html><body><h1>loged in as Contractor</h1></body></html>'
        );
    }
    
}