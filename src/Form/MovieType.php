<?php

namespace App\Form;

use App\Entity\{Movie, Person};
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class MovieType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $person = new Person();
        $builder
            ->add('title')
            ->add('date')
            ->add('producer', EntityType::class,[
                'class' => Person::class,
                'choice_label' => 'firstName'
            ])
            ->add('actors', EntityType::class,[
                'class' => Person::class,
                'choice_label' => 'firstName'
            ])

            ->add('save', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Movie::class,
        ]);
    }
}
