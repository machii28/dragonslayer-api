<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\Action;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\User\ActionRequest;

class UserController extends Controller
{
    /**
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $user = auth()->user();
        $response = $this->setResponse(true, 'User details', $user->toArray());

        return response()->json($response, 200);
    }
}
