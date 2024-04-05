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

    public function history(Request $request): string
    {
        $distributions = Bookdistribution::all();

        if($request->method === 'POST'){
            $bookId = $request->all()['return_book_id'];
            $book = Bookdistribution::where('id', $bookId)->first();
            if ($book) {
                $book->status = 'return';
                $book->save();
            }

            app()->route->redirect('/history');
        }

        foreach($distributions as $distrib){
            $distrib->id_name = Book::where('id_book', $distrib->id_book)->first()->title_book;
            $distrib->id_reader = Reader::where('id_reader', $distrib->id_reader)->first()->FIO;

            $book = Book::where('id_book',$distrib->id_book)->first();
            $distrib->book_age = date('Y') - $book->publication_year;
        }

        $books = Bookdistribution::where('status', 'issue')->get();
        foreach($books as $book){
            $book->id_name = Book::where('id_book', $book->id_book)->first()->title_book;
            $book->id_reader = Reader::where('id_reader', $book->id_reader)->first()->FIO;

            $book_data = Book::where('id_book', $book->id_book)->first();
            $book->book_age = date('Y') - $book_data->publication_year;
        }

        return new View('site.history', ['distributions' => $distributions, 'books' => $books]);
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
        if($request->method === 'POST'){
            $validator = new Validator($request->all(), [
                'title_book' => ['required'],
                'id_author' => ['required'],
                'id_genre' => ['required'],
                'publication_year' => ['required', 'digits:publication_year'],
                'annotacia' => ['required'],
            ] , [
                'required' => 'Поле :field пусто',
                'digits' => 'В поле :field должно быть от 1200 до 2024'
            ]);

            if ($validator->fails()) {
                return new View('site.add_books',
                    ['message' => json_encode($validator->errors(), JSON_UNESCAPED_UNICODE),
                        'book' => $book, 'author' => $author, 'genre' => $genre
                    ]);
            }

            if(Book::create($request->all())){
                app()->route->redirect('/add_books');
            }
        }
        return new View('site.add_books', ['message' => '', 'book' => $book, 'author' => $author, 'genre' => $genre]);
    }
    public function add_librarian(): string
    {
        return new View('site.add_librarian', ['message' => '']);
    }

    public function addgenre(Request $request): string
    {
        if($request->method === 'POST'){
            $validator = new Validator($request->all(), [
                'name_genre' => ['required', 'unique:genres,name_genre'],
            ] , [
                'unique' => 'Поле :field должно быть уникально',
                'required' => 'Поле :field пусто',
            ]);

            if ($validator->fails()) {
                return new View('site.genre',['message' => json_encode($validator->errors(), JSON_UNESCAPED_UNICODE)]);
            }

            if(Genre::create($request->all())){
                app()->route->redirect('/add_books');
            }

        }
        return new View('site.genre', ['message' => '']);
    }

    public function addauthor(Request $request): string
    {
        if($request->method === 'POST'){
            $validator = new Validator($request->all(), [
                'FIO' => ['required', 'unique:authors,FIO'],
            ] , [
                'unique' => 'Поле :field должно быть уникально',
                'required' => 'Поле :field пусто',
            ]);

            if ($validator->fails()) {
                return new View('site.author',['message' => json_encode($validator->errors(), JSON_UNESCAPED_UNICODE)]);
            }

            if(Author::create($request->all())){
                app()->route->redirect('/add_books');
            }

        }

        return new View('site.author' ,['message' => '']);
    }

    public function distributions(Request $request): string
    {
        $book = Book::all();
        $reader = Reader::all();
        $book_distributions = Bookdistribution::all();
        $message = '';

        if($request->method === 'POST'){
            $validator = new Validator($request->all(), [
                'id_book' => ['required'],
                'id_reader' => ['required'],
                'loan_date' => ['required'],
                'return_date' => ['required'],
            ] , [
                'required' => 'Поле :field пусто',
            ]);

            if ($validator->fails()) {
                return new View('site.distributions', [
                    'book_distributions' => $book_distributions,
                    'book' => $book,
                    'reader' => $reader,
                    'message' => json_encode($validator->errors(), JSON_UNESCAPED_UNICODE)
                ]);
            }

            $distribution = $request->all();
            $loan_date = new \DateTime($distribution['loan_date']);
            $return_date = new \DateTime($distribution['return_date']);
            if ($loan_date > $return_date) {
                return new View('site.distributions', [
                    'message' => $message,
                    'book_distributions' => $book_distributions,
                    'book' => $book,
                    'reader' => $reader
                ]);
            } else {
                if (Bookdistribution::create($request->all())) {
                    $message = 'Книга выдана';
                }
            }
        }

        return new View('site.distributions', [
            'book_distributions' => $book_distributions,
            'book' => $book,
            'reader' => $reader,
            'message' => $message
        ]);
    }
    public function error(): string{
        return new View('site.error', ['message' => 'Ошибка']);
    }

}