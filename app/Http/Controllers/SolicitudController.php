<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Solicitud;
use Carbon\Carbon;

class SolicitudController extends Controller
{
    public function index()
    {
        $solicitudes = Solicitud::orderBy('id', 'desc')->get();
        return view('solicitudes.index', compact('solicitudes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'numero_radicado' => 'required',
            'remitente' => 'required'
        ]);

        Solicitud::create($request->all());

        return redirect()->route('solicitudes.index')
            ->with('success', 'Solicitud registrada correctamente.');
    }

    public function destroy($id)
    {
        Solicitud::findOrFail($id)->delete();

        return redirect()->route('solicitudes.index')
            ->with('success', 'Solicitud eliminada correctamente.');
    }

    public function edit($id)
    {
        $solicitud = Solicitud::findOrFail($id);
        return view('solicitudes.edit', compact('solicitud'));
    }

    public function update(Request $request, $id)
    {
        $solicitud = Solicitud::findOrFail($id);
        $solicitud->update($request->all());

        return redirect()->route('solicitudes.index')
            ->with('success', 'Solicitud actualizada correctamente.');
    }

    public function export()
    {
        $solicitudes = Solicitud::orderBy('fecha', 'desc')->get();

        $filename = "solicitudes_" . date('Y-m-d_H-i-s') . ".csv";

        $headers = [
            "Content-type" => "text/csv; charset=UTF-8",
            "Content-Disposition" => "attachment; filename=$filename",
            "Pragma" => "no-cache",
            "Cache-Control" => "must-revalidate, post-check=0, pre-check=0",
            "Expires" => "0"
        ];

        $columns = [
            "#",
            "FECHA",
            "N° RADICADO",
            "OBJETO DE LA SOLICITUD",
            "REMITENTE",
            "CARGO",
            "EMPRESA",
            "CORREO",
            "CONTACTO",
            "MUNICIPIO",
            "RADICADO RESPUESTA",
            "FECHA RADICACIÓN RESPUESTA",
            "SINTESIS DE RESPUESTA",
            "OBSERVACIONES",
            "AGENDA REUNIONES DE CONCERTACIÓN - VIRTUAL",
            "COMPROMISO",
            "FECHA DE VENCIMIENTO SOLICITUD"
        ];

        $callback = function() use ($solicitudes, $columns) {
            $file = fopen('php://output', 'w');

            // BOM UTF-8 para Excel
            fprintf($file, chr(0xEF).chr(0xBB).chr(0xBF));

            // Escribir encabezados con separador ;
            fputcsv($file, $columns, ';');

            $contador = 1;

            foreach ($solicitudes as $s) {
                fputcsv($file, [
                    $contador++, // #
                    Carbon::parse($s->fecha)->format('Y-m-d'),
                    $s->numero_radicado,
                    $s->objeto_solicitud,
                    $s->remitente,
                    $s->cargo,
                    $s->empresa,
                    $s->correo,
                    $s->contacto,
                    $s->municipio,
                    $s->radicado_respuesta,
                    $s->fecha_radicacion_respuesta ? Carbon::parse($s->fecha_radicacion_respuesta)->format('Y-m-d') : '',
                    $s->sintesis_respuesta,
                    $s->observaciones,
                    $s->agenda_reuniones,
                    $s->compromiso,
                    $s->fecha_vencimiento ? Carbon::parse($s->fecha_vencimiento)->format('Y-m-d') : '',
                ], ';'); // <-- separador ;
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}