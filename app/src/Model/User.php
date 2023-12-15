<?php

namespace App\Model;

class User
{
    private int $id;
    private string $email;
    private string $password_hash;
    private string $post_address;

    public const TABLE = 'user';

    public function getId(): int
    {
        return $this->id;
    }

    public function getPostAddress(): string
    {
        return $this->post_address;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getPasswordHash(): string
    {
        return $this->password_hash;
    }

}
