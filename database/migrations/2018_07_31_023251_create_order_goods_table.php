<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderGoodsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_goods', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('order_id')->coomment('订单id');
            $table->integer('goods_id')->coomment('商品id');
            $table->integer('amount')->coomment('商品数量');
            $table->string('goods_name')->coomment('商品名称');
            $table->string('goods_img')->coomment('商品图片');
            $table->string('goods_price')->coomment('商品价格');
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
        Schema::dropIfExists('order_goods');
    }
}
