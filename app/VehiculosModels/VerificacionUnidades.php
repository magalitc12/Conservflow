<?php

namespace App\VehiculosModels;

use Illuminate\Database\Eloquent\Model;

class VerificacionUnidades extends Model
{
    //
    protected $fillable =
    [
        'fecha',
        'comprobante',
        'unidad_id',
        'costo',
        'costo_multa',
        'periodo'
    ];
    protected $table = 'verificacion_unidades';
}
