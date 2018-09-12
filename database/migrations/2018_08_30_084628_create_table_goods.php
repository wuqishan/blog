<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableGoods extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('goods', function(Blueprint $table)
        {
            $table->increments('id');
            $table->string('title', 255)->default('')->comment('名称');
            $table->text('description')->comment('描述');
            $table->text('images')->comment('图片');
            $table->integer('stock')->default(0)->comment('库存');
            $table->integer('import_number')->default(0)->comment('导入数量');
            $table->integer('export_number')->default(0)->comment('导出数量');
            $table->string('unit', 16)->default('')->comment('单位');
            $table->tinyInteger('status')->default(0)->comment('1：上架；2：下架');
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
