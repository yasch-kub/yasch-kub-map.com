<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>yasch_kub-map</title>
    <link rel="stylesheet" href="/css/style.css">
    <script src="/js/jquery-2.1.4.js"></script>
    <script src="/js/admin.js"></script>
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
            </div>
        </nav>
    </header>
    <div id="content">
        <ul class="nav nav-tabs">
            <li class="active"><a href="#" id="admin-to-new-place">Підтвердити місця</a></li>
            <li><a href="#" id="admin-to-all-place">Всі місця</a></li>
        </ul>
        <div class="tab-content">
            <?php include_once root . '/application/view/templates/admin_new_place_table.php'; ?>
        </div>
    </div>
</div>
</body>
</html>