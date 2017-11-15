<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public function shop(){
        return $this->belongsToMany("App\Model\Shop"); 
    }
}
