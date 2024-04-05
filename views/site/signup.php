
<h3><?= $message ?? ''; ?></h3>
<div class="login-form">
    <p class="text-login">Добавление библиотекаря</p>
    <form method="post">
        <input name="csrf_token" type="hidden" value="<?= app()->auth::generateCSRF() ?>"/>
        <label><input type="text" name="name" placeholder="ФИО"></label>
        <label> <input type="text" name="login" placeholder="login"></label>
        <label> <input type="text" name="password" placeholder="Пароль"></label>
        <button>Добавить</button>
    </form>
</div>

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
        max-height: 750px;
        max-width: 550px;
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