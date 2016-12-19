<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBandTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /**
         * Table Columns
         */
        Schema::create('band', function (Blueprint $table) {
            $table->increments('id');
            
            /**
             * Name is the only field required
             */
            $table->string('name');
            $table->date('start_date')->nullable();
            
            /**
             * This is likely a domain URL and the lowest common denominator among URLS is 2083.
             * I believe we are safe with this size in this case. In another case it's better
             * to use TEXT for URLs
             */
            $table->string('website', 2083)->nullable(); 
            
            $table->boolean('still_active')->default(0);            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('band');
    }
}
