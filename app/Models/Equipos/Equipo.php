<?php

namespace Motivacion\Models\Equipos;

use Illuminate\Database\Eloquent\Model;

class Equipo extends Model
{
	protected $table = 'equipos';
	public $timestamps = false;	

	public function Equipos_Tipo()	{		
		return $this->belongsto(Equipos::class,'fk_tipo_equipo');
	}

	public function Nombre_Tipo()	{		
		return $this->belongsto(Tipo_Equipo::class,'fk_tipo_equipo');
	}
}


