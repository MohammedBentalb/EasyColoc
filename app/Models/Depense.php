<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Depense extends Model {
    /** @use HasFactory<\Database\Factories\DepenseFactory> */
    use HasFactory, HasUuids;
    protected $fillable = ['user_id', 'amount', 'title', 'category_id', 'status'];

    public function category(){
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function Settlements(){
        return $this->hasMany(Settlement::class);
    }
}
