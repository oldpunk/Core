<?php

namespace Modules\Core\Http\Controllers;


use Kris\LaravelFormBuilder\FormBuilder;
use Kris\LaravelFormBuilder\FormBuilderTrait;

abstract class CrudController extends Controller
{
    use FormBuilderTrait;

    protected $sortOrder = 'DESC';
    protected $sortValue = 'id';

    abstract function getModel();
    abstract function getModule();
    abstract function getTitle();
    abstract function getForm();

    protected function isSortable()
    {
        return false;
    }

    protected function listFields()
    {
        return [
            'title' => [
                'title' => 'Название',
                'link' =>''
            ],
        ];
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $model = $this->getModel();

        if($this->isSortable()){
            $model = $model::orderBy('pos', 'ASC');
        }else{
            $model = $model::orderBy($this->sortValue, $this->sortOrder);
        }

        $items = $model->paginate(15);

        return view('core::common.index', [
            'items' => $items,
            'title' => $this->getTitle(),
            'module' => $this->getModule(),
            'fields' => $this->listFields(),
            'sortable' => $this->isSortable()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(FormBuilder $formBuilder)
    {
        $form = $formBuilder->create($this->getForm(), [
            'method' => 'POST',
            'url' => route($this->getModule().'.store')
        ]);

        return view('core::common.create', [
            'form' => $form,
            'title' => $this->getTitle(),
            'module' => $this->getModule()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        $form = $this->form($this->getForm());

        $form->redirectIfNotValid();
        $values = $form->getFieldValues();

        $model = $this->getModel();

        if($this->isSortable()){
            $values['pos'] = $model::max('pos')+1;
        }
        $model::create($values);

        return redirect()->route($this->getModule().'.index');
    }

    /**
     * Display the specified resource.
     *
     * @param $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return redirect()->route($this->getModule().'.edit', $id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param $id
     * @param FormBuilder $formBuilder
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id, FormBuilder $formBuilder)
    {
        $model = $this->getModel();
        $item = $model::find($id);
        $values = $item->toArray();

        if(property_exists($item, 'translatedAttributes')){
            $values = array_merge($values, $item->getTranslationsArray());
        }

        $form = $formBuilder->create($this->getForm(),
            [
                'method' => 'PATCH',
                'url' => route($this->getModule().'.update', $id),
                'model' => $values,
            ]);

        return view('core::common.edit', [
            'form' => $form,
            'title' => $this->getTitle(),
            'module' => $this->getModule()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update($id)
    {
        $form = $this->form($this->getForm());

        $form->redirectIfNotValid();

        $request = $form->getFieldValues();

        $model = $this->getModel();
        $model::find($id)->update($request);

        return redirect()->route($this->getModule().'.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $model = $this->getModel();
        $model::find($id)->delete();

        return redirect()->route($this->getModule().'.index');
    }
}
