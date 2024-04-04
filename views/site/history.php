<<<<<<< HEAD
<style>

    .left{
        width: 644px;
        height: 745px;
        background-color: #8B8B8B;
        margin: 100px auto;
        border: none;
        font-family: "Arial";
        font-size: 16px;
        font-weight: bold;
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




<header class="header"></header>

<div class="container">
    <div class="blocks-flex">

        <div class="left">
            <h2>История выдачи/возврата</h2>

            <ul class="">
                <li class="">...</li>
                <li class="">...</li>
                <li class="">...</li>
                <li class="">...</li>
                <li class="">Подробнее</li>
            </ul>
        </div>
        <div class="right">
            <h2>Книги на руках</h2>

            <ul class="">
                <li class="">...</li>
                <li class="">...</li>
                <li class="">...</li>
                <li class="">...</li>
                <li class="">Подробнее</li>
            </ul>
        </div>

    </div>
</div>
=======
<style>

    .left{
        width: 644px;
        height: 745px;
        background-color: #8B8B8B;
        margin: 100px auto;
        border: none;
        font-family: "Arial";
        font-size: 16px;
        font-weight: bold;
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




<header class="header"></header>

<div class="container">
    <div class="blocks-flex">

        <div class="left">
            <h2>История выдачи/возврата</h2>

            <ul class="">
                <li class=""...</li>
                <li class="">...</li>
                <li class="">...</li>
                <li class="">...</li>
                <li class="">Подробнее</li>
            </ul>
        </div>
        <div class="right">
            <h2>Книги на руках</h2>

            <ul class="">
                <li class=""><div class="book-distr">
                        <?php foreach ($book_distribution as $distribution): ?>
                            <div class="distr">
                                <p>Название книги: <?= htmlspecialchars($distribution->id_book) ?></p>
                                <p>ФИО: <?= htmlspecialchars($distribution->id_read_ticket) ?></p>
                                <p>Дата выдачи: <?= htmlspecialchars($distribution->date_issue) ?></p>
                                <p>Дата возврата: <?= htmlspecialchars($distribution->return_date) ?></p>
                                <h2>Статус: <?= htmlspecialchars($distribution->status) ?></h2>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </li>
                <li class="">...</li>
                <li class="">...</li>
                <li class="">...</li>
                <li class="">Подробнее</li>
            </ul>
        </div>

    </div>
</div>
>>>>>>> d152504 (фиик)
