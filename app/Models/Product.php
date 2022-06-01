<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'category_id',
        'amount',
        'price'
    ];

    public $timestamps = true;
    public const UNCATEGORIZED_ID = 5;

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function uncategorize()
    {
        $this->category_id = self::UNCATEGORIZED_ID;
    }
}
