<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>yasch_kub-map</title>
    <link rel="stylesheet" href="/css/style.css">
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBYtYTNOBfD0RSWW36zI0lOP_r6oP8XyTk&callback=initMap" defer></script>
    <script src="/js/jquery-2.1.4.js"></script>
    <script src="/js/initMap.js"></script>
    <script src="/js/AddPlace.js"></script>
    <script src="/js/InfoWindow.js"></script>
    <script src="/js/user.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
</head>
<body>
    <div id="map"></div>
    <div id="control-panel">
        <button id="add-place-button">
            Додати місце
        </button>
        <?php include_once root . '/application/view/templates/add_place_form.php'; ?>
    </div>
    <div id="data">
    </div>
</body>
</html>
