<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'is_active',
        'is_admin'
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
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'is_admin' => 'boolean',
        'is_active' => 'boolean'
    ];

    public function isOwner(): bool
    {
        return $this->role === 'owner';
    }

    public function roleLabel(): string
    {
        return config("roles.roles.{$this->role}.label", ucfirst((string) $this->role));
    }

    /** Whether this staff member may open the given module (see config/roles.php). */
    public function canAccess(string $module): bool
    {
        if (! $this->is_admin || ! $this->is_active) {
            return false;
        }

        $modules = config("roles.roles.{$this->role}.modules", []);

        return in_array('*', $modules, true) || in_array($module, $modules, true);
    }
}
