<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('nickname')->default('')->comment('昵称');
            $table->string('avatar')->default('')->comment('头像');
            $table->string('phone')->default('')->comment('手机号');
            $table->tinyInteger('sex')->default(0)->comment('性别 0未知 1男 2女');
            $table->date('birthday')->nullable()->comment('生日');
            $table->string('school')->default('')->comment('学校');
            $table->string('occupation')->default('')->comment('职业');
            $table->string('real_name')->default('')->comment('真实姓名');
            $table->string('id_card')->default('')->comment('身份证号');
            $table->tinyInteger('is_real_name')->default(0)->comment('是否实名认证 0未认证 1已认证');
            $table->integer('fans_count')->default(0)->comment('粉丝数');
            $table->integer('follow_count')->default(0)->comment('关注数');
            $table->string('openid')->default('')->comment('微信openid');
            $table->string('session_key')->default('')->comment('微信session_key');
            $table->string('api_token')->default('')->comment('api_token');
            $table->tinyInteger('status')->default(1)->comment('状态 1正常 0禁用');
            $table->string('my_invite_code')->default('')->comment('我的邀请码');
            $table->string('invite_code')->default('')->comment('邀请码');
            $table->integer('invite_user_id')->default(0)->comment('邀请人ID');
            $table->integer('invite_count')->default(0)->comment('邀请人数');
            $table->decimal('price', 10, 2)->default(0)->comment('余额');
            $table->tinyInteger('is_vip')->default(0)->comment('是否VIP 0否 1是');
            $table->date('vip_end_time')->nullable()->comment('VIP结束时间');
            $table->string('province_id')->default('')->comment('省');
            $table->string('city_id')->default('')->comment('市');
            $table->string('district_id')->default('')->comment('区');
            $table->integer('activity_num')->default(0)->comment('首页活动数量');
            $table->integer('search_num')->default(0)->comment('活动搜索数量');
            $table->timestamps();
        });
        \Illuminate\Support\Facades\DB::statement("ALTER TABLE `users` comment '用户表'"); // 表注释
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
