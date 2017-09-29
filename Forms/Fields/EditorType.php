<?php
namespace Modules\Core\Forms\Fields;

use Kris\LaravelFormBuilder\Fields\FormField;

class EditorType extends FormField
{

    /**
     * Get the template, can be config variable or view path.
     *
     * @return string
     */
    protected function getTemplate()
    {
        return 'textarea';
    }

    public function getType()
    {
        return 'textarea';
    }

    public function getDefaults()
    {
        return [
            'attr' => [
                'class' => 'ckeditor',
                'rows' => '10',
            ]
        ];
    }

}