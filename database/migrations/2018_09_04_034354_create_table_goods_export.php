<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableGoodsExport extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('goods_export', function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('user_id')->default(0)->comment('操作用户ID');
            $table->integer('goods_id')->default(0)->comment('商品ID');
            $table->integer('number')->default(0)->comment('导入数量');
            $table->text('images')->comment('图片');
            $table->text('description')->comment('简述');
            $table->tinyInteger('deleted')->default(0)->comment('是否删除；1：未删除；2：删除');
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'));
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
