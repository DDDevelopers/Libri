<?php

namespace AppBundle\Form;

use AppBundle\Entity\Review;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RateType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder ->add('rating', ChoiceType::class, [
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
        ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Review::class
        ]);
    }

    public function getName()
    {
        return 'app_bundle_rate_type';
    }
}
