<?php

namespace Controller;

use Model\Author;
use Model\Book;
use Model\Bookdistribution;
use Model\Genre;
use Model\Post;
use Model\Reader;
use Src\Request;
use Src\View;
use Model\User;
use Src\Auth\Auth;
use Src\Validator\Validator;

class Site
{
    public function index(): string
    {
        $posts = Post::all();
        return (new View())->render('site.post', ['posts' => $posts]);
    }

    public function hello(Request $request): string
    {
        $book = Book::all();
        $reader = Reader::all();
        $book_distribution = Bookdistribution::all();

        if ($request->method === 'POST') {
            $loan_date = new \DateTime($request->input('loan_date'));
            $return_date = new \DateTime($request->input('return_date'));

            if ($loan_date> $return_date) {
                return new View('site.book_distribution', [
                    'message' => '!Дата выдачи не может быть позже даты возврата!',
                    'book_distribution' => $book_distribution,
                    'book' => $book,
                    'reader' => $reader
                ]);
            } else {
                if (BookDistribution::create($request->all())) {
                    $message = 'Книга выдана!';
                    app()->route->redirect('/book_distribution');
                }
            }
        }

        return new View('site.hello', ['book_distribution' => $book_distribution,
            'book' => $book, 'reader' => $reader]);
    }
    public function signup(Request $request): string
    {
        if ($request->method === 'POST') {

            $validator = new Validator($request->all(), [
                'name' => ['required', 'no_special_chars'],
                'login' => ['required', 'unique:users,login', 'no_special_chars'],
                'password' => ['required', 'no_special_chars']
            ], [
                'required' => 'Поле :field пусто',
                'unique' => 'Поле :field должно быть уникально',
                'no_special_chars' => 'Поле :field не должно содержать спец символов'
            ]);

            if($validator->fails()){
                return new View('site.signup',
                    ['message' => json_encode($validator->errors(), JSON_UNESCAPED_UNICODE)]);
            }

            if (User::create($request->all())) {
                app()->route->redirect('/login');
            }
        }
        return new View('site.signup');
    }

    public function login(Request $request): string
    {
        //Если просто обращение к странице, то отобразить форму
        if ($request->method === 'GET') {
            return new View('site.login');
        }
        //Если удалось аутентифицировать пользователя, то редирект
        if (Auth::attempt($request->all())) {
            app()->route->redirect('/hello');
        }
        //Если аутентификация не удалась, то сообщение об ошибке
        return new View('site.login', ['message' => 'Неправильные логин или пароль']);
    }

    public function logout(): void
    {
        Auth::logout();
        app()->route->redirect('/hello');
    }

    public function popular(): string
    {
        return new View('site.popular', ['message' => '']);
    }

    public function history(): string
    {
        return new View('site.history', ['message' => '']);
    }

    public function add_reader(Request $request): string
    {
        $reader = Reader::all();
        if ($request->method === 'POST' && Reader::create($request->all())) {
            app()->route->redirect('/add_reader');
        }
        return new View('site.add_reader', ['reader' => $reader,]);
    }
    public function add_books(Request $request): string
    {
        $book = Book::all();
        $author =Author::all();
        $genre = Genre::all();
        if ($request->method === 'POST' && Book::create($request->all())) {
            app()->route->redirect('/add_books');
        }
        return new View('site.add_books', ['book' => $book, 'author' => $author, 'genre' => $genre]);
    }

    public function add_librarian(): string
    {
        return new View('site.add_librarian', ['message' => '']);
    }
}