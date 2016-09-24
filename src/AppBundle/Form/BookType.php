<?php
namespace AppBundle\Form;


use AppBundle\Entity\Author;
use AppBundle\Entity\Book;
use AppBundle\Repository\AuthorRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BookType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title')
            ->add('author', EntityType::class, [
                'class' => Author::class,
                'query_builder' => function (AuthorRepository $repo) {
                    return $repo->createAlphabeticalQueryBuilder();
                },
                'placeholder' => 'Choose the Author'
            ])
            ->add('description', TextareaType::class)
            ->add('pages')
            ->add('publishedAt', DateType::class, [
                'widget' => 'single_text',
                'attr' => [
                    'data-provide' => 'datepicker',
                    'data-date-format' => 'yyyy-mm-dd'
                ],
                'html5' => false
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Book::class
        ]);
    }
}