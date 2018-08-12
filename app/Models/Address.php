<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    public $fillable=['user_id','provence','city','area','detail_address','tel','name','is_default'];
}
