<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProfileType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('firstname', TextType::class)
            ->add('middlename', TextType::class)
            ->add('lastname', TextType::class)
            ->add('birthdate', DateType::class)
            ->add('img', TextType::class)
            ->add('email', EmailType::class)
            ->add('username', TextType::class)
            ->add('bio', TextareaType::class, [
                'label' => 'Bio',
                'required' => false
            ])
            ->add('save', SubmitType::class)

            // ->add('password', PasswordType::class, [
            //     'required' => false
            // ])
            // ->add('rePassword', PasswordType::class, [
            //     'mapped' => false,
            //     'label' => 'Confirm Password',
            //     'required' => false
            // ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
