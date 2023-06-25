<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'login_social_id',
        'login_social',
        'name',
        'cpf',
        'email',
        'password',
        'data_nascimento',
        'genero',
        'ativo',
        'is_admin',
    ];

    protected $hidden = [
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' =>'datetime',
    ];

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }

    public function endereco(): HasMany
    {
        return $this->hasMany(Endereco::class, 'usuario_id', 'id');
    }

    public function telefone(): HasMany
    {
        return $this->hasMany(Telefone::class, 'usuario_id', 'id');
    }

    public function permissions()
    {
        return $this->belongsToMany(Permission::class, 'permission_user');
    }
}
