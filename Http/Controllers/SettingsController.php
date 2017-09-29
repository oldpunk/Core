<?php

namespace Modules\Core\Http\Controllers;

use Modules\Core\Http\Forms\SettingsForm;
use Modules\Core\Entities\Settings;
use Kris\LaravelFormBuilder\FormBuilder;
use Kris\LaravelFormBuilder\FormBuilderTrait;

class SettingsController extends Controller
{
    use FormBuilderTrait;

    public function index(Settings $settings, FormBuilder $form_builder)
    {

        $form = $form_builder->create(SettingsForm::class,[
            'method' => 'POST',
            'url' => route('settings.store'),
            'model' => $settings->getAllParams()
        ]);

        return view('core::settings.index', compact('form'));
    }

    public function store(Settings $settings)
    {
        $form = $this->form(SettingsForm::class);

        $form->redirectIfNotValid();

        $values = $form->getFieldValues();
        $settings->updateParams($values);

        return redirect()->route('settings.index');
    }
}
