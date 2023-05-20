<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('marks', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('roll_no');
            $table->index('roll_no');
            $table->foreign('roll_no')->references('roll_no')->on('students')->onDelete('cascade');
            $table->string('subjects',200)->nullable();
            $table->integer('half_yearly_max_marks')->nullable();
            $table->integer('half_yearly_obtained')->nullable();
            $table->integer('yearly_total_marks')->nullable();
            $table->integer('yearly_obtained_marks')->nullable();
            $table->string('date','100')->nullable();
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
        Schema::dropIfExists('marks');
    }
};
