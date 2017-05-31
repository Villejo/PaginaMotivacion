<div class='panel panel-info'>
	<div class='panel-heading'></div>
	<div class='panel-body'>		
		<div class="row">			
			<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 col-md-offset-3">
				<center>
					<img src='global/images/ProximaApertura.png' width='200px' height='200px' class='img-responsive' ><br><br>
				</center>				
			</div>			
		</div>
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-6 col-md-offset-3">
			<div id="clockdiv">
				<div>
					<span class="days"></span>
					<div class="smalltext">DIAS</div>
				</div>
				<div>
					<span class="hours"></span>
					<div class="smalltext">HORAS</div>
				</div>
				<div>
					<span class="minutes"></span>
					<div class="smalltext">MINUTOS</div>
				</div>
				<div>
					<span class="seconds"></span>
					<div class="smalltext">SEGUNDOS</div>
				</div>
			</div>
		</div>

	</div>
</div>
</div>

<style type="text/css">
	body{
		text-align: center;
		/*background: #00ECB9;*/
		font-family: sans-serif;
		font-weight: 100;
	}

	h1{
		color: #396;
		font-weight: 100;
		font-size: 40px;
		margin: 40px 0px 20px;
	}

	#clockdiv{
		font-family: sans-serif;
		color: #fff;
		display: inline-block;
		font-weight: 100;
		text-align: center;
		font-size: 30px;
	}

	#clockdiv > div{
		padding: 8px;
		border-radius: 3px;
		background: #32bcba;
		display: inline-block;
	}

	#clockdiv div > span{
		padding: 8px;
		border-radius: 3px;
		background: #1f5454;
		display: inline-block;
	}
	.smalltext{
		padding: 8px;
		font-size: 16px;
	}
</style>
<script>
	ConteoRegresivo();
	function  ConteoRegresivo(){
		var countDownDate = new Date("{{$variable}}").getTime();
		var x = setInterval(function() {
			var now = new Date().getTime();  
			var distance = countDownDate - now; 
			var days = Math.floor(distance / (1000 * 60 * 60 * 24));
			var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
			var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
			var seconds = Math.floor((distance % (1000 * 60)) / 1000);  
			$('.days').html(days);
			$('.hours').html(hours);
			$('.minutes').html(minutes);
			$('.seconds').html(seconds);  
			if (distance < 0) {
				clearInterval(x);  	
				$('.days').html('0');
				$('.hours').html('0');
				$('.minutes').html('0');
				$('.seconds').html('0');
				setTimeout('document.location.href = "{{ route('Index')}}"',1);
			}
		}, 1000);
	}
</script>

