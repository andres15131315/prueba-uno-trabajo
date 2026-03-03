<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Solicitud extends Model
{
    protected $table = 'solicitudes';

    protected $fillable = [
        'fecha',
        'numero_radicado',
        'objeto_solicitud',
        'remitente',
        'cargo',
        'empresa',
        'correo',
        'contacto',
        'municipio',
        'radicado_respuesta',
        'fecha_radicacion_respuesta',
        'sintesis_respuesta',
        'observaciones',
        'agenda_reuniones',
        'compromiso',
        'fecha_vencimiento'
    ];
}