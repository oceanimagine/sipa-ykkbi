var google = typeof google !== "undefined" ? google : {};


function initialize(increment){
    var latitude_local = latitude[increment];
    var longitude_local = longitude[increment];
    var map_div = document.getElementById("map" + increment);
    var default_latlng = new google.maps.LatLng(latitude_local, longitude_local);
    map_div.style.height = "250px";
    map_div.style.marginTop = "0px";
    /* Initialize Map */
    var myOptions = {
        zoom: 18,
        center: default_latlng,
        mapTypeId: google.maps.MapTypeId.ROADMAP
    };
    map[increment] = new google.maps.Map(map_div, myOptions);
    
    set_marker(default_latlng, "Posisi Default", "Posisi Default", increment);
    
    /* Google Map Set Marker - Longlat taken from ajax */
    if(typeof result_marker[increment] !== "undefined" && result_marker[increment] !== ""){
        var split_baris = result_marker[increment].split(",");
        var latlng_object = new google.maps.LatLng(parseFloat(split_baris[0]), parseFloat(split_baris[1]));
        set_marker(latlng_object, "Tempat Wisata", "<b>Tempat Wisata</b><br />\nTempat Wisata");
    }
    
    /* Google Map Search Box */
    var search_map = document.getElementById("search_map" + increment);
    var searchBox = new google.maps.places.SearchBox(search_map);
    map[increment].controls[google.maps.ControlPosition.TOP_CENTER].push(search_map);
    google.maps.event.addListener(searchBox, 'places_changed', function() {
        searchBox.set('map', null);
        var places = searchBox.getPlaces();
        var bounds = new google.maps.LatLngBounds();
        var i, place;
        for (i = 0; place = places[i]; i++) {
            (function(place) {
                /* console.log(place.geometry.location.lat()); */
                var latlong = document.getElementById("latlong" + increment);
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
                markeractive[increment] = marker;
            }(place));
        }
        map[increment].fitBounds(bounds);
        searchBox.set('map', map[increment]);
        map[increment].setZoom(Math.min(map[increment].getZoom(),18));
    });
    
    /* Google Map on click */
    google.maps.event.addListener(map[increment], 'click', function( event ){
        if(typeof markeractive[increment] !== "undefined"){
            markeractive[increment].setMap(null);
            console.log("Coba Null");
        }
        if(mulaimarker[increment]){
            set_marker(event.latLng,"Marker Baru.","Marker Baru.",increment);
            var latlong = document.getElementById("latlong" + increment);
            latlong.value = event.latLng.lat() + "," + event.latLng.lng();
        }
    });
    
    /* Google Map on complete */
    google.maps.event.addListenerOnce(map[increment], 'idle', function(){
        search_map.style.display = "initial";
        if(document.getElementById("latlong" + increment)){
            var beginmarker = document.getElementById("beginmarker" + increment);
            beginmarker.onclick = function(){
                this.innerHTML = mulaimarker[increment] ? "Tambah Marker" : "Batal Marker";
                mulaimarker[increment] = mulaimarker[increment] ? 0 : 1;
                if(mulaimarker[increment]){
                    map[increment].setOptions({ draggableCursor: 'crosshair' });
                    /* map.setOptions({ draggableCursor: 'pointer' }); */
                } else {
                    map[increment].setOptions({ draggableCursor: 'grab' });
                }
            };
        }
    });
}

function set_marker(latitude_longitude,title_marker,tooltip_title,increment){
    var default_marker = new google.maps.Marker({
        position: latitude_longitude,
        map: map[increment],
        title: title_marker
    });
    var infowindow_marker = new google.maps.InfoWindow({
        content: typeof tooltip_title !== "undefined" ? tooltip_title : title_marker
    });
    google.maps.event.addListener(default_marker, 'click', function( event ){
        infowindow_marker.open(map[increment],default_marker);
        alert( "Latitude : " + event.latLng.lat() + " " + ", Longitude : " + event.latLng.lng() );
    });
    markeractive[increment] = default_marker;
}

var latitude = [];
var longitude = [];
var mulaimarker = [];
var markeractive = [];
var map = [];
var result_marker = [];
for(var i = 0; i <= 100; i++){
    
    if(document.getElementById("latlong" + i)){
        latitude[i] = -6.2018064;
        longitude[i] = 106.78159240000002;
        mulaimarker[i] = 0;
        var latlong = document.getElementById("latlong" + i);
        if(latlong.value !== ""){
            result_marker[i] = latlong.value;
            latitude[i] = result_marker[i].split(',')[0];
            longitude[i] = result_marker[i].split(',')[1];
        }
    } else {
        break;
    }
}