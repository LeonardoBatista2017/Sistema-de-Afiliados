@extends('painel.templates.template')

@section('content')
<div class="bred">
    <a href="{{url('/painel')}}" class="bred">Home  > </a>
    <a href="{{url('/painel/permissoes')}}" class="bred">Permissões > Gestão de Permissão</a>
</div>

<div class="title-pg">
    <h1 class="title-pg">Gestão de Permissão: <b>{{$data->name or 'Nova'}}</b></h1>
</div>

<div class="content-din">
    @if( isset($errors) && count($errors) > 0 )
    <div class="alert alert-warning">
        @foreach($errors->all() as $error)
            <p>{{$error}}</p>
        @endforeach
    </div>
    @endif
    @if( isset($data) )
        {!! Form::model($data, ['route' => ['permissoes.update', $data->id], 'class' => 'form form-search form-ds', 'method' => 'PUT']) !!}
    @else
        {!! Form::open(['route' => 'permissoes.store', 'class' => 'form form-search form-ds']) !!}
    @endif
        <div class="form-group">
            {!! Form::text('name', null, ['placeholder' => 'Nome:', 'class' => 'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::text('label', null, ['placeholder' => 'Descrição:', 'class' => 'form-control']) !!}
        </div>

        <div class="form-group">
            {!! Form::submit('Enviar', ['class' => 'btn']) !!}
        </div>
    {!! Form::close() !!}

</div><!--Content Dinâmico-->

@endsection