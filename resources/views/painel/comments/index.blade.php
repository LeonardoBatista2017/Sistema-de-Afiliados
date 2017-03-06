@extends('painel.templates.template-admin')

@section('content')

<div class="bred">
    <a href="{{url('/painel')}}" class="bred">Home  > </a> <a href="{{url('/painel/comentarios')}}" class="bred">Comentários</a>
</div>

<div class="title-pg">
    <h1 class="title-pg">Listagem dos Comentários</h1>
</div>

<div class="content-din bg-white">

    <div class="form-search">
        {!! Form::open(['route' => 'comments.search', 'class' => 'form form-inline']) !!}
            {!! Form::text('key-search', isset($dataForm['key-search']) ? $dataForm['key-search'] : null, ['class' => 'form-control', 'placeholder' => 'Nome:']) !!}
            {!! Form::select('status', ['R' => 'Rascunhos', 'A' => 'Respondidos'], isset($dataForm['status']) ? $dataForm['status'] : null , ['class' => 'form-control']) !!}
            {!! Form::submit('Filtrar', ['class' => 'btn']) !!}
        {!! Form::close() !!}
    </div>
    
    @if( Session::has('success') )
    <div class="alert alert-success hide-msg" style="float: left; width: 100%; margin: 10px 0px;">
        {!! Session::get('success') !!}
    </div>
    @endif

    <table class="table table-striped">
        <tr>
            <th>Nome</th>
            <th>Comentário</th>
            <th width="180">Ações</th>
        </tr>

        @forelse($data as $comment)
            <tr>
                <td>{{$comment->name}}</td>
                <td>{{$comment->description}}</td>
                <td>
                    <a href="{{url("/painel/comentario/{$comment->id}/respostas")}}" class="delete"><i class="fa fa-reply-all" aria-hidden="true"></i> Responder</a>
                </td>
            </tr>
        @empty
            <p>Nenhum Comentário Para Responder</p>
        @endforelse
    </table>

    @if( isset($dataForm) )
        {!! $data->appends($dataForm)->links() !!}
    @else
        {!! $data->links() !!}
    @endif

</div><!--Content Dinâmico-->

@endsection