<?php

namespace App\Http\Controllers;

use App\Models\Game;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\Game\AddRequest;
use App\Services\EnemyFactory\EnemyFactory;

class GameController extends Controller
{
    /**
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $games = Game::with(['user', 'enemy'])->whereUserId(auth()->user()->id)->get()->toArray();
        $response = $this->setResponse(true, 'User games', $games);

        return response()->json($response);
    }

    /**
     * @param Game $game
     * 
     * @return JsonResponse
     */
    public function show(Game $game): JsonResponse
    {
        $game = Game::with(['actions', 'user', 'enemy'])->find($game->id);
        $response = $this->setResponse(true, 'Game Info', $game->toArray());

        return response()->json($response);
    }

    /**
     * @param AddRequest $request
     * 
     * @return JsonResponse
     */
    public function store(AddRequest $request): JsonResponse
    {
        $enemy = EnemyFactory::makeEnemy();
        $user = auth()->user();
        $game = new Game();
        $game->name = rand(100000, 999999);
        $game->user()->associate($user);
        $game->enemy()->associate($enemy->getEnemy());
        $game->save();

        $response = $this->setResponse(true, 'Game created', $game->toArray());
        
        return response()->json($response);
    }

    /**
     * @param Game $game
     * @param Request $request
     * 
     * @return JsonResponse
     */
    public function update(Game $game, Request $request): JsonResponse
    {
        $game->result = $request->result;
        $game->save();

        $response = $this->setResponse(true, 'Game Updated', $game->toArray());

        return response()->json($response);
    }
}
