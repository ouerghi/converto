<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ClientRepository")
 */
class Client extends User
{


    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Agent", inversedBy="clients")
     * @ORM\JoinColumn(onDelete="SET NULL")
     */
    private $agent;

	/**
	 * @var string $mail
	 * @ORM\Column(type="string")
	 */
    private $mail;


	/**
	 * @return string
	 */
	public function getMail(): ?string {
		return $this->mail;
	}

	/**
	 * @param string $mail
	 *
	 * @return Client
	 */
	public function setMail( string $mail ): Client {
		$this->mail = $mail;

		return $this;
	}



    public function getAgent(): ?Agent
    {
        return $this->agent;
    }

    public function setAgent(?Agent $agent): self
    {
        $this->agent = $agent;

        return $this;
    }
}
