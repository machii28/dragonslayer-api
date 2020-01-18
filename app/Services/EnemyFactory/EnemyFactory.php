<?php

namespace App\Services\EnemyFactory;

use App\Models\Enemy as EnemyModel;
use App\Services\EnemyFactory\Enemy;

class EnemyFactory
{
    public static function makeEnemy(): Enemy
    {
        return new DragonEnemy();
    }
}