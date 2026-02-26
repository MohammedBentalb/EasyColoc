<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\ColocationStatus;
use App\UserRole;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, HasUuids;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'username',
        'email',
        'password',
        'image',
        'role_id'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function role(){
        return $this->belongsTo(Role::class);
    }

    public function isAdmin() {
        return $this->role->name === UserRole::Admin->value;
    }

    public function isMember() {
        return $this->role->name === UserRole::Member->value;
    }

    public function colocations(){
        return $this->belongsToMany(Colocation::class, 'memberships', 'user_id', 'colocation_id')->using(Membership::class)->withPivot('role', 'status')->withTimestamps();
    }
    public function settlements(){
        return $this->hasMany(Settlement::class);
    }

    public function getActicveColocation(){
        return $this->colocations()->wherePivot('status', ColocationStatus::active->value);
    }
    public function getInActicveColocations(){
        return $this->colocations()->wherePivot('status', ColocationStatus::inActive->value);
    }
}
