@extends('app')

@section('content')

<form action="/montarPizza/store" method="POST">
<div class="container-fluid">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading">Monte a sua pizza</div>
				<div class="panel-body">
					<h3><span class="label label-default">Pizzas</span></h3>
					<label class="radio-inline">
						Calabresa
						<input type="radio" name="radioSabor" id="radioCalabresa" value="1" required>
						<img src="/imagens/calabresa.png" height="250px" width="250px" alt="Calabresa">
					</label>
					<label class="radio-inline">
						Marguerita
						<input type="radio" name="radioSabor" id="radioMarguerita" value="2">
						<img src="/imagens/marguerita.png" height="250px" width="250px"  alt="Margueira">
					</label>
					<label class="radio-inline">
						Portuguesa
						<input type="radio" name="radioSabor" id="radioPortuguesa" value="3">
						<img src="/imagens/portuguesa.png"  height="250px" width="250px" alt="Portuguesa">
					</label>
					<hr>
					<h3><span class="label label-default">Tamanhos</span></h3>
					<label class="radio-inline">
						<input type="radio" name="radioTamanho" id="radioPequena" value="1" required>
						Pequena
					</label>
					<label class="radio-inline">
						<input type="radio" name="radioTamanho" id="radioMedia" value="2">
						Média
					</label>
					<label class="radio-inline">
						<input type="radio" name="radioTamanho" id="radioGrande" value="3">
						Grande
					</label>
					<hr>
					<h3><span class="label label-default">Personalize a Pizza</span></h3>
					<label class="checkbox-inline">
						<input type="checkbox" id="checkboxExtraBacon" name="checkboxExtraBacon" value="1">
						Extra Bacon
					</label>
					<label class="checkbox-inline">
						<input type="checkbox" id="checkboxSemCebola" name="checkboxSemCebola" value="1">
						Sem Cebola
					</label>
					<label class="checkbox-inline">
						<input type="checkbox" id="checkboxBordaRecheada" name="checkboxBordaRecheada" value="1">
						Borda Recheada
					</label>
					<hr>
					<button class="btn btn-success center-block" type="submit">Montar Pizza</button>
				</div>
			</div>

		</div>

	</div>
</div>
</form>
@endsection
