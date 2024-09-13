<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'users';

    protected $fillable = [
        'login_social_id',
        'login_social',
        'nome',
        'cpf',
        'email',
        'password',
        'data_nascimento',
        'genero',
        'ativo',
        'role_id',
    ];

    protected $hidden = [
        'remember_token',
    ];

    protected $casts = [
        'email_verificado' => 'bool',
        'created_at' => 'datetime',
        'updated_at' =>'datetime',
    ];

    public function getJWTIdentifier(): int
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims(): array
    {
        return [];
    }

    public function role(): BelongsTo
    {
        return $this->belongsTo(Role::class, 'role_id');
    }

    public function permissions(): BelongsToMany
    {
        return $this->role->permissions();
    }

    public function endereco(): HasMany
    {
        return $this->hasMany(Endereco::class, 'usuario_id', 'id');
    }

    public function telefone(): HasMany
    {
        return $this->hasMany(Telefone::class, 'usuario_id', 'id');
    }
}
