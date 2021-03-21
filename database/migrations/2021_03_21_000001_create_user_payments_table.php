<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserPaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_payments', function (Blueprint $table) {
            $table->id();
            $table->string('komoju_session_id')->nullable();
            $table->string('order_number')->nullable();
            $table->bigInteger('user_id')->default(0);
            $table->string('service_id')->nullable();
            $table->string('service_price')->nullable();
            $table->string('service_points')->nullable();
            $table->text('payment_data')->nullable();
            $table->integer('status')->default(0); // 0:Pending 1:Cancelled 2:Completed
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
        Schema::dropIfExists('user_payments');
    }
}
