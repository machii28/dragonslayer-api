<?php

namespace App\Services\EnemyFactory;

interface Enemy
{
    public function getLife(): int;

    public function getDamage(): int;

    public function getMoves(): array;

    public function getName(): string;

    public function getDescription(): string;

    public function getEnemy();
}