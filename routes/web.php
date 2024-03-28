<?php

use Src\Route;

Route::add('GET', '/hello', [Controller\Site::class, 'hello'])
    ->middleware('auth');
Route::add(['GET', 'POST'], '/signup', [Controller\Site::class, 'signup']);
Route::add(['GET', 'POST'], '/login', [Controller\Site::class, 'login']);
Route::add('GET', '/logout', [Controller\Site::class, 'logout']);
Route::add('GET', '/popular', [Controller\Site::class, 'popular']);
Route::add('GET', '/history', [Controller\Site::class, 'history']);
Route::add('GET', '/add_reader', [Controller\Site::class, 'add_reader']);
Route::add('GET', '/add_books', [Controller\Site::class, 'add_books']);
Route::add('GET', '/add_librarian', [Controller\Site::class, 'add_librarian']);