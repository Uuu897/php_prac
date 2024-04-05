<?php
use Src\Route;

Route::add(['GET', 'POST'], '/hello', [Controller\Site::class, 'hello'])
    ->middleware('auth');
Route::add(['GET', 'POST'], '/signup', [Controller\Site::class, 'signup'])
    ->middleware('auth','admin');
Route::add(['GET', 'POST'], '/login', [Controller\Site::class, 'login']);
Route::add(['GET', 'POST'], '/logout', [Controller\Site::class, 'logout']);
Route::add('GET', '/popular', [Controller\Site::class, 'popular'])
    ->middleware('auth', 'librarian');
Route::add(['GET', 'POST'], '/history', [Controller\Site::class, 'history'])
    ->middleware('auth', 'librarian');
Route::add(['GET', 'POST'], '/add_reader', [Controller\Site::class, 'add_reader'])
    ->middleware('auth', 'librarian');
Route::add(['GET', 'POST'], '/add_librarian', [Controller\Site::class, 'add_librarian'])
    ->middleware('auth','admin');
Route::add(['GET', 'POST'], '/add_books/author', [Controller\Site::class, 'addauthor'])
    ->middleware('auth', 'librarian');
Route::add(['GET', 'POST'], '/add_books/genre', [Controller\Site::class, 'addgenre'])
    ->middleware('auth', 'librarian');
Route::add(['GET', 'POST'], '/add_books', [Controller\Site::class, 'add_books'])
    ->middleware('auth', 'librarian');
Route::add(['GET', 'POST'], '/distributions', [Controller\Site::class, 'distributions'])
    ->middleware('auth', 'librarian');
Route::add(['GET', 'POST'], '/error', [Controller\Site::class, 'error']);