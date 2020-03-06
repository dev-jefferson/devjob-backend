<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;

class Handler extends ExceptionHandler
{
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
     *
     * @throws \Exception
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
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @throws \Exception
     */
    public function render($request, Exception $e)
    {

        if ($e instanceof UnauthorizedHttpException) {
            return response()->json(['error' => $e->getMessage()], $e->getStatusCode());

        } else if ($e instanceof Tymon\JWTAuth\Exceptions\TokenInvalidException) {
            return response()->json(['error' => 'token_invalid'], $e->getStatusCode());

        } else if ($e instanceof Tymon\JWTAuth\Exceptions\TokenBlacklistedException) {
            return response()->json(['error' => 'token_blacklisted'], $e->getStatusCode());

        } else if ($e instanceof Tymon\JWTAuth\Exceptions\TokenExpiredException) {
            return response()->json(['error' => 'token_expired'], $e->getStatusCode());
        }else { //"Illuminate\\Contracts\\Filesystem\\FileNotFoundException"

            if(!empty($e->validator)){
                return parent::render($request, $e);
            }
            if($e instanceof ModelNotFoundException ){

                return parent::render($request, $e);
            }
            return parent::render($request, $e);

            return response()->json($e, 400);


        }

    }
}


// return $request->expectsJson()
//     ? response()->json(['message' => $e->getMessage()], 404)
//     : redirect()->guest(route('api.index'));
// dd($e);
