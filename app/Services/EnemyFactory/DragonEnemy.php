<?php

namespace App\Services\EnemyFactory;

use App\Models\Enemy as EnemyModel;
use App\Services\EnemyFactory\Enemy;

class DragonEnemy implements Enemy
{
    protected $life;
    protected $damage;
    protected $moves;
    protected $name;
    protected $description;

    public function __construct()
    {
        $this->life = 100;
        $this->damage = 10;
        $this->moves = '{"moves": ["attack", "blast"]}';
        $this->name = 'Dragon';
        $this->description = 'A Powerful foe';
    }

    public function getLife(): int
    {
        return $this->life;
    }

    public function getDamage(): int
    {
        return $this->damage;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getMoves(): array
    {
        return json_decode($this->moves, true);
    }

    public function getEnemy()
    {
        $enemy = EnemyModel::firstOrCreate(
            ['name' => $this->name],
            [
                'life' => $this->getLife(),
                'damage' => $this->getDamage(),
                'moves' => $this->getMoves(),
                'name' => $this->getName(),
                'description' => $this->getDescription()
            ]
        );

        return $enemy;
    }
}