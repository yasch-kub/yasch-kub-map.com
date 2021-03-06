<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>yasch_kub-map</title>
    <link rel="stylesheet" href="/css/style.css">
    <script src="/js/jquery-2.1.4.js"></script>
    <script src="/js/statistic.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
</head>
<body>
    <div id="container">
        <header>
            <nav class="navbar navbar-inverse">
                <div class="container-fluid">
                    <div class="navbar-header">
                        <a class="navbar-brand" href="/">yasch-kub-map</a>
                    </div>
                    <div>
                        <ul class="nav navbar-nav">
                            <select id="selected-item" name="filter" placeholder="Виберіть фільтер" class="form-control filter_list" autocomplete="off" required>
                                <option>Всі...</option>
                                <?php foreach(place_model::getCategories() as $cat): ?>
                                    <option><? echo $cat['name']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </ul>
                    </div>
                </div>
            </nav>
        </header>
        <div id="content">
            <table class="table table-striped">
                <thead>
                <tr>
                    <th>Місце<span><i class="fa fa-long-arrow-down"></i></span></th>
                    <th>Адреса<span></span></th>
                    <th>Рейтинг<span></span></th>
                    <th>К-сть голосів<span></span></th>
                    <th>К-сть коментарів<span></span></th>
                </tr>
                </thead>
                <tbody>
                    <?php include_once root . '/application/view/templates/statistic_table.php'; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>