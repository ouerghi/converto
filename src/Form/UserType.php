<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
	        ->add('fullName', TextType::class, array(
	        	'label' => 'Nom & Prénom',
		        'attr' => array('class' => 'form-control form-control-lg', 'placeholder' => 'Nom & prénom')
	        ))
            ->add('username', TextType::class, array(
            	'label' => 'Login',
            	'attr' => array('class' => 'form-control form-control-lg', 'placeholder' => 'Login')
            ))
	        ->add('password', PasswordType::class, array(
	        	'attr' => array('class' => 'form-control form-control-lg', 'placeholder' => 'Password')
	        ))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
	        'attr' => ['class' => 'form-horizontal m-t-20']
        ]);
    }
}
