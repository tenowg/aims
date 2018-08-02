<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEveMailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('eve_mails', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('sender_id');
            $table->json('reciever_ids');
            $table->boolean('can_cspa');
            $table->mediumText('body');
            $table->string('subject');
            $table->boolean('sent')->default(false);
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
        Schema::dropIfExists('eve_mails');
    }
}
