<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class Handler extends ExceptionHandler
{
    public function report(Throwable $e): void
    {
        parent::report($e);
    }

    public function render($request, Throwable $e): Response
    {
        return parent::render($request, $e);
    }
}
