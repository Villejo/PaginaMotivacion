<?php

namespace Motivacion\Models\Publicaciones;

// use Motivacion\Models\Usuarios\Usuario;
// use Motivacion\Models\Equipos\Equipo;
use Illuminate\Database\Eloquent\Model;

class Comentario extends Model{
	
	protected $table = 'likes';
	public $timestamps = false;


	public function Nombre_Usuario_Publicacion()	{		
		return $this->belongsto(Usuario::class,'fk_Usuario_Publicacion');
	}

	// public function Nombre_Equipo()	{		
	// 	return $this->belongsto(Equipo::class,'fk_equipo');
	// }
}
