<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFishRecordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fish_records', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id')->index();
            $table->date('fishing_date')->index();
            $table->string('harbor')->index();
            $table->string('ship')->index()->nullable();
            $table->string('fish_name')->index();
            $table->integer('size')->nullable();
            $table->string('other_fish')->nullable();
            $table->string('weather')->nullable();
            $table->integer('temperature')->nullable();
            $table->integer('depth')->nullable();
            $table->string('tool')->nullable();
            $table->string('tackle')->nullable();
            $table->string('fish_image')->nullable();
            $table->string('memo')->nullable();
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
        Schema::dropIfExists('fish_records');
    }
}
