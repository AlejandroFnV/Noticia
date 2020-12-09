<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateComentariosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comentario', function (Blueprint $table) {
            $table->id(); //bigInteger autonumeric unsigned
            
            $table->bigInteger('idnoticia')->unsigned();
            $table->text('textoComentario');
            $table->date('fecha');
            $table->string('correo', 50);
            
            $table->timestamps();
            
            $table-> foreign ('idnoticia')-> references ('id')-> on ('noticia');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('comentario');
    }
}
