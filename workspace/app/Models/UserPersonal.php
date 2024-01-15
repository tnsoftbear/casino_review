<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class UserPersonal extends Model
{
    use HasFactory;

    const FILLABLE = ['first_name', 'last_name', 'user_id'];

    protected $table = 'user_personal';

    protected $fillable = self::FILLABLE;

    // public static function create(array $attributes = [], array $options = []) {

    //     return parent::create(self::filterInputs($attributes), $options);
    // }

    // public function update(array $attributes = [], array $options = []) {

    //     parent::update(self::filterInputs($attributes), $options);
    // }

    public function getFillable(): array {
        return $this->fillable;
    }

    public static function filterInputs(array $inputs)
    {
        return array_intersect_key($inputs, array_flip(self::FILLABLE));
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function name(): string
    {
        $name = trim($this->first_name . ' ' . $this->last_name);
        if (empty($name)) {
            $name = $this->user->email;
        }
        return $name;
    }
}
