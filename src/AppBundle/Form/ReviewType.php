<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ReviewType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('rating', ChoiceType::class, [
                'choices' => [
                    1 => '1',
                    2 => '2',
                    3 => '3',
                    4 => '4',
                    5 => '5',
                ],
                'expanded' => false,
                'required' => true,
                'attr' => [
                    'class' => 'make_rating_beautiful'
                ]
            ])
            ->add('startedReading', TextType::class, [
                'attr' => [
                    'class' => 'show_the_calendar'
                ]
            ])
            ->add('finishedReading', TextType::class, [
                'attr' => [
                    'class' => 'show_the_calendar'
                ]
            ])
            ->add('review');
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => 'AppBundle\Entity\Review'
        ]);
    }

    public function getName()
    {
        return 'app_bundle_review_type';
    }
}
