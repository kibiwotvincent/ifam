<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sales', function (Blueprint $table) {
            $table->id();
			$table->integer('season_id');
            $table->string('description');
            $table->double('quantity');
            $table->string('unit_measure')->nullable();
            $table->string('quality')->nullable();
            $table->double('expected_amount')->nullable();
			$table->string('sale_receipt_copy')->nullable();
			$table->timestamp('sale_date');
            $table->double('amount_paid')->nullable();
            $table->timestamp('payment_date')->nullable();
            $table->string('payment_info')->nullable();
            $table->string('payment_receipt_copy')->nullable();
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
        Schema::dropIfExists('sales');
    }
}
