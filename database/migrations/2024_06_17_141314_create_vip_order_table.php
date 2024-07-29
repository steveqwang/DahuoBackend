<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVipOrderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vip_order', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->default(0)->comment('用户ID');
            $table->string('order_no')->default('')->comment('订单号');
            $table->decimal('price')->default(0)->comment('金额');
            $table->tinyInteger('status')->default(1)->comment('状态1未支付2已支付');
            $table->string('pay_time')->default('')->comment('支付时间');
            $table->string('pay_price')->default('')->comment('支付金额');
            $table->integer('vip_id')->default(0)->comment('VIP ID');
            $table->string('vip_title')->default('')->comment('VIP名称');
            $table->integer('days')->default(0)->comment('天数');
            $table->string('privilege')->nullable()->comment('特权');
            $table->integer('activity_num')->default(0)->comment('首页活动数量');
            $table->integer('search_num')->default(0)->comment('活动搜索数量');

            $table->timestamps();
        });
        \Illuminate\Support\Facades\DB::statement("ALTER TABLE `vip_order` comment 'VIP订单'"); // 表注释
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vip_order');
    }
}
