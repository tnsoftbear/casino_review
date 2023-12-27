<?php
namespace App\Domain\Author\Load;

use App\Models\User;
use App\Domain\Author\Model\Author;

final class AuthorLoader
{
    public function load(): array
    {
        $authors = User::join('user_personal', 'users.id', '=', 'user_personal.user_id')
            ->where('users.is_author', true)
            ->whereNull('users.deleted_at')
            ->select('user_personal.first_name', 'user_personal.last_name', 'users.id', 'users.email')
            ->get()
            ->toArray();
        return array_reduce($authors, function ($carry, $item) {
            $carry[$item['id']] = new Author(...$item);
            return $carry;
        }, []);
    }
}