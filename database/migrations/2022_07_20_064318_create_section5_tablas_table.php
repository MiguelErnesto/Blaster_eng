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
        Schema::create('section5_tablas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('section3_category_id');
            $table->foreign('section3_category_id')->references('id')->on('section3_categories')->onDelete("cascade");
            $table->string('elemento');
            $table->text('descripcion');
            $table->string('u_m');
            $table->string('cantidad');
            $table->string('precio');
            $table->string('importe');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('section5_tablas');
    }
};
