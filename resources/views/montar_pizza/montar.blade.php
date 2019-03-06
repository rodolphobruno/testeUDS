@extends('app')

@section('content')

<div class="container-fluid">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading">Detalhes do pedido</div>
				<div class="panel-body">
					<h3><span class="label label-default">Pizzas</span></h3>
					<form class="form-horizontal">
						<div class="form-group">
							<label class="col-sm-2 control-label">Sabor:</label>
							<div class="col-sm-10">
								<p class="form-control-static">{{ $pizza['sabor']['nome'] }}</p>
							</div>
						</div>
					</form>
					<form class="form-horizontal">
						<div class="form-group">
							<label class="col-sm-2 control-label">Tamanho:</label>
							<div class="col-sm-10">
								<p class="form-control-static">{{ $pizza['tamanho']['nome'] }}</p>
							</div>
						</div>
					</form>
					<form class="form-horizontal">
						<div class="form-group">
							<label class="col-sm-2 control-label">Valor unitário:</label>
							<div class="col-sm-10">
								<p class="form-control-static">R$ {{ number_format($pizza['tamanho']['valor'], 2, ',', '.') }}</p>
							</div>
						</div>
					</form>
					<hr>
					<h3><span class="label label-default">Personalizações</span></h3>
					<?php
						foreach ($pizzaAdicional as $idx => $pa){
							//print_r($pa['adicional']['nome']);
						?>
							<form class="form-horizontal">
								<div class="form-group">
									<label class="col-sm-2 control-label">Item Adicional:  {{$idx + 1	}} </label>
									<div class="col-sm-10">
										<p class="form-control-static">{{$pa['adicional']['nome']}} - R$ {{ number_format($pa['adicional']['valor'], 2, ',', '.') }}</p>
									</div>
								</div>
							</form>
						<?php
						}
					?>
					<hr>
					<h3><span class="label label-default">Totais</span></h3>
					<form class="form-horizontal">
						<div class="form-group">
							<label class="col-sm-2 control-label"><h2><small>Valor Total</small></h2> </label>
							<div class="col-sm-10">
								<p class="form-control-static"><h2>R$ {{ number_format($pedido['valor_total'], 2, ',', '.') }}</h2></p>
							</div>
						</div>
					</form>
					<form class="form-horizontal">
						<div class="form-group">
							<label class="col-sm-2 control-label"><h2><small>Tempo de Preparo</small></h2> </label>
							<div class="col-sm-10">
								<p class="form-control-static"><h2>{{ $pedido['tempo_preparo_total'] }} minutos</h2></p>
							</div>
						</div>
					</form>
				</div>
				<hr>
				<a href="/" class="btn btn-success center-block">
					NOVO PEDIDO
				</a>
			</div>

		</div>

	</div>
</div>
@endsection
