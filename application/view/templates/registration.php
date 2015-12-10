<!--<form id="registration-form" method="post" autocomplete="off">-->
<!--    <input type="text" name="login" placeholder="Введіть логін" autocomplete="off">-->
<!--    <input type="email" name="email" placeholder="Введіть email" autocomplete="off">-->
<!--    <input type="password" name="password" placeholder="Пароль" autocomplete="off">-->
<!--    <input type="password" name="password_confirm" placeholder="Подтвердите пароль" autocomplete="off">-->
<!--    <button type="submit">Зарєєструватися</button>-->
<!--    <a href="#">Перейти до входу</a>-->
<!--</form>-->

<form id="registration-form" method="post" class="form-signin">
    <h2 class="form-signin-heading">Реєстрація</h2>
    <input type="text" name="login" id="inputEmail" class="form-control" placeholder="Введіть логін" autocomplete="off" required autofocus>
    <input type="text" name="email" id="inputEmail" class="form-control" placeholder="Введіть email" autocomplete="off" required autofocus>
    <input type="password" name="password" id="inputPassword" class="form-control" placeholder="Пароль" autocomplete="off" required>
    <input type="password" name="password_confirm" id="inputPassword" class="form-control" placeholder="Подтвердите пароль" autocomplete="off" required>
    <button class="btn btn-lg btn-primary btn-block" type="submit">Зареєструватися</button>
    <a href="#">Перейти до входу</a>
</form>