<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $user_id
 * @property string|null $company_name
 * @property string|null $website
 * @property string|null $staff_name
 * @property string|null $staff_role
 * @property string|null $bio
 * @property bool|null $email_notifications
 * @property string|null $image
 */
class CompanyProfile extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'company_name',
        'website',
        'staff_name',
        'staff_role',
        'bio',
        'email_notifications',
        'image',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
