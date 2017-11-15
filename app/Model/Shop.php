<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Shop extends Model
{
    public function product(){
    	
        return $this->belongsToMany("App\Model\Product")->withPivot('price');; 
    }
}
