<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserTiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_ti', function (Blueprint $table) {
            $table->id();
            $table->Integer('user_id')->default(0)->comment('用户ID');
            $table->decimal('price')->default(0)->comment('金额');
            $table->tinyInteger('status')->default(1)->comment('状态1申请2通过3拒绝');
            $table->string('remark')->default('')->comment('备注');
            $table->string('ti_time')->default('')->comment('提现时间');
            $table->timestamps();
        });
        \Illuminate\Support\Facades\DB::statement("ALTER TABLE `user_ti` comment '提现表'"); // 表注释
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_ti');
    }
}
