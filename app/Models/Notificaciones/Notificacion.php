<?php

namespace Motivacion\Models\Notificaciones;

use Motivacion\Models\Usuarios\Usuario;
use Motivacion\Models\Equipos\Equipo;
use Illuminate\Database\Eloquent\Model;

class Notificacion extends Model{
	
	protected $table = 'notificaciones';
	public $timestamps = false;


	public function Nombre_Usuario()	{		
		return $this->belongsto(Usuario::class,'fk_usuario');
	}

	public function Nombre_Equipo()	{		
		return $this->belongsto(Equipo::class,'fk_equipo');
	}
}
