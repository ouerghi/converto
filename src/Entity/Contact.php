<?php

namespace App\Entity;

use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class Contact
 * @package AppBundle\Entity
 */
class Contact
{
	/**
	 * @var string $name
	 * @Assert\NotBlank()
	 * @Assert\Length(min="4", minMessage="Cette valeur est trop courte. Il doit comporter 4 caractères ou plus.")
	 */
	private $name;
	/**
	 * @var string $email
	 * @Assert\Email(message="Votre adresse email n'est pas valide")
	 */
	private $email;
	/**
	 * @var string $message
	 * @Assert\Length(min="10", max="255", minMessage="Cette valeur est trop courte. Il doit comporter 4 caractères ou plus.")
	 */
	private $message;

	/**
	 * @return string
	 */
	public function getName() {
		return $this->name;
	}

	/**
	 * @param string $name
	 *
	 * @return Contact
	 */
	public function setName(  $name ) {
		$this->name = $name;

		return $this;
	}

	/**
	 * @return string
	 */
	public function getEmail() {
		return $this->email;
	}

	/**
	 * @param string $email
	 *
	 * @return Contact
	 */
	public function setEmail( $email ) {
		$this->email = $email;

		return $this;
	}

	/**
	 * @return string
	 */
	public function getMessage() {
		return $this->message;
	}

	/**
	 * @param string $message
	 *
	 * @return Contact
	 */
	public function setMessage( $message ) {
		$this->message = $message;

		return $this;
	}



}