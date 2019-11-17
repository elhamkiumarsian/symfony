<?php


namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Entity\User;

class Contractor extends User
{
    public $type;
    
    
    
}