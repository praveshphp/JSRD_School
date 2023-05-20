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
        Schema::create('reits', function (Blueprint $table) {
            $table->id();
            $table->foreignId('reit_company_id')
                ->constrained()
                ->onDelete('cascade');
            $table->index('reit_company_id');
            $table->text('property')->nullable();
            $table->text('address')->nullable();
            $table->text('address_2')->nullable();
            $table->string('city',200)->nullable();
            $table->string('state',200)->nullable();
            $table->string('zip',50)->nullable();
            $table->string('size',100)->nullable();
            $table->string('market',200)->nullable();
            $table->string('number_of_buildings',100)->nullable();
            $table->string('acquistion_date',50)->nullable();
            $table->string('office_size',100)->nullable();
            $table->string('land_size',100)->nullable();
            $table->string('ownership',100)->nullable();
            $table->string('purchase_price',50)->nullable();
            $table->double('lat')->nullable();
            $table->double('lng')->nullable();
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
        Schema::dropIfExists('reits');
    }
};
