<?php
namespace Controller;

use Model\Author;
use Model\Book;
use Model\addreader;
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

    public function search(Request $request): string
    {
        $book = Book::all();
        if ($request->method === 'POST') {
            $temp = $request->all();
            $bookID = $temp['book'];
            $filteredbook = Book::whereRaw("LOWER(title_book) LIKE?", ["%{$bookID}%"])
                ->with('position')
                ->get();

            if (count($filteredbook) === 0) {
                return new View('site.search', ['message' => 'Ничего не найдено.']);
            }

            $book = $filteredbook->first();

            return new View('site.search', ['filteredbook' => $filteredbook,]);
        }

        return new View('site.search', ['book' => $book]);
    }


    public function hello(Request $request): string
    {
        $book = Book::all();
        $reader = Reader::all();
        $book_distributions = Bookdistribution::all();
        $message = '';

        if ($request->method === 'POST') {
            foreach ($book_distributions as $distribution) {
                $loan_date = new \DateTime($distribution->loan_date);
                $return_date = new \DateTime($distribution->return_date);

                if ($loan_date > $return_date) {
                    $message = '!Дата выдачи не может быть позже даты возврата!';
                    return new View('site.book_distribution', [
                        'message' => $message,
                        'book_distributions' => $book_distributions,
                        'book' => $book,
                        'reader' => $reader
                    ]);
                } else {
                    if ($distribution->status === 'return') {
                        $message = 'Книга возвращена';
                    } else {
                        if (BookDistribution::create($request->all())) {
                            $message = 'Книга выдана';
                        }
                    }
                }
            }
        }

        return new View('site.hello', [
            'book_distributions' => $book_distributions,
            'book' => $book,
            'reader' => $reader,
            'message' => $message
        ]);
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

            if ($validator->fails()) {
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
        $reader = addreader::all();
        if ($request->method === 'POST') {

            $validator = new Validator($request->all(), [
                'FIO' => ['required', 'alpha'],
                'email' => ['required'],
            ], [
                'required' => 'Поле :field пусто',
                'alpha' => 'Поле :field не должно содержать цифры',
            ]);

            if ($validator->fails()) {
                return new View('site.add_reader',
                    ['message' => json_encode($validator->errors(), JSON_UNESCAPED_UNICODE),
                        'reader' => $reader
                    ]);
            }
            $reader = Reader::all();
            if ($request->method === 'POST' && Reader::create($request->all())) {
                app()->route->redirect('/add_reader');
            }
        }
        return new View('site.add_reader', ['reader' => $reader,]);

    }
    public function add_books(Request $request): string
    {
        $book = Book::all();
        $author = Author::all();
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