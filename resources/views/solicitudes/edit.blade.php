<!DOCTYPE html>
<html>
<head>
    <title>Editar Solicitud - SENA</title>

    <style>
        body {
            font-family: Arial;
            background-color: #f4fdf6;
        }

        .container {
            width: 60%;
            margin: 40px auto;
            background: white;
            padding: 25px;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
        }

        h2 {
            color: #00843D;
        }

        input, textarea {
            width: 100%;
            padding: 8px;
            margin-bottom: 15px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }

        button {
            background-color: #39A900;
            color: white;
            padding: 8px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        a {
            text-decoration: none;
            color: #00843D;
            font-weight: bold;
        }
    </style>
</head>
<body>

<div class="container">

<h2>Editar Solicitud</h2>

<form action="{{ route('solicitudes.update', $solicitud->id) }}" method="POST">
@csrf
@method('PUT')

<label>Fecha:</label>
<input type="date" name="fecha" value="{{ $solicitud->fecha }}">

<label>N° Radicado:</label>
<input type="text" name="numero_radicado" value="{{ $solicitud->numero_radicado }}">

<label>Objeto:</label>
<textarea name="objeto_solicitud">{{ $solicitud->objeto_solicitud }}</textarea>

<label>Remitente:</label>
<input type="text" name="remitente" value="{{ $solicitud->remitente }}">

<label>Cargo:</label>
<input type="text" name="cargo" value="{{ $solicitud->cargo }}">

<label>Empresa:</label>
<input type="text" name="empresa" value="{{ $solicitud->empresa }}">

<label>Correo:</label>
<input type="email" name="correo" value="{{ $solicitud->correo }}">

<label>Contacto:</label>
<input type="text" name="contacto" value="{{ $solicitud->contacto }}">

<label>Municipio:</label>
<input type="text" name="municipio" value="{{ $solicitud->municipio }}">

<label>Radicado Respuesta:</label>
<input type="text" name="radicado_respuesta" value="{{ $solicitud->radicado_respuesta }}">

<label>Fecha Radicación Respuesta:</label>
<input type="date" name="fecha_radicacion_respuesta" value="{{ $solicitud->fecha_radicacion_respuesta }}">

<label>Síntesis:</label>
<textarea name="sintesis_respuesta">{{ $solicitud->sintesis_respuesta }}</textarea>

<label>Observaciones:</label>
<textarea name="observaciones">{{ $solicitud->observaciones }}</textarea>

<label>Agenda:</label>
<input type="text" name="agenda_reuniones" value="{{ $solicitud->agenda_reuniones }}">

<label>Compromiso:</label>
<textarea name="compromiso">{{ $solicitud->compromiso }}</textarea>

<label>Fecha Vencimiento:</label>
<input type="date" name="fecha_vencimiento" value="{{ $solicitud->fecha_vencimiento }}">

<button type="submit">Actualizar</button>

</form>

<br>
<a href="{{ route('solicitudes.index') }}">⬅ Volver</a>

</div>

</body>
</html>