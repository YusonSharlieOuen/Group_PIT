<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Staff;

class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
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

    /**
     * Relation to staff record (if any).
     */
    public function staff()
    {
        return $this->hasOne(Staff::class, 'user_id', 'id');
    }

    /**
     * Check whether the user has one of the given positions/roles.
     * Accepts a string (comma separated) or array of roles.
     */
    public function hasRole(array|string $roles): bool
    {
        $roles = is_array($roles) ? $roles : array_map('trim', explode(',', $roles));

        $position = $this->staff?->position;

        if (! $position) {
            return false;
        }

        $position = strtolower($position);

        foreach ($roles as $role) {
            if ($position === strtolower(trim($role))) {
                return true;
            }
        }

        return false;
    }
}
