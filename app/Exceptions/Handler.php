<?php

namespace App\Exceptions;

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
        
    /**
        $response = [];

        $response['exception'] = get_class($exception);
        $response['status_code'] = $exception->getStatusCode();

        switch($response['status_code'])
        {
            case 403:
                $response['message'] = "No tienes autorización para accesar a esta página";
                break;
            case 404:
                $response['message'] = "Página no encontrada";
                break;
            default:
                $response['message'] = "Algo salió mal. Intente de nuevo más tarde.";
                break;
        }
        return response()->view('Error.error', compact('response'));
        if ($exception instanceof \Spatie\Permission\Exceptions\UnauthorizedException) {
            return response()->json(['El usuario no tiene permiso para acceder a esta página.']);
        }
        **/
        return parent::render($request, $exception); 
    }


}
