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
}