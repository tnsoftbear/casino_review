<?php

namespace App\Domain\Author\Model;

final class Author
{
    public function __construct(
        public int $id,
        public string $first_name,
        public string $last_name,
        public string $email
    ) {
    }

    public function __toString(): string
    {
        $name = trim($this->first_name . ' ' . $this->last_name);
        return empty($name) ? $this->email : $name . ' (' . $this->email . ')';
    }
}
