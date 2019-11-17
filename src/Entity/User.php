<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\UserInterface;
use App\Annotations\InternalUser;


/**
* @ORM\Entity
* @UniqueEntity(fields="email", message="Email already taken")
* @InternalUser
*/
class User implements UserInterface 
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
    
     /**
     * @ORM\Column(type="string", length=255, unique=true)
     * @Assert\NotBlank()
     * @Assert\Email()
     */
    private $email;

  
    /**
     * @Assert\NotBlank()
     * @Assert\Length(max=4096)
     */
    private $plainPassword;
    private $roles;
    /**
     * The below length depends on the "algorithm" you use for encoding
     * the password, but this works well with bcrypt.
     *
     * @ORM\Column(type="string", length=64)
     */
    private $password;
    
    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank()
     */
    private $type;
    
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
    
    public function getType(): ?string
    {
        return $this->type;
    }
    
    public function setType(string $type): self
    {
        $this->type = $type;
        
        return $this;
    }
    public function getPlainPassword()
    {
        return $this->plainPassword;
    }
    
    public function setPlainPassword($password)
    {
        $this->plainPassword = $password;
    }


    public function getUsername(): string
    {
        return (string) $this->email;
    }

   // public function getRoles(){}
     public function getRoles(): array
    {
        return (array) $this->roles;

    }

    public function setRoles(string $roles): self
    {
        $this->roles = $roles;

        return $this;
    } 

    /**
     * @see UserInterface
     */
    public function getPassword(): string
    {
        return (string) $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getSalt()
    {
        // not needed when using the "bcrypt" algorithm in security.yaml
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }
    
    
    protected $loginRecords;
    
    public function __construct()
    {
        // ...
        $this->loginRecords = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    public function addLoginRecord(LoginRecord $loginRecord)
    {
        $this->loginRecords[] = $loginRecord;
        $loginRecord->setUser($this);
        
       return $this;
    
      
    }
    
    public function removeLoginRecord(LoginRecord $loginRecord)
    {
        $this->loginRecords->removeElement($loginRecord);
    }
    
    
    public function getLoginRecords()
    {
        return $this->loginRecords;
    }
}
