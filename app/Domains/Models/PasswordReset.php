<?php

namespace App\Domains\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PasswordReset extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'password_resets';

    protected $fillable = [
        'email',
        'token',
        'codigo',
    ];
}
