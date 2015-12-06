<div class="comment">
    <?php
        foreach(user_model::getAllCommentsByPlaceID($id) as $comment)
            include root . '/application/view/comment_view.php';
    ?>
</div>

<form class="add-comment" method="post">
    <label>
        <span>Ваш коментар:</span>
        <textarea name="comment"></textarea>
    </label>
    <button type="submit">
        Відправити
    </button>
</form>


