<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Chatify\Traits\UUID;

/**
 * @property-read \App\Models\User|null $user
 */
class ChFavorite extends Model
{
    use UUID;
}
