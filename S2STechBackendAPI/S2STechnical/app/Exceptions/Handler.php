<?php

namespace App\Exceptions;

use Illuminate\Http\Response;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;

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
     * @param  \Throwable  $exception
     * @return void
     *
     * @throws \Throwable
     */
    public function report(Throwable $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * Modified to return JSON resoponse and custom 'details' if provided.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Throwable  $exception
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @throws \Throwable
     */
    public function render($request, Throwable $exception)
    {
        // Set defaults
        $response = [
          'status' => 500,
          'message' => "Whoops! Something went wrong."
        ];

        // Set HTTP code
        if ($this->isHttpException($exception) && $this->validStatus($exception->getStatusCode())) {
            $response['status'] = $exception->getStatusCode();
        } else if ($exception->getCode() !== 0 && $this->validStatus($exception->getCode())) {
            $response['status'] = $exception->getCode();
        }

        // Decide the level of detail to show
        if (config('app.debug')) {
            $response['error'] = get_class($exception);
            $response['message'] = $exception->getMessage(). " : " . $exception->getFile() . " (" . $exception->getLine() . ")";
        } else if ($response['status'] !== 500){
            $response['error'] = get_class($exception);
            $response['message'] = $exception->getMessage();
        }

        // Get details if a custom exception
        if (method_exists($exception, 'getDetails')) {
            $response['details'] = $exception->getDetails();
        }

        return response()->json($response, $response['status']);
    }


    function validStatus($code)
    {
        return in_array($code, array_keys(Response::$statusTexts));
    }
}
