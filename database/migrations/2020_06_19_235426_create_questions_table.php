<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('questions', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug');
            $table->text('description');
            $table->enum('status', ['active', 'inactive', 'pending', 'denied', 'in-revision'])->default('active');
            $table->integer('is_answered')->default(0);
            $table->unsignedBigInteger('category_id')->nullable();
            $table->enum('language', ['en', 'bn', 'ar'])->default('en');
           // $table->unsignedBigInteger('assign_to')->nullable();
            $table->string('tag')->nullable();
            $table->string('reference')->nullable();
            $table->tinyInteger('is_selected')->default(0);
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->unsignedBigInteger('deleted_by')->nullable();
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
        Schema::dropIfExists('questions');
    }
}
