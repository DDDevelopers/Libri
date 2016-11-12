<?php

namespace AppBundle\Form;

use AppBundle\Entity\Shelf;
use AppBundle\Entity\UserBookShelf;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BookToShelfType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('shelf', EntityType::class, [
            'class' => Shelf::class,
            'choice_label' => 'name',
            'choice_value' => 'id'
        ])->add('submit', SubmitType::class);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => UserBookShelf::class
        ]);
    }

    public function getName()
    {
        return 'app_bundle_book_to_shelf_type';
    }
}
