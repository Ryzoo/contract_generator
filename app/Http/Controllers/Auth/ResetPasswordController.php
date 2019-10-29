<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class ResetPasswordController extends Controller
{
    use ResetsPasswords;

    protected function sendResetResponse(Request $request, $response)
    {
        return Response::json([
            'status' => trans($response)
        ]);
    }

    protected function sendResetFailedResponse(Request $request, $response)
    {
        return Response::json([
            'error' => trans($response)
        ],300);
    }
}
