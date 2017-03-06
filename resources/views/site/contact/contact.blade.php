@extends('site.templates.template')

@section('content')

<div class="contact text-center">
    <h1 class="title">Entre em Contato</h1>
    <h2 class="sub-title">Tenha todas as suas Dúvidas esclarecidas pela nossa equipe.</h2>
    
    @if( Session::has('success') )
    <div class="alert alert-success hide-msg" style="float: left; width: 100%; margin: 10px 0px;">
        {{Session::get('success')}}
    </div>
    @endif
    
    @if( isset($errors) && count($errors) > 0 )
    <div class="alert alert-warning" style="float: left; width: 100%; margin: 10px 0px;">
        @foreach($errors->all() as $error)
            <p>{{$error}}</p>
        @endforeach
    </div>
    @endif

    {!! Form::open(['route' => 'contact', 'class' => 'form form-contact']) !!}
        {!! Form::text('name', null, ['placeholder' => 'Nome:']) !!}
        {!! Form::email('email', null, ['placeholder' => 'E-mail:']) !!}
        {!! Form::text('subject', null, ['placeholder' => 'Assunto:']) !!}
        {!! Form::textarea('message', null, ['placeholder' => 'Mensagem']) !!}
        <button class="btn-contact">Enviar</button>
    {!! Form::close() !!}
</div>

@endsection