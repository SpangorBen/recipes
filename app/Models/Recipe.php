<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recipe extends Model
{
    use HasFactory;
    protected $table = "recipes";
    protected $fillable = [
        'name',
        'prep_time',
        'ingredients',
        'description',
        'category_id',
        'image'
    ];

    public function category(){
        return $this->belongsTo(Category::class);
    }
}
