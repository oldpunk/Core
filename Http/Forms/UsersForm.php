<?php

namespace Modules\Core\Http\Forms;

use Modules\Core\Entities\Modules;
use Kris\LaravelFormBuilder\Form;

class UsersForm extends Form
{
    public function buildForm()
    {
        $this
            ->add('name', 'text', [
                'rules' => 'required|min:3',
                'label' => 'Имя'
            ])
            ->add('login', 'text', [
                'rules' => 'required|min:3',
                'label' => 'Логин'
            ])
            ->add('email', 'email', [
                'rules' => 'email',
                'label' => 'E-mail'
            ])
            ->add('avatar', 'image', [
                'rules' => 'max:2048|mimes:jpg,jpeg,png,gif',
            ])
            ->add('password','repeated', [
                'type' => 'password',
                'value' => '',
                'first_options' => [
                    'label' => 'Пароль',
                ],
                'second_options' => [
                    'label' => 'Подтвердите пароль'
                ]
            ]);
        ;

        if ($this->getData('is_admin') === true) {
            $this->add('modules',  'entity', [
                'class' => Modules::class,
                'property' => 'title',
                'multiple' => true,
                'selected' => function ($data) {
                    return $data ? array_pluck($data, 'id') : [];
                },
                'attr' => [
                    'class' => 'multi-select'
                ]
            ]);
            $this->add('is_admin', 'checkbox', [
                'label' => 'Админ'
            ]);
        }
    }

    public function alterFieldValues(array &$values)
    {
//        dd($values);
    }
}
