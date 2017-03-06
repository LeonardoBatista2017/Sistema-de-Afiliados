@extends('auth.templates.templateRegister')

@section('content-register')
<form class="form-horizontal" role="form" method="POST" action="{{ url('/register') }}">
    {{ csrf_field() }}
    
    <div class="form-group">
        <label for="codigo" class="col-md-4 control-label">Digite o Codigo</label>
        <div class="col-md-6">
      
            <input type="text" name="codigo" class="form-control" placeholder="Código de Cadastro">
        </div>


    </div>
    
    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
        <label for="name" class="col-md-4 control-label">Nome</label>

        <div class="col-md-6">
            <input id="name" placeholder="Preencha seu nome Completo" type="text" class="form-control" name="name" value="{{ old('name') }}">

            @if ($errors->has('name'))
            <span class="help-block">
                <strong>{{ $errors->first('name') }}</strong>
            </span>
            @endif
        </div>
    </div>

    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
        <label for="email" class="col-md-4 control-label">E-Mail</label>

        <div class="col-md-6">
            <input id="email" type="email" placeholder="Preencha seu E-mail" class="form-control" name="email" value="{{ old('email') }}">

            @if ($errors->has('email'))
            <span class="help-block">
                <strong>{{ $errors->first('email') }}</strong>
            </span>
            @endif
        </div>
    </div>

    <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
        <label for="password" class="col-md-4 control-label">Senha</label>

        <div class="col-md-6">
            <input id="password" type="password" placeholder="Preencha sua Senha" class="form-control" name="password">

            @if ($errors->has('password'))
            <span class="help-block">
                <strong>{{ $errors->first('password') }}</strong>
            </span>
            @endif
        </div>
    </div>

    <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
        <label for="password-confirm" class="col-md-4 control-label">Confirmar Senha</label>

        <div class="col-md-6">
            <input id="password-confirm" placeholder="Confirme sua Senha" type="password" class="form-control" name="password_confirmation">

            @if ($errors->has('password_confirmation'))
            <span class="help-block">
                <strong>{{ $errors->first('password_confirmation') }}</strong>
            </span>
            @endif
        </div>
    </div>

    <div class="form-group">
        <div class="col-md-6 col-md-offset-4">
            <button type="submit" class="btn btn-primary">
                <i class="fa fa-btn fa-user"></i> Cadastrar
            </button>
        </div>
    </div>
</form>
@endsection
