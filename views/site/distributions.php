<h2><?= $message ?></h2>
<div class="login-form">
    <p class="text-login">Выдать книгу</p>
    <form method="post">
        <input name="csrf_token" type="hidden" value="<?= app()->auth::generateCSRF() ?>"/>
        <select name="id_book">
            <option value="">Название книги</option>
            <?php foreach ($book as $book_number) { ?>
                <option value="<?php echo $book_number->id_book; ?>">
                    <?php echo $book_number->title_book; ?>
                </option>
            <?php } ?>
        </select>

        <select name="id_reader">
            <option value="">Имя читателя</option>
            <?php foreach ($reader as $reader_number) { ?>
                <option value="<?php echo $reader_number->id_reader; ?>">
                    <?php echo $reader_number->FIO; ?>
                </option>
            <?php } ?>
        </select>
        <input type="date" name="loan_date">
        <input type="date" name="return_date">
        <button>Выдать</button>
    </form>
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
