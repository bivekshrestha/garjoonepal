<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('first_name', 50);
            $table->string('last_name', 50);
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->boolean('is_active')->default(false);
            $table->enum('activated_by', ['na', 'self', 'admin'])->default('na'); // 0 - pending, 1 - self, 2 - admin
            $table->boolean('is_paused')->default(false);
            $table->boolean('has_accepted_policy')->default(false);
            $table->boolean('has_accepted_terms')->default(false);
            $table->boolean('has_logged_in')->default(false);
            $table->boolean('is_verified')->default(false);
            $table->string('company_name', 50)->nullable();
            $table->string('company_number', 50)->nullable();
            $table->string('company_email', 191)->nullable();
            $table->string('company_document', 254)->nullable();
            $table->string('token', 254)->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
