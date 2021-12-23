<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInterestnonpaysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('interestnonpays', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id');
            $table->string('society_id');
            $table->string('interest_non_pay_id')->unique();
            $table->date('date');
            $table->float('interest_non_pay');
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
        Schema::dropIfExists('interestnonpays');
    }
}