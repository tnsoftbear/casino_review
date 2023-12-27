<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Article extends Model
{
    use HasFactory;

    protected $table = 'article';
    protected $guarded = ['id', 'created_at', 'updated_at', 'deleted_at'];

    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    protected static function booted(): void
    {
        static::saving(function (Article $article) {
            if ($article->publish_at === "") {
                $article->publish_at = null;
            }
            if (empty($article->rubric_id)) {
                $article->rubric_id = 0;
            }
        });
    }
}
