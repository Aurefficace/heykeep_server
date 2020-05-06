<?php

namespace App\Form;

use App\DBAL\Types\ListeElementType;
use App\Entity\Bloc;
use App\Entity\Space;
use App\Entity\Element;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ElementType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('content', TextareaType::class, ['label' => 'Contenu'])
            ->add('type', ChoiceType::class, [
                'label' => 'Type',
                'required' => true,
                'choices' => ListeElementType::getChoices(),
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Element::class,
        ]);
    }
}
