<?php

namespace Motivacion\Models\Formulario;

use Illuminate\Database\Eloquent\Model;
use Motivacion\Models\Usuarios\Usuario;
use Motivacion\Models\Equipos\Equipo;

class Encabezado_Formulario extends Model{

	protected $table = 'encabezado_formulario';
	public $timestamps = false;	


	public function Nombre_Equipo()	{		
		return $this->belongsto(Equipo::class,'fk_equipos');
	}


}
