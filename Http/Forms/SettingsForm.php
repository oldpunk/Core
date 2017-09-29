<?php

namespace Modules\Core\Http\Forms;

use Kris\LaravelFormBuilder\Form;

class SettingsForm extends Form
{
    public function buildForm()
    {
        $this
            ->add('email', 'text', [
                'label' => 'E-mail для заявок'
            ])
            ->add('email_official', 'text', [
                'label' => 'E-mail в контактах'
            ])
            ->add('phone', 'text', [
                'label' => 'Телефон'
            ])
            ->add('address_msk', 'text', [
                'label' => 'Адрес в Москве'
            ])
            ->add('address_spb', 'text', [
                'label' => 'Адрес в Санкт-Петербурге'
            ])
            ->add('coord', 'map', [
                'label' => 'Офис',
                'zoom' => [
                    'new' => 10,
                    'exists' => 15
                ]
            ])

        ;
    }

}
