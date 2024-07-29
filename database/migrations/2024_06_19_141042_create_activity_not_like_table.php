<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateActivityNotLikeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('activity_not_like', function (Blueprint $table) {
            $table->id();
            $table->integer('activity_id')->comment('活动id');
            $table->integer('user_id')->comment('用户id');
            $table->string('reason')->comment('不喜欢原因');
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
        Schema::dropIfExists('activity_not_like');
    }
}
