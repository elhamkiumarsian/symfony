<?php

namespace App\Tests\Registration;

use App\Entity\User;
use App\Salary\SalaryCalculator;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\Persistence\ObjectRepository;
use PHPUnit\Framework\TestCase;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Doctrine\ORM\EntityManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class contractorTest extends WebTestCase{
    /** @var \Doctrine\ORM\EntityManager */
    private $em;
    
    public function testcontractor()
    {
        $client = static::createClient(array(),
            array(
                'HTTP_HOST' => 'locahost'
                
            ));
       
        $em =  $client
        ->getContainer()
        ->get('doctrine')
        ->getManager();
        
        $findUser=$em
        ->getRepository('App:User')
        ->findOneByEmail('contractor@gmail.com');
        
        
        if (!$findUser) {
                $user = new User;
                
                $user->setEmail('contractor@gmail.com');
                $user->setType('contractor');
                $user->setPassword(password_hash('password', 1));
                $em->persist($user);
                $em->flush();
            }
            
            $loginpage = $client->request('GET', '/login');
            $form = $loginpage->selectButton('Sign in')->form(array(
                'email' => 'contractor@gmail.com','password' => 'password'
            ),'POST');
        
        
        $client->submit($form);
        $this->assertTrue($client->getResponse()->isRedirect());
        $loginpage = $client->followRedirect();
       
        
        // We verify that we have a 200 status code.
        $this->assertEquals(200, $client->getResponse()->getStatusCode()); 
        
        $this->assertTrue($loginpage->filter('html:contains("loged in as Contractor")')->count() > 0);
    }
}
