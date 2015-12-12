<table class="table table-striped">
    <thead>
    <tr>
        <th>Місце</th>
        <th>Рейтинг</th>
        <th>К-сть голосів</th>
        <th>К-сть коментарів</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach (statistic_model::getAllPlaceByCategory($category) as $place): ?>
        <tr>
            <td><? echo $place['name']; ?></td>
            <td><? echo $place['mark']; ?></td>
            <td><? echo $place['n_views']; ?></td>
            <td><? echo $place['n_comments']; ?></td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>