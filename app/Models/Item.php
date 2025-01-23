<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'image_path', 'description', 'price'
    ];

    /**
     * アイテムに関連するカートを取得するリレーション
     */
    public function carts()
    {
        return $this->hasMany(Cart::class);
    }
}
