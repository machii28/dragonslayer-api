<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\Action;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\Action\AddRequest;

class ActionController extends Controller
{
    /**
     * @param AddRequest $request
     * 
     * @return JsonResponse
     */
    public function store(AddRequest $request): JsonResponse
    {
        $action = new Action();
        $action->actions = $request->actions;
        $action->game()->associate(Game::find($request->game_id));
        $action->save();
        $response = $this->setResponse(true, 'Actions created', $action->toArray());

        return response()->json($response, 200);
    }
}
