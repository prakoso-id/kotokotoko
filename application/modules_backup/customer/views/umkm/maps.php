
<script type="text/javascript">
    require([
            "esri/Map",
            "esri/Graphic", //
            "esri/views/MapView",
            "esri/tasks/Locator",
            "esri/layers/MapImageLayer",
            "esri/layers/GraphicsLayer", //
            "esri/widgets/Search",
            "esri/geometry/Point", //
            "esri/symbols/SimpleMarkerSymbol", //
            "dojo/dom",
            "dojo/on",
            "dojo/domReady!"
            ], function(
              Map,
              Graphic,
              MapView,
              Locator,
              MapImageLayer,
              GraphicsLayer,
              Search,
              Point,
              SimpleMarkerSymbol,
              dom,
              on
            ){
                var TngImageryLyr = new MapImageLayer({
                    url: "https://maps.tangerangkota.go.id/arcgis/rest/services/Imagery/TangerangImagery/MapServer",
                    // url: "https://maps.tangerangkota.go.id/arcgis/rest/services/Batas_Adminsitratif/batas_kec_poligon/FeatureServer/0"
                    id : "tngImagery"
                });
                var mapLayer = new GraphicsLayer();
                var lat = +document.getElementById('lat').value;
                var lng = +document.getElementById('long').value;
                // var lat = +$('[name="lat"]').val();
                // var lng = +$('[name="long"]').val();
                if ( ((lat == "")&&(lng == "")) || ((lat == null)&&(lng == null)) || ((lat == 0)&&(lng == 0)) ) {
                    // Gedung Cisadane
                    lat = -6.166623799999999;
                    lng = 106.63083849999998;
                }
                map = new Map({
                    basemap: "osm",
                    layers: [TngImageryLyr]
                });

                view = new MapView({
                    container: "maps",  // Reference to the scene div created in step 5
                    map: map,  // Reference to the map object created before the scene
                    zoom: 35,  // Sets zoom level based on level of detail (LOD)
                    center: [lng,lat]  // Sets center point of view using longitude,latitude
                });

                var search = new Search({
                    sources: [{
                        locator: new Locator({ url: "https://maps.tangerangkota.go.id/arcgis/rest/services/Locator/tngkota_locators/GeocodeServer"}),
                        country:"Tangerang",
                        singleLineFieldName: "SingleLine",
                        name: "Custom Geocoding Service",
                        localSearchOptions: {
                            minScale: 3000,
                            distance: 500
                        },
                        placeholder: "Cari Alamat",
                        maxResults: 3,
                        maxSuggestions: 6,
                        suggestionsEnabled: true,
                        minSuggestCharacters: 0
                    }],
                    view: view,
                    includeDefaultSources: false
                });

                console.log(search);

                view.ui.add(search, "top-right");

                view.on("click", function(evt){
                    search.clear();
                    view.popup.clear();
                    if (search.activeSource) {
                        var geocoder = search.activeSource.locator; // World geocode service
                        geocoder.locationToAddress(evt.mapPoint)
                        .then(function(response) { // Show the address found
                            console.log(JSON.stringify(response));
                            // console.log("LAT : "+evt.mapPoint.latitude);
                            // console.log("LNG : "+evt.mapPoint.longitude);
                            var address = response.address;
                            var arrAlamat = address.split(', ');
                            $("#lat").val(evt.mapPoint.latitude);
                            $("#long").val(evt.mapPoint.longitude);
                            $("#alamat").val(response.address);
                            // $("#nama_kel").val(arrAlamat[1]);
                            // find_kel(arrAlamat[1]);
                            // $("#nama_kec").val(arrAlamat[2]);
                            // find_kec(arrAlamat[2]);
                            showPopup(address, evt.mapPoint);
                        }, function(err) { // Show no address found
                            showPopup("No address found.", evt.mapPoint);
                        });
                    }
                });

                function showPopup(address, pt) {
                    remarker(point,pt);
                    view.popup.open({
                        title:  + Math.round(pt.longitude * 100000)/100000 + "," + Math.round(pt.latitude * 100000)/100000,
                        content: address,
                        location: pt
                    });
                }

                function remarker(ptOld,ptNew) {
                    // Last
                    mapLayer.graphics.remove(marker);

                    // New
                    point.latitude = ptNew.latitude;
                    point.longitude = ptNew.longitude;
                    marker = new Graphic({
                        geometry: point,
                        symbol: markerSymbol
                    });
                    mapLayer.graphics.add(marker);
                    map.add(mapLayer);
                }


                // $.each(lokasi_lapak,function(index,elm){
                    var point = {
                        type: "point",  // autocasts as new Point()
                        longitude: lng,
                        latitude: lat
                    };
                    var markerSymbol = {
                        type: "picture-marker",  // autocasts as new SimpleMarkerSymbol()
                        url: 'https://cdn0.iconfinder.com/data/icons/small-n-flat/24/678111-map-marker-512.png',
                        // url: '<?php echo base_url('assets/images/Sapi.png') ?>',
                        // url: 'assets/images/Sapi.png',
                        width: "60px",
                        height: "60px"
                    };
                    var marker = new Graphic({
                        geometry: point,
                        symbol: markerSymbol
                    });
                    mapLayer.graphics.add(marker);
                    // mapLayer.graphics.remove(marker);
                // });

                map.add(mapLayer);
            }
        ); 
</script>