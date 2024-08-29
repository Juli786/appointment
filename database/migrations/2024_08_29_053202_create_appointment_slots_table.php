<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('appointment_slots', function (Blueprint $table) {
            $table->increments('id');

            $table->unsignedInteger('appointment_id');
        
            $table->foreign('appointment_id' , "appointment_fk")->references('id')->on('appointments')->onDelete('cascade');

            $table->datetime('start_time');

            $table->tinyInteger('is_book')->default(0);

            $table->timestamps();

            $table->softDeletes();
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('appointment_slots');
    }
};
