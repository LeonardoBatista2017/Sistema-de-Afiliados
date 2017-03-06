<!DOCTYPE html>
<html>
    <head>
        <title>Acessar</title>
        
        <!-- Bootstrap -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

        <!--CSS Person-->
        <link rel="stylesheet" href="{{url('assets/painel/css/login-especializati.css')}}">

        <!--Favicon-->
        <link rel="icon" type="image/png" href="{{url('assets/all/imgs/favicon.png')}}">
    </head>
    <body class="bg-login">

        <section class="login">

            <div class="image-login">
                <!--<img src="{{url('assets/portal/imgs/logo-especializati.png')}}" alt="EspecializaTi" class="logo-painel">-->
            </div>

            @if( isset($errors) && count($errors) > 0 )
            <div class="alert alert-warning">
                @foreach($errors->all() as $error)
                <p>{{$error}}</p>
                @endforeach
            </div>
            @endif

            @yield('content-login')

        </section>

    </body>
</html>