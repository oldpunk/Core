@extends('core::layouts.app')

@section('page-title', 'Настройки')

@section('content')
    <div class="portlet light ">
        <div class="portlet-title">
            <div class="caption font-red-intense">
                <i class="icon-pin font-red-intense"></i>
                <span class="caption-subject bold uppercase">Настройки</span>
            </div>

        </div>

        <div class="portlet-body form">

            {!! form_start($form, ['class'=>'form-horizontal form-bordered form-label-stripped']) !!}

            @include('core::common.form_body')

            <div class="form-actions">
                <div class="row">
                    <div class="col-md-offset-3 col-md-9">
                        <button type="submit" class="btn purple"><i class="fa fa-check"></i> Сохранить </button>
                        <button type="button" class="btn default" onclick="document.location = '{{ route('settings.index') }}'">Отмена</button>
                    </div>
                </div>
            </div>

            {!! form_end($form); !!}


        </div>
    </div>
@endsection