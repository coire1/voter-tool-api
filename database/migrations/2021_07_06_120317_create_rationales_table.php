<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRationalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rationales', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->text('proposals')->nullable();
            $table->text('downProposals')->nullable();
            $table->integer('challenge_id')->nullable();
            $table->text('rationale')->nullable();
            $table->bigInteger('pick_list_id')->unsigned()->nullable();
            $table->foreign('pick_list_id')->references('id')
                ->on('pick_lists');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rationales');
    }
}
