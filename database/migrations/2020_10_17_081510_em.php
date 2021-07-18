<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Em extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('email_lists', function (Blueprint $table) {
            $table->text('receiver_email');
            $table->unsignedBigInteger('sender_id');
            $table->text('body');
            $table->text('subject');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('email_lists', function (Blueprint $table) {
            //
        });
    }
}
