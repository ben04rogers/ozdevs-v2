<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Cashier\Billable;
use Laravel\Sanctum\HasApiTokens;

/**
 * @property-read DeveloperProfile|null $developerProfile
 * @property-read CompanyProfile|null $companyProfile
 */
class User extends Authenticatable
{
    use Billable;
    use HasApiTokens;
    use HasFactory;
    use Notifiable;

    protected $fillable = [
        'email',
        'password',
        'name',
        'user_type',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function developerProfile()
    {
        return $this->hasOne(DeveloperProfile::class);
    }

    public function companyProfile()
    {
        return $this->hasOne(CompanyProfile::class);
    }
}
