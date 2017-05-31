<?php

namespace Motivacion\Models\Formulario;

use Illuminate\Database\Eloquent\Model;
use Motivacion\Models\Parametros\Tipo_Parametro;
use Motivacion\Models\Parametros\Tipo_Unidad;

class Detalle_Formulario extends Model{

	protected $table = 'detalle_formulario';
	public $timestamps = false;


	public function NombreParametro()	{		
		return $this->belongsto(Tipo_Parametro::class,'parametros_control');
	}

	public function NombreUnidad()	{		
		return $this->belongsto(Tipo_Unidad::class,'unidad');
	}
}
