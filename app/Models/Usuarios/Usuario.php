<?php


namespace Motivacion\Models\Usuarios;
use Motivacion\Models\Roles\Roles;


use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
	// use UserTrait, RemindableTrait;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'usuarios';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array('password', 'remember_token');


	public function getRememberToken()
	{
		return $this->remember_token;
	}

	/**
	 * Set the token value for the "remember me" session.
	 *
	 * @param  string  $value
	 * @return void
	 */
	public function setRememberToken($value)
	{
		$this->remember_token = $value;
	}

	/**
	 * Get the column name for the "remember me" token.
	 *
	 * @return string
	 */
	public function getRememberTokenName()	{
		return 'remember_token';
	}

	public $timestamps = false;


	public function Nombre_Rol()	{		
		return $this->belongsto(Roles::class,'fk_rol');
	}
	

}