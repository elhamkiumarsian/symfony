<?php


namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Login
 *
 * @ORM\Table(name="login")
 * @ORM\Entity()
 */
class Login
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
    
    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=255)
     */
    private $email;
    
    /**
     * @var string
     *
     * @ORM\Column(name="ip", type="string", length=15)
     */
    private $ip;
    
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="timestamp", type="datetime")
     */
    private $timestamp;
    
    /**
     * @var boolean
     *
     * @ORM\Column(name="success", type="boolean")
     */
    private $success;
    
    
    public function __construct()
    {
        $this->timestamp = new \DateTime();
    }
    
    //... getters and setters
    public function getId(): ?int
    {
        return $this->id;
    }
    
    public function getEmail(): ?string
    {
        return $this->email;
    }
    
    public function setEmail(string $email): self
    {
        $this->email = $email;
        
        return $this;
    }
    
    public function getUsername(): ?string
    {
        return $this->email;
    }
    
    public function setUsername(string $email): self
    {
        $this->email = $email;
        
        return $this;
    }
    
    public function getIp(): ?string
    {
        return $this->ip;
    }
    
    public function setIp(string $ip): self
    {
        $this->ip = $ip;
        
        return $this;
    }
    
    public function getSuccess(): ?string
    {
        return $this->success;
    }
    
    public function setSuccess(string $success): self
    {
        $this->success = $success;
        
        return $this;
    }
    
}