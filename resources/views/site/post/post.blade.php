@extends('site.templates.template-post')

@section('content')
<div class="category">

    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    <section class="content">
        
        
       
        <div class="col-md-8">

            <article class="post">
            
                
                
 
                <div class="image-post text-center">
                    <img src="{{url("assets/uploads/posts/{$post->image}")}}" alt="{{$post->title}}" class="img-post">
                </div>
                <div class="description-post-pg text-justify">
                    <p class="details-post">
                        <span>Autor:</span> {{$author->name}} / <span>Data publicação</span>: <time datetime="{{$post->date}} {{$post->hour}}">{{\Carbon\Carbon::parse($post->date)->format('d/m/Y')}} /</time>
                       @if($postContadorCodigo==Null )
                             Total Vizualizações:
                       
                        @else
                                Total Vizualizações: <span>{{$postContadorCodigo->contador}}</span> 
                        
                        @endif
                    </p>

                    <h2 class="title-post-pg">{{$post->title}}</h2>

                    {!! $post->description !!}
                </div>
            </article><!--End Post-->

            <article class="post comments">
                <h2 class="title-comment">
                    Deixe o seu comentário
                    @if( auth()->check() )
                        <b>{{auth()->user()->name}}</b>
                    @endif
                </h2>
                {!! Form::open(['route' => 'comment', 'class' => 'form form-contact form-comment']) !!}
                    {!! Form::hidden('post', $post->id) !!}
                    @if( auth()->check() )
                        {!! Form::hidden('name', auth()->user()->name) !!}
                        {!! Form::hidden('email', auth()->user()->email) !!}
                    @else
                        {!! Form::text('name', null, ['placeholder' => 'Nome:']) !!}
                        {!! Form::email('email', null, ['placeholder' => 'E-mail:']) !!}
                    @endif
                    {!! Form::textarea('description', null, ['placeholder' => 'Comente Aqui...']) !!}

                    <button>Enviar</button>
                    
                    <div class="preloader" style="display: none;">Enviando comentário....</div>
                    <div class="alert alert-success" style="display: none;">Comentário enviando com sucesso!</div>
                    <div class="alert alert-danger" style="display: none;"></div>
                {!! Form::close() !!}

                @foreach( $post->comments as $comment )
                <div class="comment">
                    <div class="col-md-2 text-center">
                        @if( $comment->image_user != null && file_exists(public_path("assets/uploads/users/{$comment->image_user}")) )
                            <img src="{{url("assets/uploads/users/{$comment->image_user}")}}" alt="{{$comment->name}}" class="user-comment-img img-circle">
                        @else
                            <img src="{{url('assets/painel/imgs/no-image.png')}}" alt="{{$comment->name}}" class="user-comment-img img-circle">
                        @endif
                    </div>
                    <div class="col-md-10 comment-user">
                        {{$comment->name}}: 
                        <p>{{$comment->description}}</p>
                    </div>
                </div>
                    {{--Reply Comments--}}
                    @foreach( $comment->answers()->get() as $answer )
                        <div class="reply-comment">
                            <div class="col-md-2 text-center">
                                @if( $answer->image_user != null && file_exists(public_path("assets/uploads/users/{$answer->image_user}")) )
                                    <img src="{{url("assets/uploads/users/{$answer->image_user}")}}" alt="{{$comment->name}}" class="user-comment-img img-circle">
                                @else
                                    <img src="{{url('assets/painel/imgs/no-image.png')}}" alt="{{$comment->name}}" class="user-comment-img img-circle">
                                @endif
                            </div>
                            <div class="col-md-10 comment-user">
                                {{$answer->name}}: 
                                <p>{{$answer->description}}</p>
                            </div>
                        </div>
                    @endforeach
                @endforeach
                
                
            </article>


        </div><!--POSTS-->

         <div class="col-md-4">
        <article class="img-big">
            <a href="{{url("/contato")}}" title="">
                <img src="{{url("assets/portal/imgs/FOLDER.jpg")}}" alt="" class="img-slide-big">
    
                </a>
    
    
    
    
            </article>
    </div>
        
        <div class="col-md-4">
            <article class="img-small col-md-12 col-sm-6 col-xm-12">
                <a href="{{url("/register")}}" title="">
                    <img src="{{url("assets/portal/imgs/CADASTRO.jpg")}}" alt="" class="img-slide-small">


            </a>

        </article>
        </div>
    </section>
               

    <section class="post-relation">
        <h1 class="title-post-rel">Anúncios Relacionados:</h1>

        @foreach($postsRel as $post)
            <article class="post-rel col-md-3 col-xm-6 col-sm-12">
                <a href="{{route('post', $post->url)}}">
                    <div class="image-post text-center">
                        <img src="{{url("assets/uploads/posts/{$post->image}")}}" alt="{{$post->title}}" class="img-post">
                    </div>
                    <div class="description-post">
                        <h2 class="title-post-rel-list">{{$post->title}}</h2>
                    </div>
                </a>
            </article>
        @endforeach
    </section>
 
   
</div>
@endsection

@push('scripts')
<script>
    $(function(){
        $('form.form-comment').submit(function(){
            $('.alert-success').hide();
            $('.alert-danger').hide();            
            
            var dataForm = $(this).serialize();
            
            $.ajax({
                url: '/comment-post',
                method: 'POST',
                data: dataForm,
                beforeSend: startPreloader()
            }).done(function(data){
                if( data == "1" ) {
                    $('.alert-success').fadeIn();
                } else {
                    $('.alert-danger').fadeIn();
                    $('.alert-danger').html(data);
                }
                
                hideMsg();
                
                endPreloader();
            }).fail(function(){
                alert("Falha ao enviar...");
                
                endPreloader();
            });
            
            return false;
        });
        
        function startPreloader()
        {
            $('.preloader').show();
        }
        
        function endPreloader()
        {
            $('.preloader').hide();
        }
        
        function hideMsg()
        {
            $('form.form-comment')[0].reset();
            
            setTimeout("$('.alert').hide();", 5000);
        }
    });
</script>
@endpush