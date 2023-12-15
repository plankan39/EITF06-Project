<?php

namespace App\Model;

class Item
{
    private int $id;
    private string $name;
    private string $description;
    private float $price;

    public const TABLE = 'item';

    public function getId(): int
    {
        return $this->id;
    }

    public function getPrice(): float
    {
        return $this->price;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

}
