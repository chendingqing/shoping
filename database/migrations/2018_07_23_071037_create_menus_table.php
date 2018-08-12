<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMenusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menus', function (Blueprint $table) {
            $table->increments('id');
            $table->string('goods_name')->coment('菜品名称');
            $table->float('rating')->coment('菜品评分');
            $table->integer('shop_id')->coment('所属商家ID');
            $table->integer('category_id')->coment('所属分类ID');
            $table->decimal('goods_price')->coment('菜品价格');
            $table->string('description')->coment('菜品简介');
            $table->integer('month_sales')->coment('月销量');
            $table->integer('rating_count')->coment('评分量');
            $table->string('tips')->coment('提示信息');
            $table->integer('satisfy_count')->coment('满意度数量');
            $table->float('satisfy_rate')->coment('满意度评分');
            $table->string('goods_img')->coment('菜品图片');
            $table->integer('status')->coment('状态');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('menus');
    }
}
