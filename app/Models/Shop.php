<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Shop extends Model
{

  public $fillable=['shop_category_id','shop_name','shop_img','shop_rating','brand','on_time','fengniao','bao','piao','zhun','start_send','send_cost','notice','notice','status'];
  public function shop_category(){
       return $this->belongsTo(ShopCategory::class);

  }

    use Searchable;
    public $asYouType = true;
    /**
     * Get the indexable data array for the model.
     *
     * @return array
     */
    public function toSearchableArray()
    {
        $array = $this->only('id','shop_name');

        // Customize array...

        return $array;
    }


}
