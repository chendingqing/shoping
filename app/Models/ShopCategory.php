<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ShopCategory extends Model
{
  public $fillable=['name','shop_intro','shop_img','status'];
}
