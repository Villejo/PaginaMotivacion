@extends('layouts.master')
@section('title')
Gana dinero desde Casa
@stop
@section('content')
@foreach($Publicaciones as $Publicacion)
<div class="col-md-12 blog-post">
	<div class="post-image">
		<!-- <img src="Estilos/images/blog/1.jpg" alt="">                                        -->
	</div> 
	<div class="post-title">
		<a href="single.html">
			<h1>
				{{$Publicacion->Titulo_Publicacion}}
			</h1>
		</a>
	</div>  
	<div class="post-info">		
		<span>{{Carbon::parse($Publicacion->Fecha_Publicacion)->toFormattedDateString()}}/ por <a href="#" target="_blank">{{ucwords($Publicacion->Nombre_Usuario_Publicacion->nombre)}} {{ucwords($Publicacion->Nombre_Usuario_Publicacion->apellido)}}</a></span>
	</div>  
	<p>
		{{$Publicacion->Detalle_Publicacion}}
	</p>                          			
	<a href="single.html" class="button button-style button-anim fa fa-long-arrow-right"><span>Leer Más</span></a>
</div>			
@endforeach

<div class="col-md-12 text-center">
	<a href="javascript:void(0)" id="load-more-post" class="load-more-button">Load</a>
	<div id="post-end-message"></div>
</div>
@stop