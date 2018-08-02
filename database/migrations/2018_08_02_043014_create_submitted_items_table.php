<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSubmittedItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('submitted_items', function (Blueprint $table) {
            $table->increments('id');
            $table->enum('buyorsell', ['buy', 'sell']);
            $table->enum('trade_hub', ['amarr', 'rens', 'hek', 'jita', 'dodixie']);
            $table->mediumText('raw_list')->nullable();
            $table->integer('character_id');
            $table->string('evep_id')->nullable();
            $table->integer('percent_range')->default(100);
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
        Schema::dropIfExists('submitted_items');
    }
}
