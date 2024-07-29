<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateActivityCommentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('activity_comment', function (Blueprint $table) {
            $table->id();
            $table->integer('activity_id')->default(0)->comment('活动ID');
            $table->integer('user_id')->default(0)->comment('用户ID');
            $table->string('content')->default('')->comment('评论内容');
            $table->tinyInteger('star')->default(0)->comment('星级');
            $table->string('reply_content')->default('')->comment('回复内容');
            $table->timestamps();
        });
        \Illuminate\Support\Facades\DB::statement("ALTER TABLE `activity_comment` comment '活动评论表'"); // 表注释
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('activity_comment');
    }
}
