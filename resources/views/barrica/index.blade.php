@extends('layouts.app2')
@section('content')
	{{-- expr --}}
	<div class="container-fluid">
		<div class="container">
			<div class="col">
				<h1>Barricas</h1>
			</div>
			<div class="col-3 input-group input-group-lg mb-3">
		  		<a href="{{ route('barricas.create') }}" class="btn btn-primary">Agregar nueva barrica</a>
			</div>
		</div>
		<br>
		<br>
		<br>
		<br>
		<div class="container-fluid">
			<table class="table">
				<thead class="thead-dark">
					<tr>
						<th scope="col" style="width: 100px">Tipo</th>
						<th scope="col">Subtipo</th>
						<th scope="col">Tostado</th>
						<th scope="col">Uva</th>
						<th scope="col" style="width: 250px">Productor</th>
						<th scope="col">Fecha inicio</th>
						<th scope="col">Fecha embotellado(tentativa)</th>
						<th>Precio de la uva</th>
						<th>Precio de producción</th>
						<th>Precio venta</th>
						<th>Acción</th>
					</tr>
				</thead>
				<tbody>
					@forelse ($barricas as $barrica)
						{{-- expr --}}
						<tr>
							<th scope="row">@if ($barrica->barrica_bodega)
								{{-- true expr --}}
								{{$barrica->barrica_bodega->tipo}}
							@else
								{{-- false expr --}}
								La barrica de esta bodega ha sido eliminada
							@endif</th>
							<th>
								@if ($barrica->barrica_bodega)
								{{-- true expr --}}
								{{$barrica->barrica_bodega->subtipo}}
							@else
								{{-- false expr --}}
								La barrica de esta bodega ha sido eliminada
							@endif
								</th>
							<th>
								@if ($barrica->barrica_bodega)
								{{-- true expr --}}
								{{$barrica->barrica_bodega->tostado}}
							@else
								{{-- false expr --}}
								La barrica de esta bodega ha sido eliminada
							@endif

								</th>
							<th>{{$barrica->uva}}</th>
							<th>{{$barrica->producido_type == 'App\Productor' ? 'Productor: ' : 'Bodega: ' }} @if (isset($barrica->producido))
								{{-- true expr --}}
								 {{$barrica->producido->nombre}}
							@else
								{{-- false expr --}}
								Tu productor a sido borrado
							@endif</th>
							<th>{{$barrica->fecha_inicio}}</th>
							<th>{{$barrica->fecha_embotellado}}</th>
							<th>${{$barrica->precio_uva}} USD</th>
							<th>${{$barrica->precio_prod}} USD</th>
							<th>${{$barrica->precio_venta}} USD</th>
							<th>
								<a class="btn btn-default" href="{{ route('barricas.edit',[$barrica]) }}">Editar</a>
								<form action="{{ route('barricas.destroy',[$barrica]) }}" method="POST">
									<input type="hidden" name="_method" value="DELETE">
									@csrf
									<button type="submit" class="btn btn-link" onclick="return confirm('¿Estás seguro que desea eliminar este barrica?');">Eliminar</button>
								</form>
							</th>
						</tr>
					@empty
						{{-- empty expr --}}
						<div class="alert alert-danger" role="alert">
							<span>No hay barricas</span>
						</div>
					@endforelse
				</tbody>
			</table>
		</div>
	</div>
@endsection