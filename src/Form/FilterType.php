<?php

namespace App\Form;

use App\Entity\Filter;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class FilterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('start', DateType::class, array(
            	'label' => 'Date début',
	            'widget' => 'single_text',
	            // this is actually the default format for single_text
	            'format' => 'yyyy-MM-dd',
	            'attr' => array('class' => 'form-control'),
	            'placeholder' => array(
		            'year' => 'Year', 'month' => 'Month', 'day' => 'Day',
	            )

            ))
	        ->add('end', DateType::class, array(
		        'label' => 'Date fin',
		        'attr' => array('class' => 'form-control'),
		        'widget' => 'single_text',
		        // this is actually the default format for single_text
		        'format' => 'yyyy-MM-dd',
	        ))
	        ->add('Valider', SubmitType::class, array(
	        	'attr' => array('class' => 'btn btn-primary')
	        ))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Filter::class,
	        'attr' => array('class' => 'form-horizontal')
        ]);
    }
}
