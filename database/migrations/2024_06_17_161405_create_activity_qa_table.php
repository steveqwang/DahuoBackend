<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateActivityQaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('activity_qa', function (Blueprint $table) {
            $table->id();
            $table->integer('activity_id')->default(0)->comment('活动ID');
            $table->integer('q_user_id')->default(0)->comment('问用户ID');
            $table->string('q_content')->default('')->comment('问内容');
            $table->tinyInteger('status')->default(1)->comment('状态 1未回答 2已回答');
            $table->integer('a_user_id')->default(0)->comment('答用户ID');
            $table->string('a_content')->default('')->comment('答内容');

            $table->timestamps();
        });
        \Illuminate\Support\Facades\DB::statement("ALTER TABLE `activity_qa` comment '活动问答'"); // 表注释
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('activity_qa');
    }
}
