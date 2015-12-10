<!--<form id="add-place" action="" method="post" autocomplete="off">-->
<!--    <input name="name" placeholder="Назва місця">-->
<!--    <input name="address" placeholder="Адреса місця">-->
<!--    <input name="category" placeholder="Категорія" list="category_list">-->
<!--    <datalist id="category_list">-->
<!--    </datalist>-->
<!--    <textarea name="info" placeholder="Інформація"></textarea>-->
<!--    <button type="submit" id="add-place">Додати</button>-->
<!--</form>-->

<form id="add-place" method="post" class="form-signin">
    <h2 class="form-signin-heading">Додати місце</h2>
    <input name="name" placeholder="Назва місця" class="form-control" autocomplete="off" required autofocus>
    <input name="address" placeholder="Адреса місця" class="form-control" autocomplete="off" required autofocus>
    <input name="category" placeholder="Категорія" list="category_list" class="form-control" autocomplete="off" required autofocus>
    <datalist id="category_list">
    </datalist>
    <textarea name="info" placeholder="Інформація"  class="form-control" rows="5" id="comment"></textarea>
    <button class="btn btn-lg btn-primary btn-block" type="submit">Додати</button>
</form>