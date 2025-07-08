<?php

namespace App\Models;

use Laravel\Cashier\Billable;
use App\Models\DeveloperProfile;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * @property-read DeveloperProfile|null $developerProfile
 * @property-read CompanyProfile|null $companyProfile
 */
class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use Notifiable;
    use Billable;

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
