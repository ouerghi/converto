<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 * @ORM\InheritanceType("SINGLE_TABLE")
 * @ORM\DiscriminatorColumn(name="discr", type="string")
 * @ORM\DiscriminatorMap({"agent"= "Agent", "client"="Client", "admin"="Admin"})
 */
Abstract class User implements UserInterface
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    protected $id;

    /**
     * @ORM\Column(type="string", length=180, unique=true)
     */
    protected $username;

    /**
     * @ORM\Column(type="json")
     */
    protected $roles;

	/**
	 * @var \DateTime $created
	 * @ORM\Column(type="datetime")
	 */
    protected $created;

    /**
     * @var string The hashed password
     * @ORM\Column(type="string")
     */
    protected $password;

	/**
	 * @var string $name
	 * @ORM\Column(type="string")
	 */
	protected $fullName;

	/**
	 * User constructor.
	 * @throws \Exception
	 */
	public function __construct()
    {
    	$this->created = new \DateTime();
    }

	public function getId(): ?int
	{
		return $this->id;
	}

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUsername(): string
    {
        return (string) $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        return $this->roles;

    }

    public function setRoles(string $roles): self
    {
        $this->roles[] = $roles;

        return $this;
    }

	/**
	 * @param \DateTime $created
	 *
	 * @return User
	 */
	public function setCreated( \DateTime $created ): User
	{
		$this->created = $created;
                     
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
	 * @return string
	 */
	public function getFullName(): ?string {
		return $this->fullName;
	}

	/**
	 * @param string $fullName
	 *
	 * @return User
	 */
	public function setFullName( string $fullName ): User {
		$this->fullName = $fullName;

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

}
