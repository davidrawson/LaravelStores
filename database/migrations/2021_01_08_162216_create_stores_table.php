<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stores', function (Blueprint $table) {
            $table->id();
            $table->string('storeNumber', 255)->nullable();
            $table->string('storeName', 255)->nullable();
            $table->string('address', 512)->nullable();
            $table->string('siteId', 2)->nullable();
            $table->string('lat', 20)->nullable();
            $table->string('lon', 20)->nullable();
            $table->string('phoneNumber', 20)->nullable();
            $table->string('cfsFlag', 5)->nullable();
            $table->string('invalidFields', 255)->nullable();
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
        Schema::dropIfExists('stores');
    }
}
