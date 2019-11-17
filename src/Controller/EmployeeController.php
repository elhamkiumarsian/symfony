<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class EmployeeController
{
    
    /**
     * @Route("/employee" , name="app_employee")
     */
    public function employeeView()
    {

        return new Response(
            '<html><body><h1>loged in as Employee</h1></body></html>'
        );
    }
    
}