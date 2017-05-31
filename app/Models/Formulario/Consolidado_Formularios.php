<?php

namespace Motivacion\Models\Formulario;

use Motivacion\Models\Usuarios\Usuario;
use Motivacion\Models\Turnos\Turnos_M;


use Illuminate\Database\Eloquent\Model;



class Consolidado_Formularios extends Model{


	protected $table = 'consolidado_formularios';
	public $timestamps = false;


	public function Encabezado_Formulario()	{		
		return $this->belongsto(Encabezado_Formulario::class,'fk_encabezado_formulario');
	}

	public function Formulario_Usuario()	{		
		return $this->belongsto(Usuario::class,'fk_usuario');
	}



	// public function Detalle_Formulario()	{		
	// 	return $this->belongsto(Formulario::class,'fk_detalle_formulario');
	// }

	// public function Formulario_Turno()	{		
	// 	return $this->belongsto(Formulario::class,'fk_turno');
	// }

	// public function Formulario_Usuario()	{		
	// 	return $this->belongsto(Formulario::class,'fk_usuario');
	// }
	
	public function Nombre_Turno()	{		
		return $this->belongsto(Turnos_M::class,'fk_turno');
	}

}
