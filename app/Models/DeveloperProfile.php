<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $user_id
 * @property string|null $name
 * @property string|null $hero
 * @property string|null $city
 * @property string|null $state
 * @property string|null $country
 * @property string|null $bio
 * @property string|null $search_status
 * @property string|null $role_type
 * @property string|null $role_level
 * @property bool|null $part_time
 * @property bool|null $full_time
 * @property bool|null $contract
 * @property string|null $website
 * @property string|null $github
 * @property string|null $twitter
 * @property string|null $stack_overflow
 * @property string|null $linkedin
 * @property bool|null $email_notifications
 * @property string|null $image
 */
class DeveloperProfile extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'hero',
        'city',
        'state',
        'country',
        'bio',
        'search_status',
        'role_type',
        'role_level',
        'part_time',
        'full_time',
        'contract',
        'website',
        'github',
        'twitter',
        'stack_overflow',
        'linkedin',
        'email_notifications',
        'image',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
