@extends('site.templates.template')

@section('content')
<div class="conpany text-center">
	<h1 class="title">
		Sobre a Mailson
	</h1>
	<h2 class="sub-title">
		Buscamos tornar conhecida a empresa através de anúncios nas redes sociais, com isso
                trazemos para nossos parceiros a chance de ganhar compartilhando anúncios.
	</h2>

	<div class="col-md-6">
		<img src="{{ url("assets/portal/imgs/Ganhar-Dinheiro-como-Afiliado.png") }}" alt="EspecializaTi" class="company">
	</div>
	<div class="col-md-6 text-company text-justify">
		<p class="text-company-esp">Temos a missão de tornar a empresa conhecida nas redes sociais.</p>

		<p>A Mailson foi fundada em 2017, atualmente aplicamos nossa forma de trabalho nas redes sociais.</p>

		<p>Seja um parceiro compartilhador e ganhe por isso.</p>

		
	</div>
</div>
@endsection