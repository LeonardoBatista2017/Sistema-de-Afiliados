@extends('painel.templates.template-admin')

@section('content')

<div class="bred">
    <a href="{{url('/painel')}}" class="bred">Home  > </a> <a href="{{url('/painel/comentarios')}}" class="bred">Comentários</a>
</div>

<div class="title-pg">
    <h1 class="title-pg">Listagem das Respostas: <b>{{$comment->name}} - {{$comment->description}}</b></h1>
</div>
{!! Form::open(['route' => ['destroy-comment', $comment->id]]) !!}
    {!! Form::submit('Deletar o Comentário', ['class' => 'btn btn-danger']) !!}
{!! Form::close() !!}

<div class="content-din bg-white">

    @if( Session::has('success') )
    <div class="alert alert-success hide-msg" style="float: left; width: 100%; margin: 10px 0px;">
        {!! Session::get('success') !!}
    </div>
    @endif

    <table class="table table-striped">
        <tr>
            <th>Nome</th>
            <th>Resposta</th>
            <th width="180">Ações</th>
        </tr>

        @forelse($answers as $answer)
        <tr>
            <td>{{$answer->name}}</td>
            <td>{{$answer->description}}</td>
            <td>
                <a href="{{route('destroy-answer', ['id' => $comment->id, 'idAnswer' => $answer->id])}}" class="delete"><i class="fa fa-trash-o" aria-hidden="true"></i> Deletar Resposta</a>
            </td>
        </tr>
        @empty
        <p>Nenhum Resposta para este comentário</p>
        @endforelse
    </table>
    
    @if( isset($errors) && count($errors) > 0 )
    <div class="alert alert-warning">
        @foreach($errors->all() as $error)
            <p>{{$error}}</p>
        @endforeach
    </div>
    @endif

    <div class="form-search">
        {!! Form::open(['route' => ['answer-comment', $comment->id], 'class' => 'form']) !!}
        <div class="form-group">
            {!! Form::textarea('description', null, ['class' => 'form-control', 'placeholder' => 'Responder Aqui:']) !!}
        </div>
        {!! Form::submit('Enviar Resposta', ['class' => 'btn btn-success']) !!}
        {!! Form::close() !!}
    </div>

</div><!--Content Dinâmico-->

@endsection