<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateActivityTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('activity', function (Blueprint $table) {
            $table->id();
            $table->string('title')->default('')->comment('活动名称');
            $table->integer('activity_type_id')->default(0)->comment('活动类型ID');
            $table->string('image')->default('')->comment('活动图片');
            $table->integer('user_id')->default(0)->comment('用户ID');
            $table->integer('status')->default(1)->comment('状态 1审核中,2未开始,3进行中,4已结束5审核失败6已取消');
            $table->date('activity_date')->nullable()->comment('活动日期');
            $table->dateTime('start_time')->nullable()->comment('开始时间');
            $table->dateTime('end_time')->nullable()->comment('结束时间');
            $table->dateTime('sign_up_end_time')->nullable()->comment('报名结束时间');
            $table->integer('activity_number')->default(0)->comment('活动人数');
            $table->integer('sign_up_number')->default(0)->comment('报名人数');
            $table->string('address')->default('')->comment('活动地址');
            $table->text('content')->comment('活动内容');
            $table->string('longitude')->default('')->comment('经度');
            $table->string('latitude')->default('')->comment('纬度');
            $table->integer('read_number')->default(0)->comment('阅读数');
            $table->decimal('price', 10, 2)->default(0)->comment('价格');
            $table->tinyInteger('is_open')->default(1)->comment('是否公开 1公开 0不公开');
            $table->tinyInteger('is_prohibit')->default(0)->comment('是否禁止使用模板1是0否');

            $table->timestamps();
        });
        \Illuminate\Support\Facades\DB::statement("ALTER TABLE `activity` comment '活动表'"); // 表注释
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('activity');
    }
}
