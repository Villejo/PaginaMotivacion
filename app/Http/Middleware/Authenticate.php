<?php

namespace Motivacion\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Redirect;


class Authenticate
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */



    public function handle($request, Closure $next, $guard = null)    {



     if (Auth::guard($guard)->guest()) {


      if ($request->ajax() || $request->wantsJson()) {
        return response('Unauthorized.', 401);          
      } else { 

        return redirect()->guest('/');

      }
      
    }else{
      $UsuarioLogueado=Auth::user()->estado_usuario;
      $mensajee="La sesión fue cerrada por que la cuenta fue desactivada. Consulte al administrador de la aplicación.";
      if ($UsuarioLogueado=='Inactivo') {
       Auth::logout();         
       return Redirect::to('/')->with('Session_Closed',$mensajee);        
     }        

   }

   return $next($request);

 }

}
