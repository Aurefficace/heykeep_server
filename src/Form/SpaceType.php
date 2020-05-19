<?php

namespace App\Form;

use App\Entity\Space;
use App\Entity\User;
use PUGX\AutocompleterBundle\Form\Type\AutocompleteType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SpaceType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, ['label' => 'Nom'])
            ->add('description', TextType::class, ['label' => 'Description'])
//            ->add('categorie', TextType::class, ['label' => 'Catégorie'])

            // Essai d'autocompletion, non fonctionnelle pour l'instant
//            ->add('tmpUser', AutocompleteType::class, ['class' => User::class])

            ->add('idMember', EntityType::class, [
                'class' => User::class,
                'choice_label' => 'name',
                'multiple' => true,
//                'placeholder' => 'Sélectionnez des participants',
                'label' => 'Participants',
                'required' => false,

            ])
            ->add('imagefile', FileType::class, [
                'label'  => 'Choisissez votre image d\'espace',
                'required' => false,
            ])



            ->add('categorie', CollectionType::class, [
                'entry_type' => CategorieType::class,
                'entry_options' => [
                    'label' => false,
                ],
                'label'        => 'Ajouter, supprimer ou éditer les catégories de l\'espace',
                'allow_add'    => true,
                'allow_delete' => true,
                'prototype'    => true,
                'required'     => false,
                'attr'         => [
                    'class' => 'selector-form-cat',
                ],
                'by_reference'=>false,

            ])



        ;
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Space::class,
        ]);
    }
}
