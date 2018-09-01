<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableFiles extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('files', function(Blueprint $table)
        {
            $table->increments('id');
            $table->string('filename', 255)->default('')->comment('图片保存名');
            $table->string('origin_name', 128)->default('')->comment('图片原始名称');
            $table->string('filepath', 255)->default('')->comment('图片保存路径');
            $table->integer('object_id')->default(0)->comment('图片所属对象的ID');
            $table->tinyInteger('type')->default(0)->comment('图片所属，0：垃圾数据：1：商品图片');
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
