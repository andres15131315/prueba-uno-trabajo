<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
  public function up()
{
    Schema::create('solicitudes', function (Blueprint $table) {
        $table->id();
        $table->date('fecha')->nullable();
        $table->string('numero_radicado')->nullable();
        $table->text('objeto_solicitud')->nullable();
        $table->string('remitente')->nullable();
        $table->string('cargo')->nullable();
        $table->string('empresa')->nullable();
        $table->string('correo')->nullable();
        $table->string('contacto')->nullable();
        $table->string('municipio')->nullable();
        $table->string('radicado_respuesta')->nullable();
        $table->date('fecha_radicacion_respuesta')->nullable();
        $table->text('sintesis_respuesta')->nullable();
        $table->text('observaciones')->nullable();
        $table->string('agenda_reuniones')->nullable();
        $table->text('compromiso')->nullable();
        $table->date('fecha_vencimiento')->nullable();
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('solicituds');
    }
};
