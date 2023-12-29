<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class UserPersonal extends Model
{
    use HasFactory;

    protected $table = 'user_personal';

    protected $fillable = ['first_name', 'last_name', 'user_id'];

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
