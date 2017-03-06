@extends('painel.templates.template-admin')

@section('content')

<div class="bred">
    <a href="{{url('/painel')}}" class="bred">Home  > </a> <a href="{{url('/painel/usuarios')}}" class="bred">Conta</a>
</div>

<div class="title-pg">
    <h1 class="title-pg">Conta do Usuário</h1>
</div>

<div class="content-din bg-white">

    <div class='alert-warning'>
        <h3>Seja Bem Vindo!!! <br>
            Você precisa completar o seu cadastro para receber seus ganhos e ao completar o cadastro você irá obter um código para você, esse código você irá informar aos seus amigos, seus amigos se cadastrando no nosso site com seu código você também ganha.</h3>
    </div>
    
    <br>
      @if( isset($errors) && count($errors) > 0 )
    <div class="alert alert-danger">
        @foreach($errors->all() as $error)
            <p>{{$error}}</p>
        @endforeach
    </div>
    @endif
    
    @if( Session::has('success') )
    <div class="alert alert-success hide-msg" style="float: left; width: 100%; margin: 10px 0px;">
        {{Session::get('success')}}
    </div>
    @endif

    <table class="table table-striped">
        <tr>
            <th>Nome</th>
            <th>E-mail</th>
          
            <th width="350">Ações</th>
        </tr>

       
           @forelse($users as $user)
           
            <tr>
                <td>{{$user->name}}</td>
                <td>{{$user->email}}</td>
             
                <td>
                    <a href='{{route('usuarios.edit', $user->id)}}' class="edit"><span class="glyphicon glyphicon-pencil"></span> Completar Cadastro</a>
                    <a href="{{route('usuarios.show', $user->id)}}" class="delete"><span class="glyphicon glyphicon-eye-open"></span> Visualizar Código</a>
                </td>
            </tr>
            
            @empty
               Não existe Conta Cadastrada
         
        @endforelse
           
       
    </table>

</div><!--Content DinÃ¢mico-->

@endsection