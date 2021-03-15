<?php

namespace App\Models;

class Product extends AbstractModel
{
    protected $table = 'products';

    protected $fillable = ['name','author', 'image', 'average_price'];

    public function feedbacks()
    {
        $this->hasMany(Feedback::class, 'product_id', 'id');
    }
}