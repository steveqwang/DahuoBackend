<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateActivitySignTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('activity_sign', function (Blueprint $table) {
            $table->id();
            $table->integer('activity_id')->default(0)->comment('活动ID');
            $table->integer('user_id')->default(0)->comment('用户ID');
            $table->string('order_no')->default('')->comment('订单号');
            $table->string('name')->default('')->comment('姓名');
            $table->string('phone')->default('')->comment('手机号');
            $table->string('emergency_contact')->default('')->comment('紧急联系人');
            $table->string('emergency_contact_phone')->default('')->comment('紧急联系人手机号');
            $table->tinyInteger('pay_status')->default(0)->comment('支付状态 0未支付 1已支付2已退款');
            $table->decimal('price', 10, 2)->default(0)->comment('价格');

            $table->string('pay_time')->default('')->comment('支付时间');
            $table->decimal('pay_price')->default(0)->comment('支付金额');
            $table->tinyInteger('status')->default(1)->comment('状态 1正常 2取消');

            $table->timestamps();
        });
        \Illuminate\Support\Facades\DB::statement("ALTER TABLE `activity_sign` comment '报名表'"); // 表注释
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('activity_sign');
    }
}
