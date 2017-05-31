@extends('layouts.master')
@section('title')
Gana dinero desde Casa
@stop
@section('content')
@foreach($Publicaciones as $Publicacion)
<div class="col-md-12 blog-post">
	<div class="post-image">
		<!-- <img src="Estilos/images/blog/1.jpg" alt="">-->
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
	<div class="row">
		<div class="col-xs-5 col-sm-5">
			<a href="single.html" class="button button-style button-anim fa fa-long-arrow-right"><span>Leer Más</span></a>
		</div>
	</div>
	<hr>
	<div class="row">	
		<div class="col-xs-3 col-sm-3">			
			0 (Me gusta)
		</div>
		<div class="col-xs-3 col-sm-3">			
			0 (Comentarios)			
		</div>
	</div>
	<div class="row">	
		<div class="col-xs-3 col-sm-3">
			<a href="" style="color: #020202" id="">			
				<i class="fa fa-thumbs-up" aria-hidden="true"></i>
				Me gusta
			</a>
		</div>
		<div class="col-xs-3 col-sm-3">
			<!-- <a href="" style="color: #0290ef"> -->
			<a href="" style="color: #020202">	
				<i class="fa fa-comment" aria-hidden="true"></i>
				Comentar
			</a>
		</div>
		<hr>
	</div>

</div>
@endforeach
@stop