@extends('painel.templates.template')

@section('content')
<div class="bred">
    <a href="{{url('/painel')}}" class="bred">Home  > </a>
    <a href="{{url('/painel/categorias')}}" class="bred">Anúncios > Listagem do Anúncio {{$data->title}} </a>
</div>

<div class="title-pg">
    <h1 class="title-pg">Post: <b>{{$data->title}}</b></h1>
</div>

<div class="content-din">
    @if( isset($errors) && count($errors) > 0 )
    <div class="alert alert-warning">
        @foreach($errors->all() as $error)
            <p>{{$error}}</p>
        @endforeach
    </div>
    @endif
    
    <h2><strong>TíTulo:</strong> {{$data->title}}</h2>
    
    
    {!! Form::open(['route' => ['posts.destroy', $data->id], 'class' => 'form form-search form-ds', 'method' => 'DELETE']) !!}
        <div class="form-group">
            {!! Form::submit("Deletar Post: $data->title", ['class' => 'btn btn-danger']) !!}
        </div>
    {!! Form::close() !!}

</div><!--Content DinÃ¢mico-->

@endsection