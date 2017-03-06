@extends('painel.templates.template')

@section('content')
<div class="bred">
    <a href="{{url('/painel')}}" class="bred">Home  > </a>
    <a href="{{url('/painel/usuarios')}}" class="bred">Conta > Gestão de Conta</a>
</div>

<div class="title-pg">
    <h1 class="title-pg">Completar Cadastro: <b>{{$user->name or 'Novo'}}</b></h1>
</div>

<div class="content-din">
    @if( isset($errors) && count($errors) > 0 )
    <div class="alert alert-warning">
        @foreach($errors->all() as $error)
            <p>{{$error}}</p>
        @endforeach
    </div>
    @endif
    
    

        {!! Form::model($user, ['route' => ['usuarios.update', $user->id], 'class' => 'form form-search form-ds', 'files' => true, 'method' => 'PUT'])!!}
         
        
         
        <div class="form-group">
            {!! Form::text('name', null, ['placeholder' => 'Nome:', 'class' => 'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::email('email', null, ['placeholder' => 'Email:', 'class' => 'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::password('password', ['placeholder' => 'Senha:', 'class' => 'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::password('password_confirmation', ['placeholder' => 'Confirmar Senha:', 'class' => 'form-control']) !!}
        </div>
    
        <div class="form-group">
            {!! Form::text('telefone', null, ['placeholder' => 'Insira o Telefone:', 'class' => 'form-control ','id'=>'telefone']) !!}
        </div>
        
        <div class="form-group">
            {!! Form::text('cpf', null, ['placeholder' => 'CPF:', 'class' => 'form-control']) !!}
        </div>
    
        <div class="form-group">
            {!! Form::text('banco', null, ['placeholder' => 'Informe seu banco:', 'class' => 'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::text('agencia', null, ['placeholder' => 'Informe sua agencia', 'class' => 'form-control']) !!}
        </div>
    
       <div class="form-group">
            {!! Form::text('conta', null, ['placeholder' => 'Informe sua Conta', 'class' => 'form-control']) !!}
        </div>
     <div class="form-group">
            {!! Form::text('rua', null, ['placeholder' => 'Rua', 'class' => 'form-control']) !!}
        </div>
     <div class="form-group">
            {!! Form::text('numero', null, ['placeholder' => 'Número', 'class' => 'form-control']) !!}
        </div>
     <div class="form-group">
            {!! Form::text('complemento', null, ['placeholder' => 'Complemento', 'class' => 'form-control']) !!}
        </div>
     <div class="form-group">
            {!! Form::text('bairro', null, ['placeholder' => 'Bairro', 'class' => 'form-control']) !!}
        </div>
     <div class="form-group">
            {!! Form::text('cidade', null, ['placeholder' => 'Cidade', 'class' => 'form-control']) !!}
        </div>
         <div class="form-group">
            {!! Form::text('estado', null, ['placeholder' => 'Estado', 'class' => 'form-control ']) !!}
        </div>
     <div class="form-group">
            {!! Form::hidden('user_id', $user->id) !!}
      </div>
     <div class="form-group">
            {!! Form::text('cep', null, ['placeholder' => 'CEP', 'class' => 'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::file('image', ['class' => 'form-control']) !!}
        </div>

        <div class="form-group">
            {!! Form::submit('Enviar', ['class' => 'btn']) !!}
        </div>
    {!! Form::close() !!}

</div><!--Content DinÃ¢mico-->






@endsection

@push('scripts')

<script>
  

           
 

</script>
@endpush