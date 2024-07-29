<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVipTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vip', function (Blueprint $table) {
            $table->id();
            $table->string('title')->default('')->comment('VIP名称');
            $table->tinyInteger('status')->default(1)->comment('状态 1启用 0禁用');
            $table->integer('sort')->default(0)->comment('排序');
            $table->decimal('price', 10, 2)->default(0)->comment('价格');
            $table->decimal('underlined_price', 10, 2)->default(0)->comment('划线价格');
            $table->integer('days')->default(0)->comment('天数');
            $table->text('privilege')->nullable()->comment('特权');
            $table->integer('activity_num')->default(0)->comment('首页活动数量');
            $table->integer('search_num')->default(0)->comment('活动搜索数量');

            $table->timestamps();
        });
        \Illuminate\Support\Facades\DB::statement("ALTER TABLE `vip` comment '用户VIP'"); // 表注释
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vip');
    }
}
