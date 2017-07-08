<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Illuminate\Auth\Access\AuthorizationException;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that should not be reported.
     *
     * @var array
     */
    protected $dontReport = [
        \Illuminate\Auth\AuthenticationException::class,
        \Illuminate\Auth\Access\AuthorizationException::class,
        \Symfony\Component\HttpKernel\Exception\HttpException::class,
        \Illuminate\Database\Eloquent\ModelNotFoundException::class,
        \Illuminate\Session\TokenMismatchException::class,
        \Illuminate\Validation\ValidationException::class,
    ];

    /**
     * Report or log an exception.
     *
     * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
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
        switch ($exception) {
            case ($exception instanceof ModelNotFoundException):
            case ($exception instanceof NotFoundHttpException):
                return response()->view('admin.3-pages.error-int', [
                    'errorCode' => 404,
                    'errorMessage' => 'Page not found',
                ], 404);
                break;

            case ($exception instanceof HttpException):
                switch ($exception->getStatusCode()) {
                    case 403:
                        return response()->view('admin.3-pages.error-ext', [
                            'errorCode' => 403,
                            'errorMessage' => 'Forbidden: access is denied',
                        ], 403);
                        break;
                    case 500:
                        return response()->view('admin.3-pages.error-int', [
                            'errorCode' => 500,
                            'errorMessage' => 'Internal server error',
                        ], 500);
                        break;
                    default:
                        return parent::render($request, $exception);
                }
                break;

            case ($exception instanceof AuthorizationException):
                return response()->view('admin.3-pages.error-int', [
                    'errorCode' => 403,
                    'errorMessage' => 'You don\'t have privileges to view this page',
                ], 403);
                break;
            default:
                return parent::render($request, $exception);
        }

    }

    /**
     * Convert an authentication exception into an unauthenticated response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Illuminate\Auth\AuthenticationException  $exception
     * @return \Illuminate\Http\Response
     */
    protected function unauthenticated($request, AuthenticationException $exception)
    {
        if ($request->expectsJson()) {
            return response()->json(['error' => 'Unauthenticated.'], 401);
        }

        return redirect()->guest(route('login'));
    }
}
