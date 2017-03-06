@extends('auth.templates.template')

@section('content-login')

{!! Form::open(['url' => '/password/reset', 'class' => 'form-login']) !!}

    {!! Form::hidden('token', $token) !!}
    E-mail:{!! Form::email('email', null, ['placeholder' => 'E-mail:']) !!}
    {!! Form::password('password', ['placeholder' => 'Senha:']) !!}
    {!! Form::password('password_confirmation', ['placeholder' => 'Senha:']) !!}
    
    {!! Form::submit('Resetar', ['class' => 'btn-login']) !!}

    <a href="{{ url('/login') }}" class="rel-pass">Login?</a>

{!! Form::close() !!}

@endsection
