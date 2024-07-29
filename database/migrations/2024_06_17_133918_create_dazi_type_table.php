<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDaziTypeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dazi_type', function (Blueprint $table) {
            $table->id();
            $table->string('title')->default('')->comment('搭子类型');
            $table->tinyInteger('status')->default(1)->comment('状态 1启用 0禁用');
            $table->integer('sort')->default(0)->comment('排序');
            $table->timestamps();
        });
        \Illuminate\Support\Facades\DB::statement("ALTER TABLE `dazi_type` comment '搭子类型'"); // 表注释
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('dazi_type');
    }
}
