<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateBannerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('banner', function (Blueprint $table) {
            $table->bigIncrements('id')->comment('banner图ID');
            $table->string('img',255)->default('')->comment('图片')->nullable();
            $table->integer('sort')->default(0)->comment('排序/倒序');
            $table->tinyInteger('status')->default(1)->comment('状态1正常2下架');
            $table->string('title',255)->default('')->comment('标题');
            $table->timestamps();
            $table->softDeletes();

        });
        DB::statement("ALTER TABLE `banner` comment '轮播图'");//表注释
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('banner');
    }
}
