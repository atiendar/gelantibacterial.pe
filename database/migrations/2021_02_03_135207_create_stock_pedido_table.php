<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStockPedidoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stock_pedido', function (Blueprint $table) {
            $table->engine ='InnoDB';
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_unicode_ci';
            $table->bigIncrements('id');


            $table->string('serie',20)->comment('Serie');
            $table->string('num_pedido',45)->unique()->comment('Número de pedido');
            $table->string('estat',100)->default(config('app.pendiente'))->comment('Estatus logística');
            $table->timestamp('fech_estat')->nullable()->comment('Fecha estatus logística');
            $table->unsignedBigInteger('id_armado');
            $table->integer('cant')->unsigned()->default(1)->comment('Cantidad');
            $table->text('coment')->nullable()->comment('Comentarios');


            
            $table->string('created_at_reg',75)->nullable()->comment('Correo del usuario que realizo el registro');
            $table->string('updated_at_reg',75)->nullable()->comment('Correo del usuario que realizo la última modificación');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('stock_pedido');
    }
}
