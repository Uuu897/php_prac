<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Pop it MVC</title>
    <style>
        body{
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        .head {
            background-color: #817F7F;
            height: 100%;
            max-width: 100%;
        }

        nav {
            display: flex;
            padding: 20px;
            align-items: center;
            justify-content: space-between;
        }
        a{
            text-decoration: none;
            color: black;
            font-family: "Arial";
            font-size: 16px;
            font-weight: bold;
        }
    </style>
</head>
<body>
<header>
    <div class="head">
    <nav>
        <a href="<?= app()->route->getUrl('/hello') ?>">Главная</a>
        <?php
        if (!app()->auth::check()):
            ?>
        <a href="<?= app()->route->getUrl('/login') ?>">Вход</a>
        <?php
        else:
        if (app()->auth::user()->id_role === 1):
            ?>
            <a href="<?= app()->route->getUrl('/signup') ?>">Добавить библиотекаря</a>
            <?php
        elseif (app()->auth::user()->id_role === 2) :
            ?>
            <a href="<?= app()->route->getUrl('/popular') ?>">Популярное</a>
            <a href="<?= app()->route->getUrl('/history') ?>">История книг</a>
            <a href="<?= app()->route->getUrl('/add_reader') ?>">Добавить читателя</a>
            <a href="<?= app()->route->getUrl('/add_books') ?>">Добавить книги</a>
        <?php
        endif;
        ?>
        <a href="<?= app()->route->getUrl('/logout') ?>">Выход (<?= app()->auth::user()->name ?>)</a>
        <?php
        endif;
        ?>
    </nav>
    </div>
</header>
<main>
    <?= $content ?? '' ?>
</main>

</body>
</html>
