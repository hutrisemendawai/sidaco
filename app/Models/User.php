<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'first_name',
        'middle_name',
        'last_name',
        'birth_date',
        'email',
        'role',
        'password',
        'address',
        'phone_number',
        'country',
        'province',
        'district',
        'sub_district',
        'profile_photo_path',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
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
            'birth_date' => 'date',
        ];
    }

    /**
     * Get the sidat data for the user.
     */
    public function sidatData()
    {
        return $this->hasMany(SidatData::class);
    }

    /**
     * Check if the user has the 'admin' role.
     */
    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    /**
     * Check if the user has the 'enum' role.
     */
    public function isEnum(): bool
    {
        return $this->role === 'enum';
    }

    /**
     * Generate the URL for the user's avatar.
     */
    public function avatarUrl(): string
    {
        if ($this->profile_photo_path) {
            return asset('storage/' . $this->profile_photo_path);
        }

        $name = urlencode($this->first_name . ' ' . $this->last_name);
        $background = '0ea5e9'; // Sky blue color
        $color = 'ffffff'; // White text

        return "https://ui-avatars.com/api/?name={$name}&background={$background}&color={$color}";
    }
}
