<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFarmCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('farm_categories', function (Blueprint $table) {
            $table->id();
			$table->string('name');
			$table->string('description')->nullable();
			$table->integer('category_order')->nullable();
			$table->string('cover_photo')->nullable();
			$table->text('metadata')->nullable();
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
        Schema::dropIfExists('farm_categories');
    }
}
