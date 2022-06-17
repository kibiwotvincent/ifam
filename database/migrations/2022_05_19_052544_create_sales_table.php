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
            $table->string('unit_measure');
            $table->string('quality');
            $table->double('expected_amount');
			$table->string('sale_receipt_copy')->nullable();
			$table->date('sale_date');
            $table->double('amount_paid')->nullable();
            $table->string('payment_info')->nullable();
            $table->string('payment_receipt_copy')->nullable();
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
        Schema::dropIfExists('sales');
    }
}
