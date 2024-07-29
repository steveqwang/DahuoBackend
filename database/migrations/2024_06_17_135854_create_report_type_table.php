<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReportTypeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('report_type', function (Blueprint $table) {
            $table->id();
            $table->string('title')->default('')->comment('举报类型名称');
            $table->tinyInteger('status')->default(1)->comment('状态 1启用 0禁用');
            $table->integer('sort')->default(0)->comment('排序');
            $table->timestamps();
        });
        \Illuminate\Support\Facades\DB::statement("ALTER TABLE `report_type` comment '举报类型'"); // 表注释
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('report_type');
    }
}
