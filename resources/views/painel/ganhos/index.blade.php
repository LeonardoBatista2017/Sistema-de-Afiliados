@extends('painel.templates.template')

@section('content')

<div class="bred">
    <a href="{{url('/painel')}}" class="bred">Home  > </a> <a href="{{url('/painel/ganhos')}}" class="bred">Ganhos</a>
</div>

<div class="title-pg">
    <h1 class="title-pg">Relatório dos Ganhos</h1>
 
</div>

<table class="table table-condensed">

    <tr>
     
         <th class="active">
            Código
        </th>
        <th class="warning">
           Serviços
        </th>
       
        <th class="danger">Quantidade</th>
      
    </tr>
    <tr>
        @foreach($contadores as $contador)
        <td class="active">
            {{$contador->codigo}}
        </td>
        <td class="warning">
            Amigos cadastrados pelo seu código:
        </td>
        
        <td class="danger">{{$contador->contador}}</td>
        @endforeach
    </tr>

  </table>
  <table class="table table-condensed">  
     <tr>
     
         
        <th class="active">
           Trecho a copiar para Compartilhar
        </th>
        <th class="warning">
           Serviços
        </th>
        <th class="danger">Quantidade</th>
      
    </tr>

        @foreach($postContadorCodigo as $post_contador)
           <tr>
         <td class="active">
             {!!$post_contador->description!!}
             
             Clique Abaixo!!<br>
            www.brechodasarteiras.com.br/{{$post_contador->url}}/{{$post_contador->id}}
            
        </td>
        <td class="warning">
            Vizualizações da Url que vocÊ compartilhou: 
        </td>
        
        <td class="danger">{{$post_contador->contador}}</td>
            </tr>
        @endforeach


    




</table>
@endsection