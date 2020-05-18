<?php

namespace App\Form;

use App\Entity\Bloc;
use App\Entity\Categorie;
use App\Entity\Space;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CategorieType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, ['label' => false])
//            ->add('created_date')
//            ->add('level')
//            ->add('image')
//            ->add('isarchiv')
//            ->add('id_space', EntityType::class, [
//                'class' => Space::class,
//                'choice_label' => 'name',
//                'label' => 'Espace lié',
//                'required' => true,
//                'choices' => $options['attr']["user"]->getSpacesMember(),
//            ])
//            ->add('id_owner')
//            ->add('categorie')
//            ->add('id_bloc')

        ;
        }
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Categorie::class,
        ]);
    }
}
