<?php

namespace App\Form;

use App\Entity\Discussion;
use App\Entity\Space;
use App\Entity\User;
use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DiscussionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $discussion = $builder->getData();
        $builder
            ->add('name')
            ->add('ispublic')
            ->add('id_space', EntityType::class, [
                'class' => Space::class,
                'query_builder' => function(EntityRepository $er)use ($options) {
                    return $er->createQueryBuilder('sp')
                        ->leftJoin('sp.id_owner' , 'id')
                        ->where('id = :val')
                        ->setParameter('val',$options['attr']['idUser'])
                        ->orderBy('sp.name', 'ASC');
                },
                'choice_label' => 'name',
            ])
            ->add('id_user', EntityType::class, [
                'class' => User::class,
                'choice_label' => 'name',
                'choices' =>  $discussion->getIdUser(),
                'multiple' => true
            ])
            ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Discussion::class,
        ]);
    }
}
