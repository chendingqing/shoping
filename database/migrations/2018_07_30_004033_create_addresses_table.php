<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('addresses', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->comment('用户id');
            $table->string('provence')->comment('省');
            $table->string('city')->comment('市');
            $table->string('area')->comment('县');
            $table->string('detail_address')->comment('详细地址');
            $table->string('tel')->comment('收货人电话');
            $table->string('name')->comment('收货人名字');
            $table->integer('is_default')->comment('是否默认地址');
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
        Schema::dropIfExists('addresses');
    }
}
