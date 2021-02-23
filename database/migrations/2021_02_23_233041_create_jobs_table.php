<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJobsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jobs', function (Blueprint $table) {
            $table->id();
            $table->smallInteger('job_category_id');
            $table->smallInteger('job_type_id');
            $table->string('email');
            $table->string('company');
            $table->string('logo_url',500)->nullable();
            $table->string('position');
            $table->string('location');
            $table->text('description');
            $table->string('status',10)->default('Active');   
            $table->string('token',80)->unique();         
            $table->timestamps();
            $table->timestamp('expired_at')->nullable();
            $table->smallInteger('renew_count')->default(0);
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('jobs');
    }
}
