<link rel="stylesheet" href="global/Login2/css/style2.css"> 
<link href="global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
<link href="global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
<script src="global/plugins/jquery/jquery-3.1.0.min.js"></script>

<br>
<br>
<br>
<center>
	<form name="f1"> 		
		<label>Ingresa Password a Encriptar:</label>
		<input type="text" name="password" id="password" class="form-control form-group">
		<input type="hidden" name="_token" id="_token" value="{{ csrf_token()}}">  
		<button type="button" class="btn btn-success form-control form-group registrar">Encriptar</button>
		<br>
		<br>
		<br>
		<div class="panel panel-danger" style="display:none" id="mensaje">
			<div class="panel-heading" id="valida" style="display:none">
			</div>
		</div>		
		<input type="hiden" id="passwordEncriptado" class="form-control" readonly>
		<label id="resultado" style="display: none;">Resultado:</label>
	</form>
</center>

<script type="text/javascript">

	function copiarAlPortapapeles() {
		var passwordEncriptado = document.getElementById("passwordEncriptado");
		passwordEncriptado.select();
		try {			
			var successful = document.execCommand('copy');			
		} catch (err) {
			// answer.innerHTML = 'Browser no soportado!';
		}
	}

	function valida(){
		var resultado=$('#resultado').text();
		var passwordEncriptado=$('#passwordEncriptado').text();
		var password=$('#password').val();
		var espacio_blanco    = /[a-z,0-9]/i;  //Expresión regular

		if(password==""){	
			$('#mensaje').show();
			document.getElementById("valida").innerText = "Ingresa un password.";
			document.getElementById("valida").style.display = "block";
			$('#password').val('');
			document.getElementById("password").focus();
			return true;
		}else{
			if(!espacio_blanco.test(password)){
				$('#mensaje').show();
				document.getElementById("valida").innerText = "Ingresa un password.";	
				document.getElementById("valida").style.display = "block";	
				$('#password').val('');
				document.getElementById("password").focus();
				return true;
			}else{
				$('#mensaje').hide();
				document.getElementById("valida").innerText = "";
				return false;
			}
		}
	}

	$('.registrar').click(function(){
		if(valida()==true){
		}else{
			var password=$('#password').val();
			var _token=$('#_token').val();
			$.ajax({
				url   : "<?= URL::to('Encriptar_Password_Temporal') ?>",
				type  : "POST",
				async : false,   
				data  :{
					'_token'       	  : _token,
					'password'    	 : password
				},    
				success:function(data){	
					$('#passwordEncriptado').val(data);	
					copiarAlPortapapeles();	
					document.getElementById("resultado").innerText = 'BIEN.!!! El Password fue generado y copiado Al Portapapeles';	
					document.getElementById("resultado").style.display = "block";
					$('#password').val('');
					document.getElementById("password").focus();

				}
			});
		}
	});
</script>

