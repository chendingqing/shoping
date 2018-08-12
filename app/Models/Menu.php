<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    public $fillable=['goods_name','rating','shop_id','category_id','goods_price','description','month_sales','rating_count','tips','satisfy_count','satisfy_rate','goods_img','status'];
    public function shop(){
        $this->belongsTo(Shop::class);
    }
       public function menu_category(){
      return  $this->belongsTo(Menu_categories::class,'category_id');
   }



}
