var geocoder;
var map;
var adress = '%adress%';
var mapOptions = {
    zoom: %zoom%, // TODO BUG
    disableDefaultUI: %hideUI%
};

geocoder = new google.maps.Geocoder();
map      = new google.maps.Map(document.getElementById('cm%id%'), mapOptions);

geocoder.geocode({'address': adress}, function (results, status) {
    map.setCenter(results[0].geometry.location);

    var marker = new google.maps.Marker({
        map: map,
        position: results[0].geometry.location
    });
});
