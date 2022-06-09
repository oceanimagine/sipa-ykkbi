var google = typeof google !== "undefined" ? google : {};
var latitude = (typeof latitude !== "undefined") ? latitude : -6.2018064;
var longitude = (typeof longitude !== "undefined") ? longitude : 106.78159240000002;
var mulaimarker = 0;
var markeractive;
var map;
var result_marker;

function initialize(){
    var latitude_local = latitude;
    var longitude_local = longitude;
    var map_div = document.getElementById("map");
    var default_latlng = new google.maps.LatLng(latitude_local, longitude_local);
    map_div.style.height = "250px";
    map_div.style.marginTop = "0px";
    /* Initialize Map */
    var myOptions = {
        zoom: 18,
        center: default_latlng,
        mapTypeId: google.maps.MapTypeId.ROADMAP
    };
    map = new google.maps.Map(map_div, myOptions);
    
    set_marker(default_latlng, "Posisi Default");
    
    /* Google Map Set Marker - Longlat taken from ajax */
    if(typeof result_marker !== "undefined" && result_marker !== ""){
        var split_baris = result_marker.split(",");
        var latlng_object = new google.maps.LatLng(parseFloat(split_baris[0]), parseFloat(split_baris[1]));
        set_marker(latlng_object, "Tempat Wisata", "<b>Tempat Wisata</b><br />\nTempat Wisata");
    }
    
    /* Google Map Search Box */
    var search_map = document.getElementById("search_map");
    var searchBox = new google.maps.places.SearchBox(search_map);
    map.controls[google.maps.ControlPosition.TOP_CENTER].push(search_map);
    google.maps.event.addListener(searchBox, 'places_changed', function() {
        searchBox.set('map', null);
        var places = searchBox.getPlaces();
        var bounds = new google.maps.LatLngBounds();
        var i, place;
        for (i = 0; place = places[i]; i++) {
            (function(place) {
                /* console.log(place.geometry.location.lat()); */
                var latlong = document.getElementById("latlong");
                latlong.value = place.geometry.location.lat() + "," + place.geometry.location.lng();
                var marker = new google.maps.Marker({
                    position: place.geometry.location
                });
                marker.bindTo('map', searchBox, 'map');
                google.maps.event.addListener(marker, 'map_changed', function() {
                    if (!this.getMap()) {
                        this.unbindAll();
                    }
                });
                bounds.extend(place.geometry.location);
            }(place));
        }
        map.fitBounds(bounds);
        searchBox.set('map', map);
        map.setZoom(Math.min(map.getZoom(),18));
    });
    
    /* Google Map on click */
    google.maps.event.addListener(map, 'click', function( event ){
        if(typeof markeractive !== "undefined"){
            markeractive.setMap(null);
            console.log("Coba Null");
        }
        if(mulaimarker){
            set_marker(event.latLng,"Marker Baru.");
            var latlong = document.getElementById("latlong");
            latlong.value = event.latLng.lat() + "," + event.latLng.lng();
        }
    });
    
    /* Google Map on complete */
    google.maps.event.addListenerOnce(map, 'idle', function(){
        search_map.style.display = "initial";
        if(document.getElementById("beginmarker")){
            var beginmarker = document.getElementById("beginmarker");
            beginmarker.onclick = function(){
                this.innerHTML = mulaimarker ? "Tambah Marker" : "Batal Marker";
                mulaimarker = mulaimarker ? 0 : 1;
                if(mulaimarker){
                    map.setOptions({ draggableCursor: 'crosshair' });
                    /* map.setOptions({ draggableCursor: 'pointer' }); */
                } else {
                    map.setOptions({ draggableCursor: 'grab' });
                }
            };
        }
    });
}

function set_marker(latitude_longitude,title_marker,tooltip_title){
    var default_marker = new google.maps.Marker({
        position: latitude_longitude,
        map: map,
        title: title_marker
    });
    var infowindow_marker = new google.maps.InfoWindow({
        content: typeof tooltip_title !== "undefined" ? tooltip_title : title_marker
    });
    google.maps.event.addListener(default_marker, 'click', function( event ){
        infowindow_marker.open(map,default_marker);
        alert( "Latitude : " + event.latLng.lat() + " " + ", Longitude : " + event.latLng.lng() );
    });
    markeractive = default_marker;
}

var latlong = document.getElementById("latlong");
if(latlong.value !== ""){
    result_marker = latlong.value;
    latitude = result_marker.split(',')[0];
    longitude = result_marker.split(',')[1];
}