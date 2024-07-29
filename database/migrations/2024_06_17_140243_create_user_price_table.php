<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserPriceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_price', function (Blueprint $table) {
            $table->id();
            $table->Integer('user_id')->default(0)->comment('用户ID');
            $table->decimal('price')->default(0)->comment('金额');
            $table->tinyInteger('type')->default(1)->comment('类型1收入2支出');
            $table->string('remark')->default('')->comment('备注');
            $table->timestamps();
        });
        \Illuminate\Support\Facades\DB::statement("ALTER TABLE `user_price` comment '收支明细'"); // 表注释
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_price');
    }
}
