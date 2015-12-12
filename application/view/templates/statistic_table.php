<table class="table table-striped">
    <thead>
    <tr>
        <th>Місце</th>
        <th>Адреса</th>
        <th>Рейтинг</th>
        <th>К-сть голосів</th>
        <th>К-сть коментарів</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($places as $place): ?>
        <tr>
            <td><? echo $place['name']; ?></td>
            <td><? echo $place['address']; ?></td>
            <td>
                <div class = 'rating statistic'>
                    <?php for($i = 5; $i > 0; $i--): ?>
                        <?php if ($place['mark'] >= $i): ?>
                            <i class="fa fa-star"></i>
                        <?php elseif ($place['mark'] == $i - 0.5): ?>
                            <i class="fa fa-star-half-o"></i>
                        <?php else: ?>
                            <i class="fa fa-star-o"></i>
                        <?php endif; ?>
                    <?php endfor; ?>
                </div>
            </td>
            <td><? echo $place['n_views']; ?></td>
            <td><? echo $place['n_comments']; ?></td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>