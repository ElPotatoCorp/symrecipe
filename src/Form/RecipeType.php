<?php

namespace App\Form;

use App\Entity\Recipe;
use App\Entity\Ingredient;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RecipeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'attr' => [
                    'class' => 'form-control',
                    'minlength' => 2,
                    'maxlength' => 50,
                ],
                'label' => 'Nom',
                'label_attr' => ['class' => 'form-label mt-4'],
            ])

            ->add('time', IntegerType::class, [
                'required' => false,
                'attr' => ['class' => 'form-control'],
                'label' => 'Temps (min)',
                'label_attr' => ['class' => 'form-label mt-4'],
            ])

            ->add('nbPersons', IntegerType::class, [
                'required' => false,
                'attr' => ['class' => 'form-control'],
                'label' => 'Nombre de personnes',
                'label_attr' => ['class' => 'form-label mt-4'],
            ])

            ->add('difficulty', IntegerType::class, [
                'required' => false,
                'attr' => ['class' => 'form-control'],
                'label' => 'Difficulté (1 à 10)',
                'label_attr' => ['class' => 'form-label mt-4'],
            ])

            ->add('description', TextareaType::class, [
                'attr' => ['class' => 'form-control'],
                'label' => 'Description',
                'label_attr' => ['class' => 'form-label mt-4'],
            ])

            ->add('price', MoneyType::class, [
                'required' => false,
                'attr' => ['class' => 'form-control'],
                'label' => 'Prix',
                'label_attr' => ['class' => 'form-label mt-4'],
            ])

            ->add('isFavorite', CheckboxType::class, [
                'required' => false,
                'label' => 'Favori ?',
                'label_attr' => ['class' => 'form-check-label mt-4'],
                'attr' => ['class' => 'form-check-input'],
            ])

            ->add('ingredients', EntityType::class, [
                'class' => Ingredient::class,
                'choice_label' => 'name',
                'multiple' => true,
                'expanded' => true,
                'label' => 'Ingrédients',
                'label_attr' => ['class' => 'form-label mt-4'],
            ])

            ->add('submit', SubmitType::class, [
                'attr' => ['class' => 'btn btn-primary mt-4'],
                'label' => 'Enregistrer',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Recipe::class,
        ]);
    }
}
