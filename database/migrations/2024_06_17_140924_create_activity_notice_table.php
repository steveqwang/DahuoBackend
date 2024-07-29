<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateActivityNoticeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('activity_notice', function (Blueprint $table) {
            $table->id();
            $table->integer('activity_id')->default(0)->comment('活动ID');
            $table->string('title')->default('')->comment('通知标题');
            $table->text('content')->comment('通知内容');
            $table->timestamps();
        });
        \Illuminate\Support\Facades\DB::statement("ALTER TABLE `activity_notice` comment '活动开始通知'"); // 表注释
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('activity_notice');
    }
}
