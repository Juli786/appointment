<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAppointmentsTable extends Migration
{
    public function up()
    {
        Schema::create('appointments', function (Blueprint $table) {
            $table->increments('id');

            $table->string('name');
          
            $table->string('slot')->default(null);

            $table->string('duration');

            $table->string('duration_type')->comment('hrs , min');

            $table->string('available_hr');
            
            $table->integer('service')->comment('1: Zoom , 2 : phone call , 3 : In person');

            $table->longText('comments')->nullable();

            $table->timestamps();

            $table->softDeletes();
        });
    }
}
