<div class="container">
    <div class="blocks-flex">

        <div class="left">
            <h2>История выдачи/возврата</h2>

            <?php foreach($distributions as $distrib): ?>
                <div class="left-colm">
                    <p class="left-item">книга <?= $distrib->id_book?> (<?= $distrib->book_age ?> лет)</p>
                    <p class="left-item">читатель <?= $distrib->id_reader?></p>
                    <p class="left-item">выдача <?= $distrib->loan_date?></p>
                    <p class="left-item">возврат <?= $distrib->return_date?></p>
                    <p class="left-item">статус <?= $distrib->status?></p>
                </div>
            <?php endforeach;?>

        </div>
        <div class="left">
            <h2>Книги на руках</h2>

            <?php foreach($books as $book): ?>
                <div class="left-colm">
                    <p class="left-item">книга <?= $book->id_name?> (<?= $book->book_age ?> лет)</p>
                    <p class="left-item">читатель <?= $book->id_reader?></p>
                    <p class="left-item">выдача <?= $book->loan_date?></p>
                    <p class="left-item">возврат <?= $book->return_date?></p>
                    <p class="left-item">статус <?= $book->status?></p>
                    <form method="post">
                        <input name="csrf_token" type="hidden" value="<?= app()->auth::generateCSRF() ?>"/>
                        <input type="hidden" name="return_book_id" value="<?= $book->id ?>">
                        <button>Вернуть</button>
                    </form>
                </div>
            <?php endforeach;?>

        </div>

    </div>
</div>


<style>
    .left-colm{
        width: 50%;
        text-align: center;
        background: #e8e8e8;
    }
    .left{
        width: 644px;
        padding: 50px 0;
        background-color: #8B8B8B;
        margin: 100px auto;
        border: none;
        font-family: "Arial";
        font-size: 16px;
        font-weight: bold;
        display: flex;
        flex-direction:column;
        gap:15px;
        align-items: center;

    }

    .right{
        width: 644px;
        height: 745px;
        background-color: #8B8B8B;
        border: none;
        margin: 100px auto;
        font-family: "Arial";
        font-size: 16px;
        font-weight: bold;

    }

    .blocks-flex{
        display: flex;
        justify-content: space-around;
        list-style-type: none;
    }
</style>



