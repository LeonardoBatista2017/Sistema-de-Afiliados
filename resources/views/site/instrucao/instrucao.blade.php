@extends('site.templates.template')

@section('content')
<div class="conpany text-center">
	<h1 class="title">
		Como Funciona
	</h1>
	<h2 class="sub-title">
		
	</h2>

	<div class="col-md-6">
            <a href="{{url('register')}}" >
		<img src="{{ url("assets/portal/imgs/comofunciona.jpg") }}" alt="EspecializaTi" class="company">
            </a>   
	</div>
	<div class="col-md-3 text-company text-justify">
		<p class="text-company-esp">Quer ter ganhos? Trabalhe de Casa compartilhando anúncios nas Redes Sociais. </p>

		<p>Dessa maneira você poderá complementar sua renda de acordo com a quantidade de compartilhamentos que você fizer nas redes sociais e a cada visualização dos anúncios a partir do seu compartilhamento você irá obter ganhos.</p>

		<p>1- Cadastre-se no nosso site</p> 
                
                

		
	</div>
    <div class="col-md-3 text-company text-justify">
        
        <p>2- Após acessar o site, complete seu cadastro, colocando dados de endereço, conta bancária, e telefone.</p>
        <p>3- Após se cadastrar receba seu código, com seu código em mãos informe-o para que seus amigos se cadastrem através dele, com isso você irá ganhar, quanto mais cadastros realizados com seu código mais ganhos você terá .</p>
    </div>
</div>
@endsection