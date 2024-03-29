<?php

namespace App\Http\Controllers\Auth;

use App\Core\Services\AuthService;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class ForgotPasswordController extends Controller
{
    use SendsPasswordResetEmails;

    protected function sendResetLinkResponse(Request $request, $response)
    {
        return Response::json([
            'status' => trans($response)
        ]);
    }

    protected function sendResetLinkFailedResponse(Request $request, $response)
    {
        return Response::json([
            'error' => trans($response)
        ],300);
    }
}
