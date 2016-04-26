
var map;
var iconBase = 'https://maps.google.com/mapfiles/kml/shapes/';
var markers = [];
var ozmarkers = [];

function initMap() {
  map = new google.maps.Map(document.getElementById('map'), {
    center: {lat: 48.6417948, lng: 19.6521837},
    zoom: 8
  });
  
  initMarkers();
}

function initMarkers(){
  $.each(positions, function(key, val){
    if(val.oz != 0) {
        var marker = new google.maps.Marker({
            position: val,
            map: map,
            icon: val.color,
            title: val.firma
        });
    
        var infowindow = new google.maps.InfoWindow({
            content: val.text
        });

        marker.addListener('click', function() {
            infowindow.open(map, marker);
        });    
        markers.push(marker);
        if(typeof ozmarkers[val.oz] == 'undefined') ozmarkers[val.oz] = [];
        ozmarkers[val.oz].push(marker);        
    } else console.log(val.oz);
  });    
}

function toggleoz(ele){
    var oz = $(ele).attr('id');
    var last = true;
    
    $.each(ozmarkers[oz], function(key, val){
        val.setVisible(! val.visible);
        last = val.visible;
    });
    
    if(last){
        $(ele).parent().find('img').fadeTo('fast',1);
    } else {
        $(ele).parent().find('img').fadeTo('fast',0.5);        
    }
    
    $(ele).toggleClass('viss');
}

$(document).ready(function() {
    if(typeof google != "undefined") initMap();    
    $('.datepicker').datepicker({dateFormat: "yy-mm-dd"});
/*
    console.log('positions',positions);
    console.log('icons',icons);
    console.log('ozcollors',ozcollors);
    console.log('empty',empty);
    console.log('adds',adds);
    console.log('ozmarkers',ozmarkers);
*/    
});