<?php

namespace App\Models;

class Feedback extends AbstractModel
{
    protected $table = 'feedbacks';

    protected $fillable = ['author', 'rating', 'comment', 'product_id'];
}