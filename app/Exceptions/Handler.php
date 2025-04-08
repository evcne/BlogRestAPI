<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;
use Exception;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Validation\ValidationException;
class Handler extends ExceptionHandler
{
    /**
     * A list of exception types with their corresponding custom log levels.
     *
     * @var array<class-string<\Throwable>, \Psr\Log\LogLevel::*>
     */
    protected $levels = [
        //
    ];

    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<\Throwable>>
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     */
    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
            // ModelNotFoundException için özel bir hata mesajı döndürüyoruz
            $this->reportable(function (ModelNotFoundException $e) {
                return response()->json(['message' => 'Resource not found'], 404);
            });

            // ValidationException için özel bir hata mesajı döndürüyoruz
            $this->reportable(function (ValidationException $e) {
                return response()->json(['errors' => $e->errors()], 422);
            });

            // NotFoundHttpException için özel bir hata mesajı döndürüyoruz
            $this->reportable(function (NotFoundHttpException $e) {
                return response()->json(['message' => 'Route not found'], 404);
            });

            // MethodNotAllowedHttpException için özel bir hata mesajı döndürüyoruz
            $this->reportable(function (MethodNotAllowedHttpException $e) {
                return response()->json(['message' => 'Method not allowed'], 405);
            });
        });
    }

    
}
