<?php

namespace App\Form;

use App\Entity\Contact;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ContactType extends AbstractType
{
	public function buildForm(FormBuilderInterface $builder, array $options)
	{
		$builder
			->add('name', TextType::class, array(
				'attr' => array('class' => 'form-control', 'placeholder' => 'Nom & Prénom')
			))
			->add('email', EmailType::class, array(
				'attr' => array('class' => 'form-control', 'placeholder' => 'Email')
				))
			->add('message', TextareaType::class, array(
				'attr' => array('class' => 'form-control', 'placeholder' => 'Message', 'rows' => 10)
			))
			->add('Envoyer', SubmitType::class, array(
				'attr' => array('class' => 'btn contact-btn pull-right', 'data-anijs'=>'if: mouseover, do: pulse animated')
			))
			;

	}

	public function configureOptions(OptionsResolver $resolver)
	{
		$resolver->setDefaults([
			// Configure your form options here
			'data_class' => Contact::class
		]);
	}
}
