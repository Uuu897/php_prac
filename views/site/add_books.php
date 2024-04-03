<style>
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




<h3><?= $message ?? ''; ?></h3>
<div class="login-form">
    <p class="text-login">Добавить книгу</p>
    <form method="post" enctype="multipart/form-data">
        <input name="csrf_token" type="hidden" value="<?= app()->auth::generateCSRF() ?>"/>
        <input type="text" name="title_book" placeholder="Название">
        <select name="id_author">
            <option value="">Автор</option>
            <?php foreach ($author as $author) { ?>
                <option value="<?php echo $author->id_author; ?>">
                    <?php echo $author->FIO; ?>
                </option>
            <?php } ?>
        </select>
        <select name="id_genre">
            <option value="">Жанр</option>
            <?php foreach ($genre as $genre) { ?>
                <option value="<?php echo $genre->id_genre; ?>">
                    <?php echo $genre->name_genre; ?>
                </option>
            <?php } ?>
        </select>
        <input type="date" name="publication_year">
        <select name="new_edition_or_not">
            <option disabled selected>Новое ли издание</option>
            <option value="1">да</option>
            <option value="0">нет</option>
        </select>
        <input type="text" name="annotacia" placeholder="Краткая аннотация">

        <button class="read-btn" type="submit">Добавить</button>
    </form>
</div>



