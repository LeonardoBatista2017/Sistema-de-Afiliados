@extends('painel.templates.template')

@section('content')

<div class="bred">
    <a href="{{url('/painel')}}" class="bred">Home  > </a> <a href="{{url('/painel/posts')}}" class="bred">Anúncios</a>
</div>

<div class="title-pg">
    <h1 class="title-pg">Listagem dos Anúncios</h1>
</div>

<div class="content-din bg-white">
    @if( isset($errors) && count($errors) > 0 )
    <div class="alert alert-warning">
        @foreach($errors->all() as $error)
        <p>{{$error}}</p>
        @endforeach
    </div>
    @endif

    <div class="form-search">
        {!! Form::open(['route' => 'posts.search', 'class' => 'form form-inline']) !!}
        {!! Form::text('key-search', null, ['class' => 'form-control', 'placeholder' => 'Nome:']) !!}
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
            <th>Anúncios a Compartilhar</th>
           
        </tr>

        @forelse($postContadorCodigo as $postContadorCodigos)
      
            
           
                
            
      

        @forelse($postContadorCodigos->viewsContadorCodigo as $viewsContadorCodigo)
                @if($viewsContadorCodigo->id)
    <tr>
        
            <td class=" alert-warning">
             <div class="titulo-anuncio">{{$postContadorCodigos->title}}</div>
             <div class=""><a href='{{url("/painel/posts-gerar-url/{$postContadorCodigos->id}")}}' class="edit"><span class="glyphicon glyphicon-share-alt"></span>Obter seu botão compartilhar</a></div>
              </td>
            
               
         </tr>
         
         <tr>
               <td>
              
                   <div class=" alert-sucess  " data-href="{{url('/tutorial/{$postContadorCodigos->url}/{$viewsContadorCodigo->id}')}}" data-layout="button_count" data-size="small" data-mobile-iframe="true"><a class="btn-facebook" target="_blank" href="https://www.facebook.com/sharer/sharer.php?u={{url("/tutorial/{$postContadorCodigos->url}/{$viewsContadorCodigo->id}")}}">Compartilhar Facebook {{$viewsContadorCodigo->title}} </a>  </div>
              
                   <div class=" btn-zap alert-sucess">   <a  img src="{{url("/assets/uploads/posts/{$postContadorCodigos->image}")}}" href="whatsapp://send?text= {{url("/tutorial/{$postContadorCodigos->url}/{$viewsContadorCodigo->id}")}}">Compartilhar Whatsapp</a> </div>
               
               </td>
              
             
                  
             

       
         </tr>
       

        
                @endif

        @empty
        <p>Clique em Obter URL</p> 

        @endforelse


        @empty
        <p>Nenhum Anúncio Cadastrado</p> <br><br>
        @endforelse



    </table>



</div><!--Content Dinâmico-->

@endsection