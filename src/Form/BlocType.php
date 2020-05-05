<?php

namespace App\Form;

use App\Entity\Bloc;
use App\Entity\Space;
use App\Entity\Element;
use App\Form\ElementType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BlocType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
//            ->add('created_date')
            ->add('title')
            ->add('description')
//            ->add('isarchiv')
            ->add('ispublic')
//            ->add('id_owner')
            ->add('id_space', EntityType::class, [
                'class' => Space::class,
                'choice_label' => 'name',
                'label' => 'Espace lié',
                'required' => true,
                'choices' => $options['attr']["user"]->getSpacesMember(),
            ])

            ->add('element', ElementType::class)
//            ->add('id_message')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Bloc::class,
        ]);
    }
}
