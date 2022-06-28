<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Empleado
 *
 * @property $id
 * @property $Nombre
 * @property $ApellidoPaterno
 * @property $ApellidoMaterno
 * @property $Correo
 * @property $id_empleo
 * @property $Foto
 * @property $created_at
 * @property $updated_at
 *
 * @property Empleo $empleo
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Empleado extends Model
{
    
    static $rules = [
		'Nombre' => 'required',
		'ApellidoPaterno' => 'required',
		'ApellidoMaterno' => 'required',
		'Correo' => 'required',
		'id_empleo' => 'required',
		'Foto' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['Nombre','ApellidoPaterno','ApellidoMaterno','Correo','id_empleo','Foto'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function empleo()
    {
        return $this->hasOne('App\Models\Empleo', 'id', 'id_empleo');
    }
    

}
