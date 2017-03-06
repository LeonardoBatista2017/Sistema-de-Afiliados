@extends('site.templates.template')

@section('content')
<div class="slide">
    <div class="col-md-8">

        <article class="img-big">
            <a href="{{url("/contato")}}" title="">
                <img src="{{url("assets/portal/imgs/FOLDER.jpg")}}" alt="" class="img-slide-big">
    
                </a>
    
    
    
    
            </article>
        
        <section class="content">
   

        @forelse( $posts as $post )
        <article class="post">
            <div class="image-post col-md-4 text-center">
                <img src="{{url("assets/uploads/posts/{$post->image}")}}" alt="{{$post->title}}" class="img-post">
            </div>
            <div class="description-post col-md-8">
                <h2 class="title-post">{{$post->title}}</h2>

                <p class="description-post">
                      {!! str_limit($post->description, 200) !!}
                   
                </p>

                <a class="btn-post" href="{{url("/tutorial/{$post->url}")}}">Ir <span class="glyphicon glyphicon-chevron-right"></span></a>
            </div>
        </article>
        @empty
        <p>Nenhum Anúncio.</p>
        @endforelse

        <div class="pagination-posts">
            {!! $posts->links() !!}
        </div>

    

   
</section>
        
    </div>
    <div class="col-md-4">
        <article class="img-small col-md-12 col-sm-6 col-xm-12">
                <a href="{{url("/register")}}" title="">
                    <img src="{{url("assets/portal/imgs/CADASTRO.jpg")}}" alt="" class="img-slide-small">


            </a>

        </article>
        @foreach( $postsFeatured as $featured )

        @if( $loop->first )
        <article class="img-small col-md-12 col-sm-6 col-xm-12">
            <a href="{{url("/tutorial/{$featured->url}")}}" title="{{$featured->title}}">
                <img src="{{url("assets/uploads/posts/{$featured->image}")}}" alt="{{$featured->title}}" class="img-slide-small">


            </a>
            <div class="description-post-pg text-justify">
                <p class="details-post">
                    <span>Data publicação</span>: <time datetime="{{$post->date}} {{$post->hour}}">{{\Carbon\Carbon::parse($post->date)->format('d/m/Y')}} /</time>
                    <span>Total Visualizações:</span> {{$post->views()->count()}}<span>
                </p>


            </div>
        </article>

        @else
        <article class="img-small col-md-12 col-sm-6 col-xm-12">
            <a href="{{url("/tutorial/{$featured->url}")}}" title="{{$featured->title}}">
                <img src="{{url("assets/uploads/posts/{$featured->image}")}}" alt="{{$featured->title}}" class="img-slide-small">

                <h1 class="text-slide">
                    {{$featured->title}}
                </h1>
            </a>
            <div class="description-post-pg text-justify">
                <p class="details-post">
                    <span>Data publicação</span>: <time datetime="{{$post->date}} {{$post->hour}}">{{\Carbon\Carbon::parse($post->date)->format('d/m/Y')}} /</time>
                    <span>Total Visualizações:</span> {{$post->views()->count()}}<span>
                </p>


            </div>
        </article>
        @endif

        @if( $loop->first )
    </div>
    <div class="col-md-4">
        @endif
        @endforeach
    </div>
     @include('site.includes.sidebar')
</div><!--Slide-->



@endsection