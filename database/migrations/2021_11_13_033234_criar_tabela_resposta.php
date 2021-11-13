<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CriarTabelaResposta extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('resposta', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('comentario', '1000');
            $table->boolean('resolvido')->default(false);
            $table->unsignedBigInteger('pergunta_id');
            $table->unsignedBigInteger('usuario_id');
            $table->timestamps();

            $table->foreign('pergunta_id')
                ->references('id')
                ->on('pergunta');
            $table->foreign('usuario_id')
                ->references('id')
                ->on('usuario');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('resposta');
    }
}
