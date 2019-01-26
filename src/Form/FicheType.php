<?php

namespace App\Form;
use App\Entity\Agent;
use App\Entity\Client;
use App\Entity\Fiche;
use App\Repository\ClientRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class FicheType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
	    /** @var Agent $agent */
	    $agent = $options['agent'];

        $builder
            ->add('contactPerson', TextType::class, array(
            	'label' => 'Contact',
            	'attr'=> ['class' => 'form-control', 'placeholder' => 'Contact'],
	            'help' => 'Ce champ est obligatoire',
	            'help_attr' => ['class' => 'form-text text-muted'],
            ))
            ->add('type', ChoiceType::class, array(
	            'label' => 'Type de Contact',
	            'attr'=> ['class' => 'custom-select col-12', 'placeholder' => 'Type Contact'],
	            'help' => 'Ce champ est obligatoire',
	            'help_attr' => ['class' => 'form-text text-muted'],
            	'choices' => array(
            		'Pro' => 'pro',
		            'Particulier' => 'particulier'
	            )
            ))
            ->add('tel', TelType::class, array(
            	'required' => false,
            	'label' => 'Téléphone',
	            'attr'=> ['class' => 'form-control', 'placeholder' => 'Tel du Contact'],
	            'help_attr' => ['class' => 'form-text text-muted'],
            ))
            ->add('address', TextType::class, array(
	            'label' => 'Adresse',
	            'attr'=> ['class' => 'form-control', 'placeholder' => 'Adresse Contact'],
	            'required' => false,
            ))
            ->add('zipCode', TextType::class, array(
	            'label' => 'Code Postale',
	            'attr'=> ['class' => 'form-control', 'placeholder' => 'Code Postale'],
	            'required' => false,
            ))
            ->add('city', TextType::class, array(
	            'label' => 'Ville',
	            'attr'=> ['class' => 'form-control', 'placeholder' => 'Ville'],
	            'required' => false,
            ))
            ->add('mail', EmailType::class, array(
	            'label' => 'Email',
	            'required' => false,
	            'attr'=> ['class' => 'form-control', 'placeholder' => 'Email'],
	            'help_attr' => ['class' => 'form-text text-muted'],
            ))
            ->add('comment', TextareaType::class, array(
	            'label' => 'Commentaire',
	            'attr'=> ['class' => 'form-control', 'placeholder' => 'Commentaire'],
	            'required' => false,
            ))
            ->add('client', EntityType::class, array(
	            'label' => 'Liste des Clients',
	            'placeholder' => 'Liste des Clients',
	            'attr'=> ['class' => 'select2 form-control custom-select', 'style' => 'width: 100%; height:36px;'],
	            'help' => 'Ce champ est obligatoire',
	            'help_attr' => ['class' => 'form-text text-muted'],
            	'class' => Client::class,
	            'query_builder' => function(ClientRepository $cr) use ($agent) {
            		$res =  $cr->createQueryBuilder('c')
            		->andWhere('c.agent = :agent')
		            ->setParameter('agent', $agent);
            		return $res;
	            },
	            'choice_label' => 'fullName',
	            'multiple' => false,
            ))

        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver
	    ->setDefaults([
            'data_class' => Fiche::class,
		    'agent' => null
        ]);

//        ->setRequired('agent')
//        ->setAllowedTypes('agent', array(Agent::class, Admin::class));
    }
}
