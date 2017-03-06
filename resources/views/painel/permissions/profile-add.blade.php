@extends('painel.templates.template')

@section('content')
<div class="bred">
    <a href="{{url('/painel')}}" class="bred">Home  > </a>
    <a href="{{url('/painel/permissoes')}}" class="bred"Perfis > Permissões</a>
    <a href="{{route('permissao.perfis', $permission->id)}}" class="bred"> > {{$permission->name}}</a>
</div>

<div class="title-pg">
    <h1 class="title-pg">Adicionar Novos Perfis a Permissão: <b>{{$permission->name}}</b></h1>
</div>

<div class="content-din">
    @if( isset($errors) && count($errors) > 0 )
    <div class="alert alert-warning">
        @foreach($errors->all() as $error)
            <p>{{$error}}</p>
        @endforeach
    </div>
    @endif
    
    {!! Form::open(['route' => ['permissao.profiles.add', $permission->id], 'class' => 'form form-search form-ds']) !!}
        @foreach( $profiles as $profile )
        <div class="form-group">
            <label>
                {!! Form::checkbox('profiles[]', $profile->id) !!}
                {{ $profile->name }}
            </label>
        </div>
        @endforeach

        <div class="form-group">
            {!! Form::submit('Enviar', ['class' => 'btn']) !!}
        </div>
    {!! Form::close() !!}

</div><!--Content Dinâmico-->

@endsection