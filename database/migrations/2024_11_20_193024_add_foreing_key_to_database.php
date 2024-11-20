<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Relación en la tabla task con resource
        Schema::table('task', function (Blueprint $table) {
            $table->foreign('resource_id_assigned')->references('id')->on('resource')->onDelete('cascade');
        });

        // Relación en la tabla purchase_order con work_order
        Schema::table('purchase_order', function (Blueprint $table) {
            $table->foreign('work_order_id')->references('id')->on('work_order')->onDelete('cascade');
        });

        // Relación en la tabla task_count con task
        Schema::table('task_count', function (Blueprint $table) {
            $table->foreign('task_id')->references('id')->on('task')->onDelete('cascade');
        });

        // Agregar otras relaciones necesarias...
    }

    public function down()
    {
        // Eliminar claves foráneas si es necesario
        Schema::table('task', function (Blueprint $table) {
            $table->dropForeign(['resource_id_assigned']);
        });

        Schema::table('purchase_order', function (Blueprint $table) {
            $table->dropForeign(['work_order_id']);
        });

        Schema::table('task_count', function (Blueprint $table) {
            $table->dropForeign(['task_id']);
        });

        // Eliminar otras relaciones...
    }
};
