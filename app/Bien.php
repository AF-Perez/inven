<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laravel\Passport\HasApiTokens;

class Bien extends Model
{
    // nombre de la tabla real a mapear
    protected $table = 'bienes';

    public function bien_control_administrativo()
    {
        return $this->hasOne('App\BienControlAdministrativo', 'id_bien');
    }

    protected $hidden = [
        'created_at', 'updated_at'
    ];

    public function ubicacion()
    {
        // el framework determina el id de la ubicacion relacionada mirando
        // al nombre de este metodo y agregandole el sufijo _id, entoces se
        // debe agregar manualmente id_ubicacion al definir la relacion
        return $this->belongsTo('App\Ubicacion', 'id_ubicacion');
    }

    public function usuarios_finales()
    {
        return $this->belongsToMany('App\UsuarioFinal', 'asignaciones', 'id_bien', 'id_usuario_final')
          ->withPivot('activa')
          ->withTimestamps();
    }

    public function padre()
    {
        return $this->belongsTo('Bien', 'id_padre');
    }

    public function hijo()
    {
        return $this->hasMany('Bien', 'id');
    }

}
