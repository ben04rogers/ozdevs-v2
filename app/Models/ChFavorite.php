<?php

namespace App\Models;

use Chatify\Traits\UUID;
use Illuminate\Database\Eloquent\Model;

/**
 * @property User|null $user
 */
class ChFavorite extends Model
{
    use UUID;
}
