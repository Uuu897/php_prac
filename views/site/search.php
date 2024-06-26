<div class="login-form">
    <p class="text-login">Поиск книги</p>
    <form method="post">
        <input name="csrf_token" type="hidden" value="<?= app()->auth::generateCSRF() ?>"/>
        <input type="text" name="title_book" placeholder="Название">

        <button>Искать</button>
    </form>
</div>
<div>
    <h2>Результат:</h2>
    <ul>
        <?php if (isset($message)):?>
            <li><p><?= $message?></p></li>
        <?php else:?>
        <?php if (empty($filteredbook)):?>
            <li><p>Ничего не найдено.</p></li>
        <?php else:?>
            <?php foreach ($filteredbook as $book):?>
                <li>
                    <p>Автор: <?= $book->id_author?></p>
                    <p>Номер книги: <?= $book->d_book?></p>
                    <p>Название: <?= $book->title_book?></p>
                    <p>Год выдачи: <?= $book->publication_year?></p>
                </li>
            <?php endforeach;?>
        <?php endif;?>
    </ul>
    <?php endif;?>
</div>



<style>
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