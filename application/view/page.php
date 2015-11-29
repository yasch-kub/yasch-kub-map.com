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
</head>
<body>
 <div id="map"></div>
    <form>
        <input name="name" placeholder="Назва місця">
        <input name="adress" placeholder="Адреса місця">
        <input name="category" placeholder="Категорія" list="category_list">
        <datalist id="category_list">
        </datalist>
        <textarea name="info" placeholder="Інформація"></textarea>
        <button type="submit">Додати</button>
    </form>
</body>
</html>
