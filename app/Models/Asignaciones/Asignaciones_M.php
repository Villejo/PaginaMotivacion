<?php

namespace Motivacion\Models\Asignaciones;

use Illuminate\Database\Eloquent\Model;
use Motivacion\Models\Turnos\Turnos_M;
use Motivacion\Models\Formulario\Encabezado_Formulario;
use Motivacion\Models\Usuarios\Usuario;
use Motivacion\Models\Equipos\Equipo;

class Asignaciones_M extends Model{

	protected $table = 'asignaciones';
	public $timestamps = false;	

	public function Nombre_Turno()	{		
		return $this->belongsto(Turnos_M::class,'fk_turno');
	}	

	public function Nombre_Formulario()	{		
		return $this->belongsto(Encabezado_Formulario::class,'fk_formulario');
	}

	public function Nombre_Usuario()	{		
		return $this->belongsto(Usuario::class,'fk_usuarios');
	}

	public function Nombre_Equipo()	{		
		return $this->belongsto(Equipo::class,'fk_maquina');
	}

}
