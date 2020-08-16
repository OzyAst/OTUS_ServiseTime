<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProcedureTimesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('procedure_times', function (Blueprint $table) {
            $table->id();
            $table->unsignedbigInteger('business_id');
            $table->unsignedbigInteger('procedure_id')->nullable()
                ->comment('id процедуры');
            $table->time('start')
                ->comment('Начало интервала');
            $table->time('end')
                ->comment('Конец интервала');
            $table->tinyInteger('day')
                ->comment('Номер дня недели');
            $table->boolean("day_off")->default(0)
                ->comment('Выходной');
        });

        Schema::table('procedure_times', function (Blueprint $table) {
            $table->index('procedure_id');
            $table->foreign('procedure_id')
                ->references('id')
                ->on('procedures')
                ->onDelete('cascade');

            $table->index('business_id');
            $table->foreign('business_id')
                ->references('id')
                ->on('businesses')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('procedure_times');
    }
}
