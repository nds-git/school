<?php

namespace App\Controller\Form;

use App\Controller\Web\User\UserForm\v1\Input\CreateUserDTO;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\AbstractType;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('login', TextType::class, [
                'label' => 'Логин пользователя',
                'attr' => [
                    'data-time' => time(),
                    'placeholder' => 'Логин пользователя',
                    'class' => 'user-login',
                ],
            ]);

        $builder
            ->add('name', TextType::class, [
                'label' => 'Имя пользователя',
                'attr' => [
                    'data-time' => time(),
                    'placeholder' => 'Имя пользователя',
                    'class' => 'user-name',
                ],
            ]);

        $builder->add('password', PasswordType::class, [
            'label' => 'Пароль пользователя',
        ]);

        $builder
            ->add('age', IntegerType::class, [
                'label' => 'Возраст',
            ]);
        $builder
            ->add('isActive', IntegerType::class, [
                'required' => false,
                'data' => 0,
            ])
            ->add('submit', SubmitType::class)
            ->setMethod($options['isNew'] ? 'POST' : 'PATCH');
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => CreateUserDTO::class,
            'empty_data' => new CreateUserDTO(),
            'isNew' => false,
        ]);
    }

    public function getBlockPrefix(): string
    {
        return 'save_user';
    }
}
