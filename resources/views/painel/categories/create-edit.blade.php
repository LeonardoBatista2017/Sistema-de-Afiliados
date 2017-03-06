@extends('painel.templates.template-admin')

@section('content')
<div class="bred">
    <a href="{{url('/painel')}}" class="bred">Home  > </a>
    <a href="{{url('/painel/categorias')}}" class="bred">Categorias > Gestão de Categorias</a>
</div>

<div class="title-pg">
    <h1 class="title-pg">Gestão de Categoria: <b>{{$data->name or 'Nova'}}</b></h1>
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
        {!! Form::model($data, ['route' => ['categorias.update', $data->id], 'class' => 'form form-search form-ds', 'files' => true, 'method' => 'PUT']) !!}
    @else
        {!! Form::open(['route' => 'categorias.store', 'class' => 'form form-search form-ds', 'files' => true]) !!}
    @endif
        <div class="form-group">
            {!! Form::text('name', null, ['placeholder' => 'Nome:', 'class' => 'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::text('url', null, ['placeholder' => 'URL:', 'class' => 'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::textarea('description', null, ['placeholder' => 'Descrição:', 'class' => 'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::file('image', ['class' => 'form-control']) !!}
        </div>

        <div class="form-group">
            {!! Form::submit('Enviar', ['class' => 'btn']) !!}
        </div>
    {!! Form::close() !!}

</div><!--Content Dinâmico-->

@endsection