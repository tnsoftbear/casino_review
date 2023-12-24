<?php
namespace App\Domain\Author\Load;

use App\Domain\Author\Model\Author;

final class AuthorLoader
{
    public static function load()
    {
        return array_reduce(config('author.person'), function ($carry, $item) {
            $carry[$item['id']] = new Author(...$item);
            return $carry;
        }, []);
    }
}