<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSeasonsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('seasons', function (Blueprint $table) {
            $table->id();
            $table->integer('farm_department_id');
            $table->string('name');
			$table->string('description')->nullable();
			$table->date('start_date');
			$table->date('end_date')->nullable();
			$table->integer('child_category_id')->nullable();
			$table->integer('child_sub_category_id')->nullable();
			$table->text('metadata')->nullable();
			$table->string('status');
			$table->softDeletes();
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
        Schema::dropIfExists('seasons');
    }
}
