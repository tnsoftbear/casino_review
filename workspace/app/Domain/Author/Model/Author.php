<?php
namespace App\Domain\Author\Model;

final class Author {
    public int $id;
    public string $first_name;
    public string $last_name;
    public function __construct(int $id, string $first_name, string $last_name) {
        $this->id = $id;
        $this->first_name = $first_name;
        $this->last_name = $last_name;
    }

    public function __toString(): string {
        return $this->first_name . ' ' . $this->last_name;
    }
}