<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('time_entries', function (Blueprint $table) {
            $table->id();
            $table->datetime('time_start');
            $table->datetime('time_end')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
};
