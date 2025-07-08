<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
        'image'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
