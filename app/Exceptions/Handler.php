<?php

namespace App\Exceptions;

use App\Core\Helpers\Response;
use Exception;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Support\Str;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Whoops\Exception\ErrorException;

class Handler extends ExceptionHandler
{

    protected function unauthenticated($request, AuthenticationException $exception) {
        return Response::error("",401);
    }

    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    /**
     * Report or log an exception.
     *
     * @param  \Exception  $exception
     * @return void
     */
    public function report(Exception $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $exception
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $exception)
    {
        $message = $exception->getMessage();
        $code = $exception->getCode() ?? 500;
        $code = $code === 0 ? 500 : $code;

        if($exception instanceof ErrorException && Str::length($message))
            Response::error($message, $code);

        if($exception instanceof AuthorizationException && Str::length($message))
            Response::error($message, $code);

        if($exception instanceof ModelNotFoundException)
            Response::error(trans("response.notFoundId"), $code);

        return parent::render($request, $exception);
    }
}
