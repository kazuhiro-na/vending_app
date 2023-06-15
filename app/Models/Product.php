<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    public function getProduct($productId)
    {
        return $this->find($productId);
    }

    public function company()
    {
        return $this->belongsTo('App\Models\Company');
    }
}
