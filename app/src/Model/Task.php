<?php

namespace App\Model;

class Task {
    private int $id;
    private string $title;
    private string $description;
    private bool $completed;

    public const TABLE = 'taskitem';

    public function getId(): int {
        return $this->id;
    }

    public function getTitle(): string {
        return $this->title;
    }

    public function getDescription(): string {
        return $this->description;
    }

    public function getCompleted(): bool {
        return $this->completed;
    }

    public function toggleComplete(): bool {
        $this->completed = !$this->completed;
        return $this->completed;
    }
}
