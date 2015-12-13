<header>
    <nav class="navbar navbar-inverse">
        <div class="container-fluid">
            <div class="navbar-header">
                <a class="navbar-brand" href="#">yasch-kub-map</a>
            </div>
            <div>
                <ul class="nav navbar-nav">
                    <li id="add-place-button"><a href="#">Додати місце</a></li>
                </ul>
                <ul class="nav navbar-nav">
                    <li id="to-statistic-button"><a href="/statistic">Cтатистика</a></li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <?php if(isset($_SESSION['login'])):?>
                        <li class="is-login"><a href="#"><span class="glyphicon glyphicon-user"></span> <? echo($_SESSION['login']); ?></a></li>
                        <li class="logout-button"><a href="#"><span class="glyphicon glyphicon-log-out"></span>Вихід</a></li>
                    <?php else: ?>
                        <li id="to-registration-button"><a href="#"><span class="glyphicon glyphicon-user"></span>Реєстрація</a></li>
                        <li id="to-login-button"><a href="#"><span class="glyphicon glyphicon-log-in"></span>Вхід</a></li>
                    <?php endif; ?>
                    <?php if (user_model::isAdmin()): ?>
                        <li id="to-admin-button"><a href="/admin"><span class="glyphicon glyphicon-wrench"></span>Панель керування</a></li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>
</header>