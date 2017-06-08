<?php

namespace WebMotivacion\Models\Index;

use Illuminate\Database\Eloquent\Model;
// use TPM_MOVIL\Models\Turnos\Turnos_M;


class Visitas_M extends Model{

	protected $table = 'visitas';
	public $timestamps = false;	

	// public function Nombre_Turno()	{		
	// 	return $this->belongsto(Turnos_M::class,'fk_turno');
	// }	

	// public function Nombre_Formulario()	{		
	// 	return $this->belongsto(Encabezado_Formulario::class,'fk_formulario');
	// }

	// public function Nombre_Usuario()	{		
	// 	return $this->belongsto(Usuario::class,'fk_usuarios');
	// }

	// public function Nombre_Equipo()	{		
	// 	return $this->belongsto(Equipo::class,'fk_maquina');
	// }

}
