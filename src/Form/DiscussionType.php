<?php

namespace App\Form;

use App\Entity\Discussion;
use App\Entity\Space;
use App\Entity\User;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DiscussionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
      
        
        $builder
            ->add('name')
            ->add('ispublic')
            ->add('id_space', EntityType::class, [
                'class' => Space::class,
                'query_builder' => function(EntityRepository $er) {
                    return $er->createQueryBuilder('sp')
                        ->leftJoin('sp.id_owner' , 'id')
                        ->where('id = :val')
                        ->setParameter('val',13)
                        ->orderBy('sp.name', 'ASC');
                },
                'choice_label' => 'name',
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Discussion::class,
        ]);
    }
}
