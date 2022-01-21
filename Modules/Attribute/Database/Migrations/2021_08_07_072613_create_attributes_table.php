<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAttributesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attributes', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100);
            $table->string('slug', 150);
            $table->enum('type', ['text', 'radio', 'checkbox', 'select', 'textarea'])->default('text');
            $table->json('options')->nullable();
            $table->boolean('is_filterable')->default(false);
            $table->enum('category', ['services', 'jobs', 'motor-vehicles', 'real-estate', 'accommodation']);
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
        Schema::dropIfExists('attributes');
    }
}
