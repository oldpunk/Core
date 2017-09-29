<?php
namespace Modules\Core\Forms\Fields;

use Kris\LaravelFormBuilder\Fields\FormField;
use Modules\Core\Services\TranslitServices;

class SlugType extends FormField
{

    /**
     * Get the template, can be config variable or view path.
     *
     * @return string
     */
    protected function getTemplate()
    {
        return 'text';
    }

    public function getType()
    {
        return 'text';
    }

    public function getDefaults()
    {
        return [
            'source' => 'title',
        ];
    }

    public function alterFieldValues(&$value)
    {
        $request = $this->parent->getRequest()->all();
        $source = $this->getOption('source');
        $string = $value;

        if(!$string){
            $string = $this->stringToSlug(array_get($request, $source));
        }

        $value = $this->stringToSlug($string);
    }

    protected function stringToSlug($value)
    {
        return app()->make(TranslitServices::class)->toUrl($value);
    }

}