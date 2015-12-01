var map;
var altitude, longtitude;
var infowindows = [];
var address;
var currentInfoWindow;

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
    data.forEach(function(currentMarker){
        var infowindow = new google.maps.InfoWindow({
            content: currentMarker.info
        });

        var marker = new google.maps.Marker({
            position:{lat: parseFloat(currentMarker.altitude), lng: parseFloat(currentMarker.longtitude)},
            map: map,
            title: currentMarker.name,
            icon:'/images/' + currentMarker.icon
        });

        marker.addListener('click', function() {
            closeOpenedInfoWindow();
            currentInfoWindow = infowindow;
            currentInfoWindow.open(map, marker);
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