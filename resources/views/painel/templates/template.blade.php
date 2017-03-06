<!DOCTYPE html>
<html>
    <head>
        <title>{{$title or 'Painel Especializa Ti'}}</title>

        <!-- Bootstrap -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

        <!--Fonts-->
        <link rel="stylesheet" href="{{url('assets/painel/css/font-awesome.min.css')}}">

        <!--CSS Person-->
        <link rel="stylesheet" href="{{url('assets/painel/css/especializati.css')}}">
        <link rel="stylesheet" href="{{url('assets/painel/css/especializati-reset.css')}}">

        







        <script src="{{url('assets/all/js/jquery-3.1.1.min.js')}}"></script>
        <!--Favicon-->
        <link rel="icon" type="image/png" href="{{url('assets/all/imgs/favicon.png')}}">
    </head>
    <body>

        <section class="menu">

            <div class="logo">
                <!--<img src="{{url('assets/painel/imgs/icone-especializati.png')}}" alt="EspecializaTi" class="logo-painel">-->
            </div>

            <div class="list-menu">
                <ul class="menu-list">
                    <li>
                        <a href="{{url('/painel')}}">
                            <i class="fa fa-home" aria-hidden="true"></i>
                            Home
                        </a>
                    </li>

                    <li>
                        <a href="{{url('/painel/usuarios')}}">
                            <i class="fa fa-id-card" aria-hidden="true"></i>
                            Conta
                        </a>
                    </li>



                    <li>
                        <a href="{{url('/painel/posts')}}">
                            <i class="fa fa-file-text" aria-hidden="true"></i>
                            Anúncios
                        </a>
                    </li>


                    <li>
                        <a href="{{url('/painel/ganhos')}}">
                            <i class="fa fa-money" aria-hidden="true"></i>
                            Ganhos
                        </a>
                    </li>


                </ul>
            </div>

        </section><!--End Menu-->

        <section class="content">
            <div class="top-dashboard">

                <div class="dropdown user-dash">
                    <div class="dropdown-toggle" id="dropDownCuston" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                        @if( auth()->user()->image != '' && file_exists(public_path('assets/uploads/users/'.auth()->user()->image)) )  
                        <img src="{{url('assets/uploads/users/'.auth()->user()->image)}}" alt="{{auth()->user()->name}}" class="user-dashboard img-circle">
                        @else
                        <img src="{{url('assets/painel/imgs/no-image.png')}}" alt="{{auth()->user()->name}}" class="user-dashboard img-circle">
                        @endif

                        <p class="user-name">{{auth()->user()->name}}</p>
                        <span class="caret"></span>
                    </div>
                    <ul class="dropdown-menu dp-menu" aria-labelledby="dropDownCuston">
                        <li><a href="{{route('profile')}}">Perfil</a></li>
                        <li><a href="{{route('logout')}}">Logout</a></li>
                    </ul>
                </div>
            </div><!--Top Dashboard-->

            <div class="content-ds">


                @yield('content')


            </div><!--End Content DS-->

        </section><!--End Content-->



        <!--jQuery-->

        <script src="{{url('assets/all/js/jquery.maskedinput.js')}}"></script>


        <!--Oculta a mensagem depois de um certo tempo-->
        <script>
            $(function () {
                setTimeout("$('.hide-msg').fadeOut();", 3000);
            });
        </script>

        <!-- jS Bootstrap -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

        @stack('scripts')
    </body>
</html>