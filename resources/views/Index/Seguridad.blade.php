@extends('layouts.master')
@section('title')
Gana dinero desde Casa -SEGURIDAD
@stop
@section('content')
<div class="col-md-12 page-body">
	<div class="row">
		<div class="sub-title">
			<h2>Me alegra qu sigas y estes en esta parte :)</h2>
			<a href="contact.html"><i class="icon-envelope"></i></a>
		</div>
		<div class="col-md-12 content-page">
			<div class="col-md-12 blog-post">
				<div class="post-title margin-bottom-30">
					<center><h1>Factores de <span class="main-color">SEGURIDAD.</span></h1></center>
					<!-- <ul class="knowledge">
						<li class="bg-color-1">Diseñador web</li>
						<li class="bg-color-4">Desarrollador web</li>
						<li class="bg-color-6">Persona de libre dedicación</li>
						<li class="bg-color-5">Emprendedor</li>
					</ul> -->
				</div>	
				<!-- Video Start -->
				<div class="video-box margin-top-30 margin-bottom-80">
					<div class="video-tutorial">
						<a class="video-popup" href="https://www.youtube.com/watch?v=O2Bsw3lrhvs" title="Reprodúceme">
							<img src="images/televisor.png" alt="">
						</a>                           
					</div>
					<p>Tomate tu tiempo y mira este increíble video.</p>
					
				</div>
				<!-- Video End -->
				<br>			
				<p>
					<center><h1>Enlaces mencionados en el<span class="main-color"> VIDEO.</span></h1></center>					

					<center><a href="http://www.rues.org.co/RUES_Web/consultas/DetalleRM?codigo_camara=11&matricula=0000256684">1. Enlace de la Cámara de Comercio.</a></center><br>
					<center><a href="https://www.facebook.com/groups/clickeame/">2.Grupo oficial de Facebook de la empresa</a></center><br>
					<center><a href="#">3. Numero de servico al cliente. Solo WhatsApp : +57 301-707-5124​⁠​</a></center><br>
					<center><a href="https://www.facebook.com/YosoynetworkedH/videos/1256325697748286/">4. Participación del señor Gerson Fuentes en presentación en directo</a></center><br>
					<center><a href="https://i.imgur.com/sIYx4UK.png">5. Documentos expedidos por la superintendencia de sociedades:
					</a></center><br>
					<center><a href="https://youtu.be/6IegpgFWBAw">6. Video recomendado de Youtube:
					</a></center><br>
				</p>				
				<br><br><br>
				
				<center>
					<a href="{{URL::route('Seguridad')}}">
						<button class="btn btn-success" type="button">						
							>> TERCER PASO (HERRAMIENTAS)							
						</button>
					</a>
				</center>
				<br><br><br>


				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" style="display:inline-block;text-align:center;justify-content: center;aling-items: center">
					<div class="panel panel-warning" style="background: #c2c3c4">
						<!-- <div class="panel-heading"></div> -->
						<div class="panel-body">
							<div class="row">
								<div class="fb-comments" data-href="http://comentario1.net/" data-numposts="10"></div>
							</div>					
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>














<div id="fb-root"></div>
<script>(function(d, s, id) {
	var js, fjs = d.getElementsByTagName(s)[0];
	if (d.getElementById(id)) return;
	js = d.createElement(s); js.id = id;
	js.src = "//connect.facebook.net/es_ES/sdk.js#xfbml=1&version=v2.9";
	fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>



@stop