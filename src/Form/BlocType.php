<?php

namespace App\Form;

use App\Entity\Bloc;
use App\Entity\Categorie;
use App\Entity\Space;
use App\Entity\Element;
use App\Form\ElementType;
use PetstoreIO\Category;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormInterface;
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
            ->add('categorie_id', EntityType::class, [
                'class' => Categorie::class,
                'choices' => [],
                'choice_label' => true,
                'multiple' => true,
                'placeholder' => 'choisissez une catégorie'
            ])
            ->add('element', ElementType::class,[
                'label' => 'Element proprement dit :'])
            // ->add('id_message')
        ;

        $builder->get('idSpace')->addEventListener( // Ajout d'un évènement après la soumission du formulaire
            FormEvents::POST_SUBMIT,
            function(FormEvent $event) {
                $form = $event->getForm();
             
                $this->setupCategoriesFieldFromSpace( // Initialise les catégories possibles en fonction de l'espace sélectionné
                    $form->getParent(), $form->getData()
                );
            }
        );
    }

    private function setupCategoriesFieldFromSpace(FormInterface $form, ?Space $space) {
        if (null === $space) { // Si l'espace est null => pas de categorie possibles => ne doit pas arriver
            $form->remove('categorie_id');
            return;
        }
        $form->add('categorie_id', EntityType::class, [
            'choices' => $space->getCategorie(), // liste des categories de l'espace
            'class' => Categorie::class,
            'multiple' => true,
        ]);
    }



    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Bloc::class,
        ]);
    }
}
