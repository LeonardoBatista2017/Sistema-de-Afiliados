@extends('painel.templates.template-admin')

@section('content')
<div class="bred">
    <a href="{{url('/painel')}}" class="bred">Home  > </a>
    <a href="{{url('/painel/categorias')}}" class="bred">Posts > Gestão de Posts</a>
</div>

<div class="title-pg">
    <h1 class="title-pg">Gestão de Post: <b>{{$data->title or 'Novo'}}</b></h1>
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
        {!! Form::model($data, ['route' => ['posts.update', $data->id], 'class' => 'form form-search form-ds', 'files' => true, 'method' => 'PUT']) !!}
    @else
        {!! Form::open(['route' => 'posts.store', 'class' => 'form form-search form-ds', 'files' => true]) !!}
    @endif
        <div class="form-group">
            {!! Form::text('title', null, ['placeholder' => 'Título do Post:', 'class' => 'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::text('url', null, ['placeholder' => 'URL:', 'class' => 'form-control']) !!}
        </div>
        <div class="form-group">
            Selecione a Categoria:
            {!! Form::select('category_id', $categories, null, ['class' => 'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::date('date', null, ['class' => 'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::time('hour', null, ['class' => 'form-control']) !!}
        </div>
        <div class="form-group">
            <label>
                {!! Form::checkbox('featured', null) !!}
                Destaque?
            </label>
        </div>
        <div class="form-group">
            {!! Form::textarea('description', null, ['placeholder' => 'Descrição:', 'class' => 'form-control']) !!}
        </div>
        <div class="form-group">
            Selecione o Status do Post:
            {!! Form::select('status', ['A' => 'Ativo', 'R' => 'Rascunho'], null, ['class' => 'form-control']) !!}
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

@push('scripts')
<script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
<script>tinymce.init({ selector:'textarea' });</script>
@endpush