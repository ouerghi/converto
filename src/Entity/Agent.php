<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\AgentRepository")
 */
class Agent extends User
{

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Client", mappedBy="agent")
     */
    private $clients;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Fiche", mappedBy="agent")
     */
    private $fiches;

    public function __construct()
    {
        parent::__construct();
        $this->clients = new ArrayCollection();
        $this->fiches = new ArrayCollection();
    }


    /**
     * @return Collection|Client[]
     */
    public function getClients(): Collection
    {
        return $this->clients;
    }

    public function addClient(Client $client): self
    {
            $this->clients[] = $client;
            $client->setAgent($this);

        return $this;
    }

    public function removeClient(Client $client): self
    {
        if ($this->clients->contains($client)) {
            $this->clients->removeElement($client);
            // set the owning side to null (unless already changed)
            if ($client->getAgent() === $this) {
                $client->setAgent(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Fiche[]
     */
    public function getFiches(): Collection
    {
        return $this->fiches;
    }

    public function addFiches(Fiche $fiches): self
    {
        if (!$this->fiches->contains($fiches)) {
            $this->fiches[] = $fiches;
            $fiches->setAgent($this);
        }

        return $this;
    }

    public function removeFiches(Fiche $fiches): self
    {
        if ($this->fiches->contains($fiches)) {
            $this->fiches->removeElement($fiches);
            // set the owning side to null (unless already changed)
            if ($fiches->getAgent() === $this) {
                $fiches->setAgent(null);
            }
        }

        return $this;
    }


}
