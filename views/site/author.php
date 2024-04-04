<div class="row">
    <a href="<?= app()->route->getUrl('/add_books/author') ?>">Добавить книгу</a>
    <a href="<?= app()->route->getUrl('/add_books/genre') ?>">Добавить жанр</a>
    <a href="<?= app()->route->getUrl('/add_books') ?>">Добавить книги</a>
    <a href="<?= app()->route->getUrl('/add_reader') ?>">Добавить читателя</a>

</div>
<h2><?= $message ?></h2>
<div class="login-form">
    <p class="text-login">Добавить автора</p>
    <form method="post">
        <input name="csrf_token" type="hidden" value="<?= app()->auth::generateCSRF() ?>"/>
        <input type="text" name="FIO" placeholder="fio">
        <button class="read-btn" type="submit">Добавить</button>
    </form>
</div>

<style>
    .row{
        padding-top: 50px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        max-width: 700px;
        margin: 0 auto;
    }
    .row a:hover{
        opacity: 0.7;
    }
    input, select{
        width: 505px;
        height: 53px;
        background-color: #F1F1F1;
        border-radius: 10px;
        border: none;
        font-family: "Arial";
        font-size: 16px;
        font-weight: bold;
    }
    button {
        padding: 20px 50px;
        border-radius: 10px;
        margin-bottom: 40px;
        background-color: #817F7F;
        border: none;
        font-family: "Arial";
        font-size: 16px;
        font-weight: bold;
    }
    .login-form{
        width: 100%;
        height: 100%;
        max-height: 1317px;
        max-width: 735px;
        background-color: #B3B2B2;
        display: flex;
        flex-direction: column;
        align-items: center;
        margin: 100px auto;
    }
    form{
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 59px;
    }
    .text-login {
        font-size: 36px;
        font-weight: bold;
        font-family: "Arial";
        font-size: 33px;
        font-weight: bold;
    }
</style>