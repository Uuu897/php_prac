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

<!--<h3>--><?php //= $message ?? ''; ?><!--</h3>-->
<!--<div class="login-form">-->
<!--    <form method="post" enctype="multipart/form-data">-->
<!--        <input name="csrf_token" type="hidden" value="--><?php //= app()->auth::generateCSRF() ?><!--"/>-->
<!--    <p class="text-login">Добавить библиотекаря</p>-->
<!--    <form method="post">-->
<!--        <input type="text" name="email" placeholder="email">-->
<!--        <input type="text" name="FIO" placeholder="ФИО">-->
<!--        <input type="text" name="number" placeholder="Телефон">-->
<!--        <button>Добавить</button>-->
<!--    </form>-->
<!--</div>-->
