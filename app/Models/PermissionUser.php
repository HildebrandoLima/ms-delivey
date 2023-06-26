<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PermissionUser extends Model
{
    use HasFactory;

    protected $table = 'permission_user';

    protected $fillable = [
        'user_id',
        'permission_id',
    ];
}
