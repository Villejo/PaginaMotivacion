@extends('layouts.master')
@section('title')
Gana dinero desde Casa
@stop
@section('content')
@foreach($Publicaciones as $Publicacion)
<div class="panel panel-info">
	<div class="panel-heading">
		<div class="post-title">
			<a href="single.html">
				<h1>
					<center>{{$Publicacion->Titulo_Publicacion}}</center>
				</h1>
			</a>			
		</div>		
	</div>
	<div class="panel-body">
		<div class="panel panel-warning">
			<!-- <div class="panel-heading"></div> -->
			<div class="panel-body">
				<div class="col-md-12 blog-post">					
					<div class="post-info">
						<span>Publicado : {{Carbon::parse($Publicacion->Fecha_Publicacion)->toFormattedDateString()}}/ por <strong>{{$Publicacion->Nombre_Usuario_Publicacion->nombre}} {{$Publicacion->Nombre_Usuario_Publicacion->apellido}}</strong> <a href="#" target="_blank"></a></span>
					</div>  
					<p>
						{{$Publicacion->Detalle_Publicacion}}
						<br>
						<a href="single.html" class="button button-style button-anim fa fa-long-arrow-right">Leer Más</a>
					</p>
					<div class="post-image">
						<!-- <img src="Estilos/images/blog/1.jpg" alt=""> -->
					</div>
				</div>
				<div class="row">	
					<div class="col-xs-12 col-sm-12 col-md-12 col-lg-8 col-md-offset-1">	
						<div class="fb-comments" data-href="http://comentario1.net/" data-numposts="10"></div>
					</div>					
				</div>
			</div>
		</div>
	</div>
</div>
<br>

@endforeach




<div id="fb-root"></div>
<script>(function(d, s, id) {
	var js, fjs = d.getElementsByTagName(s)[0];
	if (d.getElementById(id)) return;
	js = d.createElement(s); js.id = id;
	js.src = "//connect.facebook.net/es_ES/sdk.js#xfbml=1&version=v2.9";
	fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>



@stop