<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class RegistrationFormType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email', EmailType::class, [
                'label'  => 'E-mail*',
            ])
            ->add('name', TextType::class, [
                'label'  => 'Pseudo*',
            ])
            ->add('agreeTerms', CheckboxType::class, [
                'mapped' => false,
                'label'  => "J'ai lu et j'accepte les conditions générales d'utilisation*",
                'constraints' => [
                    new IsTrue([
                        'message' => 'Merci de valider les conditions générales d\'utilisation.',
                    ]),
                ],
            ])
            ->add('password', RepeatedType::class, array(
                'type' => PasswordType::class,
                'required' => true,
                'constraints' => array(
                    new NotBlank([
                        'message' => 'Merci de choisir un mot de passe',
                    ]),
                    new Length([
                        'min' => 6,
                        'minMessage' => 'Votre mot de passe doit se composer de {{ limit }} caractères minimum',
                        // max length allowed by Symfony for security reasons
                        'max' => 4096,
                    ]),
                ),
                'first_options'  => array('label'  => 'Mot de passe*'),
                'second_options' => array('label'  => 'Confirmez Mot de passe*'),
            ))
            ->add('avatar', FileType::class, [
                'label'  => 'Choisissez votre Avatar*',
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
