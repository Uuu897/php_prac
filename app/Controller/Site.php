<?php

namespace Controller;

use Model\Post;
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

    public function hello(): string
    {
        return new View('site.hello', ['message' => 'hello working']);
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
        return new View('site.popular', ['message' => 'popular working']);
    }

    public function history(): string
    {
        return new View('site.history', ['message' => '']);
    }

    public function add_reader(): string
    {
        return new View('site.add_reader', ['message' => 'Добавить читателя']);
    }

    public function add_books(): string
    {
        return new View('site.add_books', ['message' => 'add_books working']);
    }

    public function add_librarian(): string
    {
        return new View('site.add_librarian', ['message' => 'add_librarian working']);
    }
}