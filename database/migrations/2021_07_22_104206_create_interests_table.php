<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInterestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('interests', function (Blueprint $table) {
            $table->id();
            $table->string('interest_id')->unique();
            $table->bigInteger('user_id');
            $table->string('society_id');
            $table->date('date');
            $table->float('interest_amount');
            $table->float('previous_interest');
            $table->float('lif_amount');
            $table->float('total_interest');
            $table->longText('remark')->nullable();
            $table->string('status');
            $table->unsignedBigInteger('admin_id');
            $table->foreign('admin_id')->references('id')->on('users');
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
        Schema::dropIfExists('interests');
    }
}