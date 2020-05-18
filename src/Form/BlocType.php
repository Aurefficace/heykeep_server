<?php

namespace App\Form;

use App\Entity\Bloc;
use App\Entity\Space;
use App\Entity\Element;
use App\Form\ElementType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;


class BlocType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
//            ->add('created_date')
            ->add('title',TextType::class, ['label' => 'Titre'])
            ->add('description', TextType::class, ['label' => 'Description'])
//            ->add('isarchiv')
            ->add('ispublic')
//            ->add('id_owner')
            ->add('idSpace', EntityType::class, [
                'class' => Space::class,
                'choice_label' => 'name',
                'label' => 'Espace lié',
                'required' => true,
                'choices' => $options['attr']["user"]->getSpacesMember(),
            ])

            ->add('element', ElementType::class, ['label' => 'Element proprement dit :'])
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
