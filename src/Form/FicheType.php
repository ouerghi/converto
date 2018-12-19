<?php

namespace App\Form;

use App\Entity\Admin;
use App\Entity\Agent;
use App\Entity\Client;
use App\Entity\Fiche;
use App\Repository\ClientRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
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
            ->add('contactPerson', TextType::class)
            ->add('type', ChoiceType::class, array(
            	'choices' => array(
            		'Pro' => 'pro',
		            'Particulier' => 'particulier'
	            )
            ))
            ->add('tel', TelType::class)
            ->add('address', TextType::class)
            ->add('zipCode', TextType::class)
            ->add('city', TextType::class)
            ->add('mail', EmailType::class)
            ->add('comment', TextareaType::class)
            ->add('client', EntityType::class, array(
            	'class' => Client::class,
	            'query_builder' => function(ClientRepository $cr) use ($agent) {
            		$res =  $cr->createQueryBuilder('c')
            		->andWhere('c.agent = :agent')
		            ->setParameter('agent', $agent);
            		dump($res->getQuery()->getResult());
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
        ])
        ->setRequired('agent')
        ->setAllowedTypes('agent', array(Agent::class, Admin::class));
    }
}
