<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\FilterRepository")
 */
class Filter
{


	/**
	 * @ORM\Id()
	 * @ORM\GeneratedValue()
	 * @ORM\Column(type="integer")
	 */
	private $id;

    /**
     * @var \DateTime $start
     * @Assert\Date()
     */
    private $start;

    /**
     * @var \DateTime $end
     * @Assert\Date()
     */
    private $end;

	/**
	 * @return int
	 */
	public function getId(): int {
		return $this->id;
	}



    public function getStart(): ?\DateTime
    {
        return $this->start;
    }

    public function setStart(\DateTime $start): self
    {
        $this->start = $start;

        return $this;
    }

    public function getEnd(): ?\DateTime
    {
        return $this->end;
    }

    public function setEnd(\DateTime $end): self
    {
        $this->end = $end;

        return $this;
    }
}
