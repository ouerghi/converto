<?php
namespace App\Services;

use App\Entity\Contact;
use Symfony\Bundle\FrameworkBundle\Templating\EngineInterface;


class SendMail
{
	/**
	 * @var \Swift_Mailer $mailer
	 */
	private $mailer;
	/**
	 * @var EngineInterface
	 */
	private $templating;

	public function __construct(\Swift_Mailer $mailer, \Twig_Environment $templating)
	{

		$this->mailer = $mailer;
		$this->templating = $templating;
	}

	/**
	 * @param Contact $contact
	 *
	 * @throws \Twig_Error_Loader
	 * @throws \Twig_Error_Runtime
	 * @throws \Twig_Error_Syntax
	 */
	public function sendMail($contact)
	{
		$message = (new \Swift_Message('Contact Email'))
			->setFrom('contact@chatconverto.com')
			->setTo('contact@chatconverto.com')
			->setBody(
				$this->templating->render(
				// templates/emails/registration.html.twig
					'home/emails/contact.html.twig',
					array('contact' => $contact)
				),
				'text/html'
			)
			;

		$this->mailer->send($message);
	}
}