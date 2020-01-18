<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * @param bool $status
     * @param string $message
     * @param array $data
     * 
     * @return array
     */
    protected function setResponse(bool $status, string $message, array $data = []): array
    {
        return [
            'success' => $status,
            'message' => $message,
            'data' => $data
        ];
    }
}
