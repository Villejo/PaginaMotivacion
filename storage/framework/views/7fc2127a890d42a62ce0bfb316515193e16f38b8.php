<!DOCTYPE html>
<html >
<head>
  <meta charset="UTF-8">
  <title>Bienvenidos a TpmMovil</title>


  <link rel='stylesheet prefetch' href='http://fonts.googleapis.com/css?family=Open+Sans:600'>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" >

  <link rel="stylesheet" href="global/Login3/css/style.css">
  <!-- <link href="global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/> -->
  <link rel="icon" type="image/png" href="global/slider/FotosSucroal/Nuevas/paginaweb.ico">

</head>


<body>
  <!-- Modal -->
  <div class="modal fade" id="modal_bienvenido" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">        
          <h4 class="modal-title" id="myModalLabel"><b><strong> <font size ="3", color ="#007835">Bienvenido  a TpmMovil</font></strong></b></h4>
        </div>        
        <div class="modal-footer">        
          <button type="button" class="btn btn-success aceptar" data-dismiss="modal">Cerrar</button>
        </div>
      </div>
    </div>
  </div>
  <!-- Modal -->
  <div class="login-wrap">
    <div class="login-html">
      <input id="tab-1" type="radio" name="tab" class="sign-in" checked><label for="tab-1" class="tab">BIENVENIDOS</label>
      <input id="tab-2"  name="tab" class="sign-up"><label for="tab-2" class="tab">TpmMovil</label>
      <div class="login-form">
        <div class="sign-in-htm">
          <div class="group">
            <label for="user" class="label">Correo Electrónico
            </label>
            <input id="email" type="email" class="input">
          </div>
          <div class="group">
            <label for="pass" class="label">Contraseña</label>
            <input id="password" type="password" class="input" data-type="password">
          </div>
          <!-- <div class="group">
            <input id="check" type="checkbox" class="check" checked>
            <label for="check"><span class="icon"></span> Keep me Signed in</label>
          </div> -->
          <input type="hidden" name="_token" id="_token" value="<?php echo e(csrf_token()); ?>">  
          <div class="group">
            <input type="button" class="button IniciarSesion" value="Iniciar la Sesión">
          </div>
          <div class="hr">
            <div class="panel panel-danger" style="display:none" id="mensaje">
              <div class="panel-heading" id="valida" style="display:none">        
              </div>
            </div>
            <center><img src="global/Login3/GifSesion3.gif" height="100" id="LoadingGif"  style="display: none;"></center>
          </div>
          <!-- <div class="foot-lnk">
            <a href="#forgot">Forgot Password?</a>
          </div> -->
          
        </div>
        <div class="sign-up-htm">
          <div class="group">
            <label for="user" class="label">Username</label>
            <input id="user" type="text" class="input">
          </div>
          <div class="group">
            <label for="pass" class="label">Password</label>
            <input id="pass" type="password" class="input" data-type="password">
          </div>
          <div class="group">
            <label for="pass" class="label">Repeat Password</label>
            <input id="pass" type="password" class="input" data-type="password">
          </div>
          <div class="group">
            <label for="pass" class="label">Email Address</label>
            <input id="pass" type="text" class="input">
          </div>
          <div class="group">
            <input type="submit" class="button" value="Sign Up">
          </div>
          <div class="hr"></div>
          <div class="foot-lnk">
            <label for="tab-1">Already Member?</a>
            </div>
          </div>
        </div>
      </div>
    </div>



    <script src="global/plugins/jquery/jquery-3.1.0.min.js"></script>

    <script type="text/javascript"> 




      function validar_login(){
        var email = $('#email').val();
        var password = $('#password').val();
        emailRegex = /^[-\w.%+]{1,64}@(?:[A-Z0-9-]{1,63}\.){1,125}[A-Z]{2,63}$/i; 
        var str =  email;
        var resultado = str.toLowerCase();
        if(email==""){
          $('#valida').html('');
          $('#mensaje').show();
          $('#valida').append('<p><strong>El correo no puede estar vacio.</strong></p>'); 
          document.getElementById("valida").style.display = "block";
          document.getElementById("email").focus();
          return true;
        }else{
          $('#valida').html('');
          if (emailRegex.test(resultado)){
            if(password==""){
             $('#mensaje').show();
             $('#valida').append('<p><strong>El password no puede estar vacio.</strong></p>'); 
             document.getElementById("valida").style.display = "block";
             document.getElementById("password").focus();
             return true;
           }
         }else{
          $('#valida').html('');
          $('#mensaje').show();
          $('#valida').append('<p><strong>Error: La dirección de correo es incorrecta.</strong></p>'); 
          document.getElementById("valida").style.display = "block";
          document.getElementById("email").focus();
          return true;
        }
        $('#mensaje').hide();
        return false;
      }
    }
    $('.IniciarSesion').click(function(){
     if(validar_login()==true){
     }else{
      var email =$('#email').val();
      var password =$('#password').val();
      var _token=$('#_token').val();

      $.ajax({
        url   : "<?= URL::to('Login') ?>",
        type  : "POST",
        async : false,   
        data  :{
          '_token'  : _token,
          'email'   : email,
          'password': password
        },    
        success:function(data){
          $('#valida').html('');
          if(data.error==false){
            $.each(data.errors,function(index, error){ 
              $('#mensaje').show();
              $('#valida').append('<p><strong>'+error+'</strong></p>');     
              document.getElementById("valida").style.display = "block";      
            });  
            $('#LoadingGif').hide();  
          }          
          if(data.ErrorEnPass==false){               
            $('#mensaje').show();           
            $('#valida').append('<p><strong>'+data.errors+'</strong></p>'); 
            document.getElementById("valida").style.display = "block"; 
            $('#LoadingGif').hide();              
          }
          if(data=='ok'){
           $('#mensaje').hide();
           $('#valida').html('');
           document.getElementById("valida").style.display = "block"; 
           // $('#modal_bienvenido').modal('show'); 
           Actualizar_Fecha_Ultimo_Ingreso();           
           $('#LoadingGif').show();
           window.setTimeout('document.location.href = "<?php echo e(route('Index')); ?>"',3000);
           console.clear();   
           // $('#LoadingGif').hide(); 

         }
         if(data.ErrorInactivo==false){     
          $('#mensaje').show();           
          $('#valida').append('<p><strong>'+data.errors+'</strong></p>'); 
          document.getElementById("valida").style.display = "block"; 
        }
      }
    });      
    }
  });
    $('.aceptar').click(function(){   
      document.location.href = "<?php echo e(route('Index')); ?>";
    });

    function Loguear(){
      if(validar_login()==true){
      }else{
        var email =$('#email').val();
        var password =$('#password').val();
        var _token=$('#_token').val();

        $.ajax({
          url   : "<?= URL::to('Login') ?>",
          type  : "POST",
          async : false,   
          data  :{
            '_token'  : _token,
            'email'   : email,
            'password': password
          },    
          success:function(data){
            $('#valida').html('');
            if(data.error==false){
              $.each(data.errors,function(index, error){ 
                $('#mensaje').show();
                $('#valida').append('<p><strong>'+error+'</strong></p>');     
                document.getElementById("valida").style.display = "block";      
              });  
            }          
            if(data.ErrorEnPass==false){               
              $('#mensaje').show();           
              $('#valida').append('<p><strong>'+data.errors+'</strong></p>'); 
              document.getElementById("valida").style.display = "block";             
            }
            if(data=='ok'){
             $('#mensaje').hide();
             $('#valida').html('');
             document.getElementById("valida").style.display = "block"; 
             // $('#modal_bienvenido').modal('show');  
             Actualizar_Fecha_Ultimo_Ingreso(); 

           }
           if(data.ErrorInactivo==false){        
            $('#mensaje').show();           
            $('#valida').append('<p><strong>'+data.errors+'</strong></p>'); 
            document.getElementById("valida").style.display = "block"; 
          }
        }
      });      
      } 
    } 

    function Actualizar_Fecha_Ultimo_Ingreso(){
      var email =$('#email').val();  
      $.ajax({
        url   : "<?= URL::to('Actualizar_Fecha_Ultimo_Ingreso') ?>",
        type  : "GET",
        async : false,   
        data  :{      
          'email'   : email    
        },    
        success:function(data){     
        }
      }); 
    }

    <?php if(Session::has('Session_Closed')): ?>
    Mostrar_Mensaje_Cuenta_Inactiva();
    <?php endif; ?>

    function Mostrar_Mensaje_Cuenta_Inactiva(){
      $('#mensaje').show();           
      $('#valida').append('<p><?php echo e(Session::get('Session_Closed')); ?></p>'); 
      document.getElementById("valida").style.display = "block"; 
    }


    function handle(e){
      if(e.keyCode === 13){
            e.preventDefault(); // Ensure it is only this code that rusn
            Loguear();            
          }
        }
      </script>

      <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
      <script src="global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
      <script src="global/plugins/jquery-ui/jquery-ui.min.js" type="text/javascript"></script>



      <script src="global/Login2/js/index.js"></script>

    </body>
    <!-- END BODY -->
    </html>

