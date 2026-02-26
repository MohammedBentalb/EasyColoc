<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Relations\Pivot;

class Membership extends Pivot {
    use HasUuids;

    protected $table = 'memberships';
    protected $fillable = ['user_id', 'colocation_id', 'role', 'status'];

    public function joinedIn(){
        return $this->created_at->format('m/ y');
    }
}
