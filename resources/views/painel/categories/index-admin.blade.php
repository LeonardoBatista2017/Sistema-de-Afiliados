@extends('painel.templates.template-admin')

@section('content')

<div class="bred">
    <a href="{{url('/painel')}}" class="bred">Home  > </a> <a href="{{url('/painel/categorias')}}" class="bred">Categorias</a>
</div>

<div class="title-pg">
    <h1 class="title-pg">Listagem das Categorias</h1>
</div>

<div class="content-din bg-white">

    <div class="form-search">
        {!! Form::open(['route' => 'categorias.search', 'class' => 'form form-inline']) !!}
            {!! Form::text('key-search', null, ['class' => 'form-control', 'placeholder' => 'Nome:']) !!}
            {!! Form::submit('Filtrar', ['class' => 'btn']) !!}
        {!! Form::close() !!}
    </div>

    <div class="class-btn-insert">
        <a href="{{route('categorias.create')}}" class="btn-insert">
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
            <th>URL</th>
            <th>Descrição</th>
            <th width="200">Ações</th>
        </tr>

        @forelse($data as $cat)
            <tr>
                <td>{{$cat->name}}</td>
                <td>{{$cat->url}}</td>
                <td>{{$cat->description}}</td>
                <td>
                    <a href='{{route('categorias.edit', $cat->id)}}' class="edit"><span class="glyphicon glyphicon-pencil"></span> Editar</a>
                    <a href="{{route('categorias.show', $cat->id)}}" class="delete"><span class="glyphicon glyphicon-eye-open"></span> Visualizar</a>
                </td>
            </tr>
        @empty
            <p>Nenhuma Categoria Cadastrada</p>
        @endforelse
    </table>

    @if( isset($dataForm) )
        {!! $data->appends($dataForm)->links() !!}
    @else
        {!! $data->links() !!}
    @endif

</div><!--Content Dinâmico-->

@endsection