@extends('painel.templates.template')

@section('content')
<div class="bred">
    <a href="{{url('/painel')}}" class="bred">Home  > </a>
    <a href="{{url('/painel/usuarios')}}" class="bred">Conta > Visualize seus Dados: {{$user->name}} </a>
</div>

<div class="title-pg">
    <h1 class="title-pg">Usuário: <b>{{$user->name}}</b></h1>
</div>

<div class="content-din">
    @if( isset($errors) && count($errors) > 0 )
    <div class="alert alert-warning">
        @foreach($errors->all() as $error)
            <p>{{$error}}</p>
        @endforeach
    </div>
    @endif
     <div class="alert-danger">
    Verifique abaixo se seus dados estão completos e corretos.
      </div>
    <div class="alert-info">
       @forelse($contadores as $contador)
         <h2><strong>Aqui está seu Código:</strong>{{$contador->codigo}}</h2>
          @empty
        @endforelse
    </div>
    
    <h2><strong>Nome:</strong>{{$user->name}}</h2>
    <h2><strong>Email:</strong>{{$user->email}}</h2>
    <h2><strong>CPF:</strong>{{$user->cpf}}</h2>
    <h2><strong>Banco:</strong>{{$user->banco}}</h2>
    <h2><strong>Agência:</strong>{{$user->agencia}}</h2>
    <h2><strong>Conta:</strong>{{$user->conta}}</h2>
    <h2><strong>Rua:</strong>{{$user->rua}}</h2>
    <h2><strong>Número:</strong>{{$user->numero}}</h2>
    <h2><strong>Complemento:</strong>{{$user->complemento}}</h2>
    <h2><strong>Bairro:</strong>{{$user->bairro}}</h2>
    
    <h2><strong>Cidade:</strong>{{$user->cidade}}</h2>
    <h2><strong>Estado:</strong>{{$user->estado}}</h2>
    <h2><strong>Cep:</strong> {{$user->cep}}</h2>
    <h2><strong>Telefone:</strong> {{$user->telefone}}</h2>

    
    
    {!! Form::open(['route' => ['usuarios.destroy', $user->id], 'class' => 'form form-search form-ds', 'method' => 'DELETE']) !!}
        <div class="form-group">
            {!! Form::submit("Deletar Usuário: $user->name", ['class' => 'btn btn-danger']) !!}
        </div>
    {!! Form::close() !!}

</div><!--Content DinÃ¢mico-->

@endsection