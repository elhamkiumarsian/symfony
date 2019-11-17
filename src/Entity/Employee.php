<?php
namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Entity\User;
use App\Annotations\InternalUser;


class Employess extends User
{
    /** @InternalUser(type="Employess") */
   // public $direction;    
    
}