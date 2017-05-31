<?php

namespace Motivacion\Models\Parametros;

use Illuminate\Database\Eloquent\Model;

class Tipo_Parametro extends Model{

	protected $table = 'tipo_parametro';
	public $timestamps = false;	

	public function Nombre_Unidad()	{		
		return $this->belongsto(Tipo_Unidad::class,'fk_parametro');
	}	

}
