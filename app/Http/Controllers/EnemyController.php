<?php

namespace App\Http\Controllers;

use App\Models\Enemy;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\Enemy\ActionRequest;

class EnemyController extends Controller
{
    /**
     * @param Enemy $enemy
     * 
     * @return JsonResponse
     */
    public function show(Enemy $enemy): JsonResponse
    {
        $response = $this->setResponse(true, 'Enemy details', $enemy->toArray());

        return response()->json($response, 200);
    }
}
