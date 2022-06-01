<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = ['name'];
    public $timestamps = true;

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function delete()
    {
        foreach ($this->products as $product) {
            $product->uncategorize();
            $product->save();
        }
        parent::delete();
    }

}
