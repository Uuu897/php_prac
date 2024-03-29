<style>
    .container{
        width: 899px;
        height: 450px;
        background-color: #D9D9D9;
        margin: 100px auto;
        border: none;
        font-family: "Arial";
        font-size: 16px;
        font-weight: bold;
    }
    .title {
        font-weight: bold;
        font-size: 33px;
        display: flex;
        flex-direction: column;
        align-items: center;
    }

    .item{
        height: 58px;
        width: 306px;
        background-color: #928E8E;
        border-radius: 20px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .select_body{
        display: flex;
        justify-content: space-around;
        list-style-type: none;
    }
</style>
<div class="container">
    <p class="title">Популярные книги</p>
    <ul class="select_body ">
        <li class="item">Название 1</li>
        <li class="item">Название 2</li>
    </ul>
    <ul class="select_body ">
        <li class="item">Название 3</li>
        <li class="item">Название 4</li>
    </ul>
    <ul class="select_body ">
        <li class="item">Название 5</li>
        <li class="item">Название 6</li>
    </ul>
</div>