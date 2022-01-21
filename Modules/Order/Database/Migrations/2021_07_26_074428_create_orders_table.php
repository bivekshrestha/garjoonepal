<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('reference_number', 200)->unique();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('receiver_name', 200);
            $table->string('receiver_email', 200);
            $table->string('receiver_number', 200);
            $table->string('shipping_address', 200);
            $table->double('discount')->default(0.00);
            $table->double('shipping_charge')->default(0.00);
            $table->double('sub_total');
            $table->double('grand_total');
            $table->enum('status', ['pending', 'approved', 'paid', 'delivered', 'completed', 'cancelled', 'failed'])->default('pending');
            $table->string('remarks', 254)->nullable();
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
        Schema::dropIfExists('orders');
    }
}
