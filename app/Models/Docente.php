<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Este es un modelo de estudiante similar al estudiante de CETI
 *
 * @property int $id es numerico incremental
 * @property string $nombre no puede ser null ni vacio
 * @property ?string $especialidad puede ser null
 * @property int $nomina minimo 3 digitos numericos
 * @property string $fecha_creacion
 * @property string $fecha_actualizacion
 */

class Docente extends Model
{

    use HasFactory;

    protected $table = 'docentes';
    protected $fillable = [
        'id',
        'nombre',
        'especialidad',
        'nomina',
    ];
}
