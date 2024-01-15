<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\Article;
use App\Models\UserPersonal;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    const FILLABLE = ['login', 'email', 'password', 'is_admin', 'is_author'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = self::FILLABLE;

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public static function filterInputs(array $inputs)
    {
        return array_intersect_key($inputs, array_flip(self::FILLABLE));
    }

    public function getFillable(): array {
        return $this->fillable;
    }

    public function articles(): HasMany
    {
        return $this->hasMany(Article::class);
    }

    public function userPersonal()
    {
        return $this->hasOne(UserPersonal::class);
    }

    // public static function create(array $attributes = [], array $options = []): User {
    //     $user = parent::create(self::filterInputs($attributes), $options);
    //     $attributes['user_id'] = $user->id;
    //     //$user->userPersonal->user_id = $user->id;
    //     $user->userPersonal->create($attributes, $options);
    //     return $user;
    // }

    // public function update(array $attributes = [], array $options = []) {
    //     parent::update(self:: filterInputs($attributes), $options);
    //     $this->userPersonal->update($attributes, $options);
    // }
}
