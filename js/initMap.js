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
var map;
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


}

function putMarkers(data){
    var infowindows = [];
    data.forEach(function(currentMarker, index){

        infowindows.push(new google.maps.InfoWindow({
            content: currentMarker.info
        }));

        var marker = new google.maps.Marker({
            position:{lat: parseFloat(currentMarker.altitude), lng: parseFloat(currentMarker.longtitude)},
            map: map,
            title: currentMarker.name,
            icon:'/images/'+currentMarker.icon
        });

        function closeAllInfoWindows(){
            for (var i = 0; i < infowindows.length; i++){
                infowindows[i].close();
            }
        }
        marker.addListener('click', function() {
            closeAllInfoWindows();
            infowindows[index].open(map, marker);
        });

        google.maps.event.addListener(map, 'click', function() {
            closeAllInfoWindows();
        });

        google.maps.event.addListener(map, 'click', function(event) {
            console.log(event.latLng.lat());
            console.log(event.latLng.lng());
            geocodeLatLng(event.latLng);
        });

    });
}

function geocodeLatLng(latLng) {
    var geocoder = new google.maps.Geocoder;
    geocoder.geocode({'location': latLng}, function(results, status) {
        if (status === google.maps.GeocoderStatus.OK) {
            if (results[1]) {

                console.log(results[0].formatted_address);
            } else {
                console.log('No results found');
            }
        } else {
            console.log('Geocoder failed due to: ' + status);
        }
    });
}


