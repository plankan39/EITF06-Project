<?php

namespace App\Model;

class Item {
    private int $id;
    private string $name;
    private string $description;

    public const TABLE = 'item';

    public function getId(): int {
        return $this->id;
    }

    public function getName(): string {
        return $this->name;
    }

    public function getDescription(): string {
        return $this->description;
    }

}
