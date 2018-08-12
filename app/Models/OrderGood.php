<?php
/**
 * Created by PhpStorm.
 * User: ShengSheng
 * Date: 2018/8/8
 * Time: 10:12
 */

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class OrderGood  extends Model
{
    public $fillable=['order_id','goods_id','amount','goods_name','goods_img','goods_price'];
}