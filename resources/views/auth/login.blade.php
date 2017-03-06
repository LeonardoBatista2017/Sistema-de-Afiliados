@extends('auth.templates.template')

@section('content-login')

{!! Form::open(['url' => '/login', 'class' => 'form-login']) !!}

    E-mail{!! Form::email('email', null, ['placeholder' => 'E-mail:']) !!}
    Senha{!! Form::password('password', ['placeholder' => 'Senha:']) !!}
    {!! Form::submit('Acessar', ['class' => 'btn-login']) !!}

    <a href="{{ url('/password/reset') }}" class="rel-pass">Recuperar Senha?</a>

{!! Form::close() !!}

@endsection
