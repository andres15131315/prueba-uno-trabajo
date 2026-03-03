<!DOCTYPE html>
<html>
<head>
    <title>Sistema de Solicitudes - SENA</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4fdf6;
            margin: 0;
        }

        header {
            background-color: #00843D;
            color: white;
            padding: 20px;
            text-align: center;
            font-size: 22px;
            font-weight: bold;
        }

        .container {
            width: 95%;
            margin: 20px auto;
            background: white;
            padding: 25px;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
        }

        h2 {
            color: #00843D;
        }

        label {
            font-weight: bold;
        }

        input, textarea {
            width: 100%;
            padding: 8px;
            margin-top: 5px;
            margin-bottom: 15px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }

        button {
            background-color: #39A900;
            color: white;
            padding: 6px 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-weight: bold;
        }

        button:hover {
            background-color: #2e8600;
        }

        .btn-delete {
            background-color: red;
        }

        .btn-edit {
            background-color: #0066cc;
            color: white;
            padding: 5px 8px;
            border-radius: 4px;
            text-decoration: none;
            font-size: 12px;
        }

        .success {
            color: #00843D;
            font-weight: bold;
        }

        .error {
            color: red;
            margin-bottom: 15px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 12px;
        }

        table th {
            background-color: #00843D;
            color: white;
            padding: 8px;
        }

        table td {
            padding: 6px;
            border: 1px solid #ddd;
            text-align: center;
        }

        table tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        .table-container {
            overflow-x: auto;
        }
    </style>
</head>

<body>

<header>
    Sistema de Gestión de Solicitudes - SENA
</header>

<div class="container">

<h2>Registrar Nueva Solicitud</h2>

@if(session('success'))
    <p class="success">{{ session('success') }}</p>
@endif

@if($errors->any())
    <div class="error">
        <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('solicitudes.store') }}" method="POST">
@csrf

<label>Fecha:</label>
<input type="date" name="fecha">

<label>N° Radicado:</label>
<input type="text" name="numero_radicado">

<label>Objeto de la Solicitud:</label>
<textarea name="objeto_solicitud"></textarea>

<label>Remitente:</label>
<input type="text" name="remitente">

<label>Cargo:</label>
<input type="text" name="cargo">

<label>Empresa:</label>
<input type="text" name="empresa">

<label>Correo:</label>
<input type="email" name="correo">

<label>Contacto:</label>
<input type="text" name="contacto">

<label>Municipio:</label>
<input type="text" name="municipio">

<label>Radicado Respuesta:</label>
<input type="text" name="radicado_respuesta">

<label>Fecha Radicación Respuesta:</label>
<input type="date" name="fecha_radicacion_respuesta">

<label>Síntesis de Respuesta:</label>
<textarea name="sintesis_respuesta"></textarea>

<label>Observaciones:</label>
<textarea name="observaciones"></textarea>

<label>Agenda Reuniones:</label>
<input type="text" name="agenda_reuniones">

<label>Compromiso:</label>
<textarea name="compromiso"></textarea>

<label>Fecha de Vencimiento:</label>
<input type="date" name="fecha_vencimiento">

<button type="submit">Guardar Solicitud</button>

</form>

<hr>

<h2>Listado General</h2>

<div class="table-container">
<table>
<tr>
<th>#</th>
<th>Fecha</th>
<th>N° Radicado</th>
<th>Objeto</th>
<th>Remitente</th>
<th>Cargo</th>
<th>Empresa</th>
<th>Correo</th>
<th>Contacto</th>
<th>Municipio</th>
<th>Radicado Resp.</th>
<th>Fecha Resp.</th>
<th>Síntesis</th>
<th>Observaciones</th>
<th>Agenda</th>
<th>Compromiso</th>
<th>Vencimiento</th>
<th>Acciones</th>
</tr>

@forelse($solicitudes as $index => $s)
<tr>

<td>{{ $index + 1 }}</td>
<td>{{ $s->fecha }}</td>
<td>{{ $s->numero_radicado }}</td>
<td>{{ $s->objeto_solicitud }}</td>
<td>{{ $s->remitente }}</td>
<td>{{ $s->cargo }}</td>
<td>{{ $s->empresa }}</td>
<td>{{ $s->correo }}</td>
<td>{{ $s->contacto }}</td>
<td>{{ $s->municipio }}</td>
<td>{{ $s->radicado_respuesta }}</td>
<td>{{ $s->fecha_radicacion_respuesta }}</td>
<td>{{ $s->sintesis_respuesta }}</td>
<td>{{ $s->observaciones }}</td>
<td>{{ $s->agenda_reuniones }}</td>
<td>{{ $s->compromiso }}</td>

<td>
@php
    $hoy = \Carbon\Carbon::now();
    $vencimiento = $s->fecha_vencimiento 
        ? \Carbon\Carbon::parse($s->fecha_vencimiento)
        : null;
@endphp

@if($vencimiento)
    @php
        $dias = $hoy->diffInDays($vencimiento, false);
    @endphp

    @if($dias < 0)
        <span style="color:red;font-weight:bold;">🔴 VENCIDO</span>
    @elseif($dias <= 5)
        <span style="color:orange;font-weight:bold;">🟡 POR VENCER</span>
    @else
        <span style="color:green;font-weight:bold;">🟢 VIGENTE</span>
    @endif

    <br>
    {{ $s->fecha_vencimiento }}
@else
    Sin fecha
@endif
</td>

<td>
<a href="{{ route('solicitudes.edit', $s->id) }}" class="btn-edit">
Editar
</a>

<form action="{{ route('solicitudes.destroy', $s->id) }}" 
      method="POST" 
      style="display:inline;">
@csrf
@method('DELETE')

<button type="submit" 
        class="btn-delete"
        onclick="return confirm('¿Eliminar solicitud?')">
Eliminar
</button>
</form>
</td>

</tr>
@empty
<tr>
<td colspan="18">No hay registros</td>
</tr>
@endforelse

</table>
</div>

</div>

</body>
</html>