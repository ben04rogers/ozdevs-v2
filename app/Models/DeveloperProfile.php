<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Skill;

class DeveloperProfile extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
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
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
