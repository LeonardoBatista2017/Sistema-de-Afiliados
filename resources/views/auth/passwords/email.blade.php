@extends('auth.templates.template-reset')

@section('content-login')

{!! Form::open(['url' => '/password/email', 'class' => 'form-login']) !!}

    E-mail:{!! Form::email('email', null, ['placeholder' => 'E-mail:']) !!}
    {!! Form::submit('Recuperar', ['class' => 'btn-login']) !!}

    <a href="{{ url('/login') }}" class="rel-pass">Login?</a>

{!! Form::close() !!}

@endsection
