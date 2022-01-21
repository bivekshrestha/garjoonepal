<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stores', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('country_id')->constrained('countries')->onDelete('cascade');
            $table->string('name', 150)->nullable();
            $table->string('slug', 200)->nullable();
            $table->text('description')->nullable();
            $table->string('address', 200)->nullable();
            $table->string('postal_code', 50)->nullable();
            $table->string('email', 50)->nullable();
            $table->string('number', 50)->nullable();
            $table->string('web_url', 100)->nullable();
            $table->string('image', 200)->nullable();
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
        Schema::dropIfExists('stores');
    }
}
