@extends('core::layouts.login')

@section('content')
    <form class="login-form"  method="POST" action="{{ route('login') }}">
        {{ csrf_field() }}
        <h3 class="form-title">Вход в систему</h3>
        <div class="alert alert-danger display-hide">
            <button class="close" data-close="alert"></button>
            <span>Введите логин и пароль</span>
        </div>
        <div class="form-group {{ $errors->has('login') ? ' has-error' : '' }}" >
            <!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->
            <label class="control-label visible-ie8 visible-ie9">Имя пользователя</label>
            <div class="input-icon">
                <i class="fa fa-user"></i>
                <input class="form-control placeholder-no-fix" type="text" autocomplete="off" placeholder="Имя пользователя" name="login" value="{{ old('login') }}" required autofocus/>
            </div>
            @if ($errors->has('login'))
            <span id="tnc-error" class="help-block">{{ $errors->first('login') }}</span>
            @endif
        </div>
        <div class="form-group {{ $errors->has('password') ? ' has-error' : '' }}">
            <label class="control-label visible-ie8 visible-ie9">Пароль</label>
            <div class="input-icon">
                <i class="fa fa-lock"></i>
                <input class="form-control placeholder-no-fix" type="password" autocomplete="off" placeholder="Пароль" name="password" required/>
            </div>
            @if ($errors->has('password'))
                <span id="tnc-error" class="help-block">{{ $errors->first('password') }}</span>
            @endif

        </div>
        <div class="form-actions">
            <label class="checkbox">
                <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Запомнить меня </label>
            <button type="submit" class="btn blue pull-right">
                Войти <i class="m-icon-swapright m-icon-white"></i>
            </button>
        </div>

    </form>

@endsection
