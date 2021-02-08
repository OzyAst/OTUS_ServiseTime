"use strict";

var map;

/**
 * Инит карта
 */
function initMap() {
    map = new google.maps.Map(document.getElementById("map"), {
        zoom: 17
    });

    initMarker();
}

/**
 * Инит маркер
 */
function initMarker() {
    var position = {};
    position.lat = parseFloat(document.getElementById('map').getAttribute('data-lat'));
    position.lng = parseFloat(document.getElementById('map').getAttribute('data-lng'));

    map.setCenter(position);
    var marker = new google.maps.Marker({
        map: map,
        position:position
    });
}
