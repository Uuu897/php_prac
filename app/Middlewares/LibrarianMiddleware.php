<?php

namespace Middlewares;

use Src\Auth\Auth;
use Src\Request;

class LibrarianMiddleware
{
    public function handle(Request $request)
    {
        if (!Auth::checkLibrarian()) {
<<<<<<< HEAD
            app()->route->redirect('/error');
=======
            app()->route->redirect('/hello');
>>>>>>> origin/main
        }
    }
}