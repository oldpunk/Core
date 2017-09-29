<?php

namespace Modules\Core\Http\Controllers;

use Modules\Core\Http\Forms\UsersForm;
use Modules\Core\Entities\User;
use Illuminate\Http\Request;
use Kris\LaravelFormBuilder\FormBuilder;
use Kris\LaravelFormBuilder\FormBuilderTrait;

/**
 * Class UsersController
 * @package App\Http\Controllers\Admin
 */
class UsersController extends Controller
{
    use FormBuilderTrait;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::where('id', '<>', '1')->get();

        return view('core::users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(FormBuilder $formBuilder)
    {
        $form = $formBuilder->create(UsersForm::class, [
            'method' => 'POST',
            'url' => route('users.store'),
        ], ['is_admin' => $this->is_admin()]);

        return view('core::users.create', compact('form'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $form = $this->form(UsersForm::class, [], ['is_admin' => $this->is_admin()]
        );
        $form->validate(['password' => 'required|confirmed|min:3']);
        $form->redirectIfNotValid();

        $user = User::create($form->getFieldValues());
        $user->modules()->sync($request['modules']);

        return redirect()->route('users.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  User $user
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return redirect()->route('users.edit', $id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  User $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user, FormBuilder $formBuilder)
    {
        $form = $formBuilder->create(UsersForm::class,
            [
                'method' => 'PATCH',
                'url' => route('users.update', $user),
                'model' => $user->load('modules')->toArray()
            ], ['is_admin' => $this->is_admin()]);

        return view('core::users.edit', compact('form'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(User $user, Request $request)
    {
        $form = $this->form(UsersForm::class, [], ['is_admin' => $this->is_admin()]
        );

        $form->redirectIfNotValid();

        $request = $form->getFieldValues();

        if(!$request['password']){
            unset($request['password']);
        }

        $user->update($request);
        $user->modules()->sync($request['modules']);

        return redirect()->route('users.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, User $user)
    {
        if($user->id != 1){
            $user->delete();
        }

        return redirect()->route('users.index');
    }

    private function is_admin()
    {
        return auth()->user()->is_admin || auth()->user()->id === 1;
    }
}
