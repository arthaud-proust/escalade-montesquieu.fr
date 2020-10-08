<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;
use App\Exceptions\CustomException;
use Response;
use App\Blog;
use App\Forum;
use App\User;
use Session;


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
        'password-confirmation',
    ];

    /**
     * Report or log an exception.
     *
     * @param  \Throwable  $exception
     * @return void
     *
     * @throws \Exception
     */
    public function report(Throwable $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Throwable  $exception
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @throws \Throwable
     */
    public function render($request, Throwable $exception)
    {
        // return parent::render($request, $exception);
        if ($this->isHttpException($exception)) {
            Session::flash('forum_list', Forum::all());
            Session::flash('blog_list', Blog::all());
            switch ($exception->getStatusCode()) {
    
                // not authorized
                case '401':
                    return Response::view('errors.403',array(),403);
                    break;
    
                // not authorized
                case '403':
                    return Response::view('errors.403',array(),403);
                    break;
    
                // not found
                case '404':
                    return Response::view('errors.404',array(),404);
                    break;
                // not found
                case '429':
                    return Response::view('errors.404',array(),404);
                    break;

                // internal error
                case '500':
                    return Response::view('errors.500',array(),500);
                    break;
    
                default:
                    return $this->renderHttpException($exception);
                    break;
            }
        } else {
            return parent::render($request, $exception);
        }
    }


    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {
        $this->renderable(function (CustomException $e, $request) {
            return abot(404);
        });
    }
}
