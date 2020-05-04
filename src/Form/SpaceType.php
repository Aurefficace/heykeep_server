<?php

namespace App\Form;

use App\Entity\Space;
use App\Entity\User;
use PUGX\AutocompleterBundle\Form\Type\AutocompleteType;
use Symfony\Component\Form\AbstractType;
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
            ->add('id_member', AutocompleteType::class, ['class' => User::class])
            ->add('imagefile', FileType::class, [
                'label'  => 'Choisissez votre image d\'espace',
                'required' => false,
            ]);
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Space::class,
        ]);
    }
}
