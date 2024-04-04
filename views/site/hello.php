<div class="login-form">
    <p class="text-login">Поиск книги</p>
    <form method="post">
        <input name="csrf_token" type="hidden" value="<?= app()->auth::generateCSRF() ?>"/>
        <input type="text" name="title_book" placeholder="Название">

        <button>Искать</button>
    </form>
</div>

<div class="list">
    <?php foreach($books as $book):?>
        <div class="list-colm">
        
            <p class="list-item">автор <?= $book->id_author ?></p>
            <p class="list-item">дата <?= $book->publication_year ?></p>
            <p class="list-item">название<?= $book->title_book ?></p>
            <p class="list-item">да <?= $book->annotacia ?></p>
            <p class="list-item">новый <?= $book->new_edition_or_not ?></p>
            <p class="list-item">жанр <?= $book->id_genre ?></p>
            
        </div>
    <?php endforeach;?>
</div>

<style>
    .list{
        display: flex;
        align-items: center;
        max-width: 1200px;
        margin: 0 auto;
        justify-content: space-between;
    }
    .list-colm{
        width: 25%;
        text-align: center;
        background: #e8e8e8;
    }
    input, select{
        width: 403px;
        height: 56px;
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
        background-color: #B3B2B2;
        display: flex;
        justify-content: center;
        align-items: center;
        margin: 50px auto;
        gap: 50px;
    }
    form{
        display: flex;
        align-items: center;
        gap: 25px;
    }
    .text-login {
        font-size: 36px;
        font-weight: bold;
        font-family: "Arial";
        font-size: 33px;
        font-weight: bold;
    }
    .search_form{
        width: 250px;
        display: flex;
        justify-content: space-between;
        align-items: center; margin-bottom: 50px;
    }
</style>
