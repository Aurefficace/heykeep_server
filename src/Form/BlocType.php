<?php

namespace App\Form;

use App\Entity\Bloc;
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
//            ->add('id_space')
//            ->add('id_element')
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
