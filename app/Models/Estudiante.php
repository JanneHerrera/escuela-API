<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Este es un modelo de estudiante similar al estudiante de CETI
 *
 * @property int $id es numerico incremental
 * @property string $nombre no puede ser null ni vacio
 * @property int $registro solo puede ser una combinacion de 8 digitos numericos
 * @property int $grado solo puede ser un caracter del 1 al 8
 * @property string $grado Solo puede tener un caracter y debe de ser mayuscula (modificable a ser un char)
 * @property Status $status solo tendra de tipo enum status
 * @property string $fecha_creacion
 * @property string $fecha_actualizacion
 */
class Estudiante extends Model
{
    use HasFactory;

    protected $table = 'estudiante';
    protected $fillable = [
        'id',
        'nombre',
        'registro',
        'grado',
        'grupo',
        'status',
        'fecha_creacion',
        'fecha_actualizacion'
    ];
}
