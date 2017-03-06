@extends('painel.templates.template-admin')

@section('content')

<div class="bred">
    <a href="{{url('/painel')}}" class="bred">Home  > </a> <a href="{{url('/painel/posts')}}" class="bred">Anúncios</a>
</div>

<div class="title-pg">
    <h1 class="title-pg">Listagem dos Anúncios</h1>
</div>

<div class="content-din bg-white">

    <div class="form-search">
        {!! Form::open(['route' => 'posts.search', 'class' => 'form form-inline']) !!}
            {!! Form::text('key-search', null, ['class' => 'form-control', 'placeholder' => 'Nome:']) !!}
            {!! Form::submit('Filtrar', ['class' => 'btn']) !!}
        {!! Form::close() !!}
    </div>

    <div class="class-btn-insert">
        <a href="{{route('posts.create')}}" class="btn-insert">
            <span class="glyphicon glyphicon-plus"></span>
            Cadastrar
        </a>
    </div>
    
    @if( Session::has('success') )
    <div class="alert alert-success hide-msg" style="float: left; width: 100%; margin: 10px 0px;">
        {!! Session::get('success') !!}
    </div>
    @endif

    <table class="table table-striped">
        <tr>
            <th>Nome</th>
            <th width="420">Ações</th>
        </tr>

        @forelse($postContadorCodigo as $postContadorCodigos)
            <tr>
                <td>{{$postContadorCodigos->title}}</td>
                <td>
                    
                    <a href='{{route('posts.edit', $postContadorCodigos->id2)}}' class="edit"><span class="glyphicon glyphicon-pencil"></span> Editar</a>
                    <a href="{{route('posts.show', $postContadorCodigos->id2)}}" class="delete"><span class="glyphicon glyphicon-eye-open"></span> Visualizar</a>
                </td>
            </tr>
        @empty
            <p>Nenhum Anúncio Cadastrado</p> <br><br>
        @endforelse
    </table>
                 
   
</div><!--Content Dinâmico-->

@endsection