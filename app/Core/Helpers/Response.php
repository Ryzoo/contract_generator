<?php
/**
 * Created by PhpStorm.
 * User: ryzoo
 * Date: 11.03.19
 * Time: 16:44
 */

namespace App\Core\Helpers;



use Illuminate\Support\Facades\Request;

class Response
{
    private function __clone(){}
    private function __construct(){}

    public static function json($content, int $code = 200)
    {
        \Response::json($content,$code)->throwResponse();
    }

    public static function error($errorMessage, $code = 404)
    {
        if(Request::is('api/*')){
            Response::json([
                "error" => $errorMessage
            ],$code);
        }else{
            abort($code, $errorMessage);
        }
    }

    public static function success($successMessage = true, $code = 200)
    {
        Response::json($successMessage,$code);
    }

    public static function redirect($route, $status = null, $error = null)
    {
        $redirect = redirect($route);

        if(isset($status))
            $redirect->with('status', $status);

        if(isset($error))
            $redirect->with('error', $error);

        $redirect->throwResponse();
    }
}
