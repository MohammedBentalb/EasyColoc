<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Colocation extends Model {
    /** @use HasFactory<\Database\Factories\ColocationFactory> */
    use HasFactory, HasUuids;

    protected $fillable = ['name', 'address', 'city'];

    public function users(){
        return $this->belongsToMany(User::class, 'memberships', 'colocation_id', 'user_id')->using(Membership::class)->withPivot('role', 'status')->withTimestamps();
    }   

    public function categories(){
        return $this->hasMany(Category::class, 'colocation_id');
    }

    public function depenses(){
        return $this->hasManyThrough(Depense::class, Category::class, 'colocation_id', 'category_id', 'id', 'id');
    }
}
