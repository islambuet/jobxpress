<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJobAppliesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('job_applies', function (Blueprint $table) {
            $table->id();
            $table->Integer('job_id');
            $table->string('token',80);
            $table->string('applied',3)->default('No');
            $table->string('name')->nullable();
            $table->string('email')->nullable();
            $table->string('resume',500)->nullable();
            $table->string('phone')->nullable();
            $table->string('employer')->nullable();
            $table->string('source')->nullable();
            $table->text('comments')->nullable();
            $table->timestamp('token_expired_at');
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
        Schema::dropIfExists('job_applies');
    }
}
