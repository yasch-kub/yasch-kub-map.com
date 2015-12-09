var map;
var altitude, longtitude;
var address;
var currentInfoWindow;
var currentMarker;

$(document).ready(function(){
    $.ajax({
        url: '/place',
        type: 'post',
        dataType:'json',
        success:function(data){
            putMarkers(data);
        }
    });
});

function initMap() {
    var myStyles = [
        {
            featureType: "poi",
            elementType: "labels",
            stylers: [
                { visibility: "off" }
            ]
        },
        {
            "featureType": "transit",
            "stylers": [
                { "visibility": "off" }
            ]
        }
    ];

    var mapOptions = {
        zoom: 16,
        disableDefaultUI: true
    };
    map = new google.maps.Map(document.getElementById('map'), {
        center: {lat: 50.449102, lng: 30.458258},
        styles: myStyles,
        options:mapOptions
    });

    addClickListeners();
};

var closeOpenedInfoWindow = function() {
    if (currentInfoWindow != undefined)
        currentInfoWindow.close();
    $('#data').fadeOut(400, function() {
        $('#data').html('');
    });
};

var addClickListeners = function() {
    google.maps.event.addListener(map, 'click', function() {
        closeOpenedInfoWindow();
    });

    google.maps.event.addListener(map, 'click', function(event) {
        altitude = event.latLng.lat();
        longtitude = event.latLng.lng();
        geocodeLatLng(event.latLng);
        $("input[name=address]").val(address);
    });
};

function putMarkers(data){
    data.forEach(function(curMarker){
        var contentInfoWindow = "<div>" + curMarker.info.toString() + "<div class='rating'>" +
            "<span><i class='fa fa-star-o'></i></span>" +
            "<span><i class='fa fa-star-o'></i></span>" +
            "<span><i class='fa fa-star-o'></i></span>" +
            "<span><i class='fa fa-star-o'></i></span>" +
            "<span><i class='fa fa-star-o'></i></span>" +
            "</div><button class='show-details'>Детальніше</button></div>";

        var infowindow = new google.maps.InfoWindow({
            content: contentInfoWindow
        });
        var infowindowListener = google.maps.event.addListener(infowindow, 'domready', function(){
            UpdateRating(curMarker.mark);
            infowindowListener.remove();
        });

        var marker = new google.maps.Marker({
            position:{lat: parseFloat(curMarker.altitude), lng: parseFloat(curMarker.longtitude)},
            map: map,
            title: curMarker.name,
            icon:'/images/' + curMarker.icon
        });

        marker.addListener('click', function() {
            closeOpenedInfoWindow();
            currentInfoWindow = infowindow;
            currentMarker = curMarker;
            console.log(currentMarker);
            currentInfoWindow.open(map, marker);
            $('.rating span').off();
            $('.rating span').click(function(){
                console.log($(this));
                console.log('click rating');
                AddRating($(this).nextAll().length + 1, curMarker.id);
            });

            $('.show-details').off();
            $('.show-details').click(function() {
                $.post('/user/show_details', curMarker.id, function(data) {
                    $('#data').html(data);
                });
                console.log($('.comment'));
                $('#data').showOrHideElement();
            });
        });
    });

}

var geocodeLatLng = function(latLng) {
    var geocoder = new google.maps.Geocoder;

    geocoder.geocode({'location': latLng}, function(results, status) {
        if (status === google.maps.GeocoderStatus.OK) {
            if (results[1])
                address = results[0].formatted_address;
            else
                console.log('No results found');
        }
        else
            console.log('Geocoder failed due to: ' + status);
    });
};