@extends('core::layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Панель управления</div>

                <div class="panel-body">
                    Вы вошли как {{ auth()->user()->name }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
