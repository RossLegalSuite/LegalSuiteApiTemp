<?php

namespace App\Exceptions;

use App\ErrorLog;
use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;

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
        'current_password',
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
    private function customErrorLogging($request, $exception)
    {
        try {
            $errorLog = new ErrorLog;

            $errorLog->ip = strval($request->ip());
            $errorLog->application = 'API';
            $errorLog->url = strval($request->fullUrl());
            $errorLog->method = strval($request->method());
            $errorLog->parameters = strval(json_encode($request->all()));
            $errorLog->clientId = isset($request->user()['clientId']) ? strval($request->user()['clientId']) : 0;
            $errorLog->developerId = isset($request->user()['developerId']) ? strval($request->user()['developerId']) : 0;
            $errorLog->message = strval($exception->getMessage());
            $errorLog->file = strval($exception->getFile());
            $errorLog->line = strval($exception->getLine());

            $errorLog->save();
        } catch (\Exception $exception) {
            $errorLog = new ErrorLog;

            $errorLog->ip = 'Server Error';
            $errorLog->application = 'API';
            $errorLog->message = strval($exception->getMessage());
            $errorLog->file = strval($exception->getFile());
            $errorLog->line = strval($exception->getLine());

            $errorLog->save();
        }
    }

    public function render($request, Exception $exception)
    {
        $this->customErrorLogging($request, $exception);

        $returnData = new \stdClass();
        $returnData->data = [];
        $returnData->errors = $exception->getMessage();

        return response(json_encode($returnData));
    }
}
