<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Toplist extends Model
{
    
    protected $fillable = ['country_code', 'brand_ids'];

    protected $casts = [
        'brand_ids' => 'array', 
    ];
    /**
     * Get the brands associated with the toplist.
     */
     public function brands()
    {
        return Brand::whereIn('brand_id', $this->brand_ids)->get();
    }

    
   
}
