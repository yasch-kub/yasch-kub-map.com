<table class="table table-striped">
    <thead>
    <tr>
        <th>Іконка</th>
        <th>Категорія</th>
        <th>Місце</th>
        <th>Адреса</th>
        <th>Інформація</th>
        <th></th>
    </tr>
    </thead>
    <tbody>
    <?php foreach (place_model::getAllPlace() as $place): ?>
        <tr>
            <td><img src="/images/<? echo $place['icon']; ?>"></td>
            <td><? echo $place['category']; ?></td>
            <td><? echo $place['name']; ?></td>
            <td><? echo $place['address']; ?></td>
            <td><? echo $place['info']; ?></td>
            <td>
                <input type="hidden" value="<? echo $place['id']; ?>">
                <button class="btn btn-lg btn-danger btn-block admin-remove-place-button">Видалити</button>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>