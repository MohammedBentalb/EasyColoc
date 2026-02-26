<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class Settlement extends Model {
    use HasUuids;

    protected $fillable = ['amount', 'depense_id', 'user_id'];

    public function depense(){
        return $this->belongsTo(Depense::class);
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
}
