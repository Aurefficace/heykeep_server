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
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormInterface;
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
                'query_builder' => function(EntityRepository $er)use ($options) {
                    return $er->createQueryBuilder('sp')
                        ->leftJoin('sp.id_owner' , 'id')
                        ->where('id = :val')
                        ->setParameter('val',$options['attr']['idUser'])
                        ->orderBy('sp.name', 'ASC');
                },
                'choice_label' => 'name',
                'placeholder' => 'Sélectionnez un espace',
                'required' => true
            ])
            ->add('id_user', EntityType::class, [
                'class' => User::class,
                'choices' => [],            // Initialise à vide
                'choice_label' => 'name',
                'multiple' => true,
                'placeholder' => 'Sélectionnez des participants',
            ])
            ;

        $builder->get('id_space')->addEventListener( // Ajout d'un évènement après la soumission du formulaire
            FormEvents::POST_SUBMIT,
            function(FormEvent $event) {
                $form = $event->getForm();
                $this->setupUsersFieldFromSpace( // Initialise les utilisateurs possibles en fonction de l'espace sélectionné
                    $form->getParent(), $form->getData()
                );
            }
        );
    }

    private function setupUsersFieldFromSpace(FormInterface $form, ?Space $space) {
        if (null === $space) { // Si l'espace est null => pas d'utilisateurs possibles => ne doit pas arriver
            $form->remove('id_user');
            return;
        }
        $form->add('id_user', EntityType::class, [
            'choices' => $space->getIdMember(), // liste les membres de l'espace
            'class' => User::class,
            'multiple' => true,
        ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Discussion::class,
        ]);
    }
}
