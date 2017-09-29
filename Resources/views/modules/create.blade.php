@extends('core::layouts.app')

@section('page-title', 'Создание модуля')

@section('content')
<div class="portlet light ">
    <div class="portlet-title">
        <div class="caption font-red-intense">
            <i class="icon-pin font-red-intense"></i>
            <span class="caption-subject bold uppercase">Модуль</span>
        </div>

        <div class="actions btn-set">
            <a href="{{ route('modules.create') }}" class="btn btn-default"> Добавить</a>
            <a href="{{ route('modules.index') }}" class="btn btn-default"> К списку</a>
        </div>
    </div>

    <div class="portlet-body form">

        {!! form_start($form, ['class'=>'form-horizontal form-bordered form-label-stripped']) !!}

        <div class="form-body">

            {!! form_rest($form) !!}

        </div>

        <div class="form-actions">
            <div class="row">
                <div class="col-md-offset-3 col-md-9">
                    <button type="submit" class="btn purple"><i class="fa fa-check"></i> Добавить </button>
                    <button type="button" class="btn default" onclick="document.location = '{{ route('modules.index') }}'">Отмена</button>
                </div>
            </div>
        </div>

        {!! form_end($form); !!}


    </div>
</div>
@endsection