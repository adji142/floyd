var map;
var node_tujuan, node_asal;
var allMarkers = [];
var custMarker = [];
var formatted_address = [];
var marker_asal;
var infowindow;
var directionsService;
var directionsDisplay;
var geocoderID = [];
var geocoder;
$('form').on('keydown', function (e) {
    if (e.which === 13) {
        login();
    }
    $('#error_message').addClass('hide');
});
function login() {
    var email = $('#email').val();
    var password = $('#password').val();
    if (email && password !== '') {
        $.post("admin/auth/validate.php",
                {
                    email: email,
                    password: password
                },
                function (response, status) {
                    if (response.logged == true) {
                        location.href = 'admin/';
                    } else {
                        $('#error_message').removeClass('hide');
                    }
                });
    }
}
(function ($) {
    "use strict";
    function markerAsal(teks, Lat, Lng) {
        var icons = 'images/marker/start.png';
        var coordinate = JSON.parse('{"lat": ' + Lat + ', "lng": ' + Lng + '}');
        if (marker_asal) {
            marker_asal.setPosition(coordinate);
        } else {
            marker_asal = new google.maps.Marker({
                icon: icons,
                position: coordinate,
                map: map,
                draggable: false
            });
        }
        createInfoWindow(marker_asal, teks);
    }
    $('#asal').on('change', function () {
        var lat = $(this).find(':selected').data('lat');
        var lng = $(this).find(':selected').data('lng');
        var texs = $(this).find(':selected').text();
        node_asal = $(this).val();
        markerAsal(texs, lat, lng);
//        alert(node_asal);
//        $('#isNavigate').addClass('compressed');
//        $('#isNavigate').removeClass('expanded');
        if (node_tujuan != null) {
            getData();
        }
    });
    $('#tujuan').on('change', function () {
        node_tujuan = $(this).val();
//        alert(node_tujuan);
        // if (node_asal != "") {
        //     getData();
        // }
        getData();
    });
    function createInfoWindow(marker, popupContent) {
        google.maps.event.addListener(marker, 'click', function () {
            infowindow.setContent('<span class="fa fa-location-arrow"> Starting Point: ' + popupContent + '</span>');
            infowindow.open(map, this);
        });
        infowindow.setContent('<span class="fa fa-location-arrow"> Starting Point: ' + popupContent + '</span>');
        infowindow.open(map, marker_asal);
    }
    var marker_tujuan = '';

    function getData() {
//        directionsDisplay.setMap(main_map);
        for (var i = 0; i < allMarkers.length; i++) {
            var marker_div = allMarkers[i].div;
            $(marker_div).removeClass('clicked');
            if (allMarkers[i].args.marker_id == node_tujuan) {
//                console.log(i);
                marker_tujuan = allMarkers[i].latlng;
               console.log(marker_tujuan);
                var marker_div = allMarkers[i].div;
                $(marker_div).addClass('clicked');
            }
        }
        deleteNodeMarker();
        $.post('core/processing.php', {asal: node_asal, tujuan: node_tujuan}, function (response) {
            calcRoute(response);
        });
        custMarker = [];
        formatted_address = [];
    }
    function createMarker(teks, lat, lng, node) {
        var locations = new google.maps.LatLng(lat, lng);
        var icon = 'images/marker/waypts.png';
        var wayptsmarker = new google.maps.Marker({
            position: locations,
            map: map,
            icon: icon,
            draggable: false,
            title: 'Waypts Node: ' + node
        });
        custMarker.push(wayptsmarker);
        windowPOI(wayptsmarker, teks, lat, lng);
    }
    function windowPOI(markernode, popupContent, lat, lng) {
        google.maps.event.addListener(markernode, 'click', function () {
            for (var i = 0; i < custMarker.length; i++) {
                if (this.title == custMarker[i].title) {
//                    infowindow.setContent(formatted_address[i]);
                    infowindow.setContent(popupContent);
                }
            }
            infowindow.open(map, this);
        });
    }
    function calcRoute(data) {
        var rute = '';
        var keterangan = '';
        directionsDisplay.setMap(map);
        var i;
        var start = marker_asal.position;
        var end = marker_tujuan;
        var waypts = [];
        // console.log(data.data[0].path);
        for (var i = 0; i < data.data[0]['path'].length; i++) {
            waypts.push({location: data.data[0]['path'][i]['koordinat'], stopover: true});
            var teks = '<span>Node: ' + data.data[0]['path'][i]['node'] + '</span><br>' +
                    '<span>Keterangan: ' + data.data[0]['path'][i]['nama'] + '</span>';
            createMarker(teks, data.data[0]['path'][i]['lat'], data.data[0]['path'][i]['lng'], data.data[0]['path'][i]['node']);

            if (i == data.data[0]['path'].length - 1) {
                rute += data.data[0]['path'][i]['node'];
                if (data.data[0]['path'][i]['nama'] != '') {
                    keterangan += data.data[0]['path'][i]['nama'];
                } else {
                    keterangan += data.data[0]['path'][i]['node'];
                }

            } else {
                rute += data.data[0]['path'][i]['node'] + ' - ';
                if (data.data[0]['path'][i]['nama'] != '') {
                    keterangan += data.data[0]['path'][i]['nama'] + ' <span class="fa fa-long-arrow-right "></span> ';
                } else {
                    keterangan += data.data[0]['path'][i]['node'] + ' <span class="fa fa-long-arrow-right "></span> ';
                }
            }
        }
        $('#listing-rute').html('');
        // console.log(start);
        // console.log(end);
        // console.log(waypts);
        var x = data.data[0]['path'][data.data[0]['path'].length - 1]['koordinat'].split(",");
        console.log(x);
        var request = {
            origin: start,
            destination: {lat:parseFloat(x[0]), lng: parseFloat(x[1])},
            waypoints: waypts,
            optimizeWaypoints: true,
            travelMode: google.maps.TravelMode.DRIVING
        };
        geocoderID = [];

        directionsService.route(request, function (response, status) {
            if (status === google.maps.DirectionsStatus.OK) {
                directionsDisplay.setDirections(response);
                directionsDisplay.setPanel(document.getElementById('google_direction'));
                for (var i = 0; i < response['geocoded_waypoints'].length; i++) {
//                    geocoderID.push(response['geocoded_waypoints'][i]['place_id']);
//                console.log(response['geocoded_waypoints'][i]['place_id']);
                }
//                showEncodedAddress(geocoder);
            }
        });
        infowindow.open(map, marker_asal);
        $('#path').html('<h4 class="">Node Yang Dilalui: ' + "</h4><p>" + rute + "</p>");
        $('#jarak').html('<h4 class="">Total Jarak: </h4><p>' + data.data[0]['jarak'] + ' Meter</p>');
        $('#keterangan').html('<h4 class="">Info Jalur: ' + "</h4><p>" + keterangan + "</p>");
    }
    function deleteNodeMarker() {
        for (var i = 0; i < custMarker.length; i++) {
            custMarker[i].setMap(null);
        }
        custMarker = [];
    }
    function mainMap() {
        var ib = new InfoBox();
        var lokasi = [];
        $.ajax({
            'url': 'ajax/hotel_marker.php',
            'success': function (data) {
                $.each(data, function (index, value) {
                    var each = [];
                    each.push(locationData('#', 'images/hotel/' + value.img, value.title, value.address, value.telp), value.latitude, value.longitude, value.id, '<i class="im im-icon-Home-2"></i>');
                    lokasi.push(each);
                });
//                console.log(lokasi);
                var markerCluster, overlay, i;

                var clusterStyles = [{
                        textColor: 'white',
                        url: '',
                        height: 50,
                        width: 50
                    }];
                var markerIco;
                console.log(lokasi);
                for (i = 0; i < lokasi.length; i++) {
                    markerIco = lokasi[i][4];
                    var overlaypositions = new google.maps.LatLng(lokasi[i][1], lokasi[i][2]),
                            overlay = new CustomMarker(overlaypositions, map, {
                                marker_id: lokasi[i][3]
                            }, markerIco);
                    allMarkers.push(overlay);
                    google.maps.event.addDomListener(overlay, 'click', (function (overlay, i) {
                        return function () {
                            ib.setOptions(boxOptions);
                            boxText.innerHTML = lokasi[i][0];
                            ib.open(map, overlay);
                            currentInfobox = lokasi[i][3];
                            google.maps.event.addListener(ib, 'domready', function () {
                                $('.infoBox-close').click(function (e) {
                                    e.preventDefault();
                                    ib.close();
                                    $('.map-marker-container').removeClass('clicked infoBox-opened');
                                });
                            });
                        }
                    })(overlay, i));
                }
                var options = {
                    imagePath: 'images/',
                    styles: clusterStyles,
                    minClusterSize: 2
                };
                markerCluster = new MarkerClusterer(map, allMarkers, options);
                $('.listing-item-container').on('mouseover', function () {
                    var listingAttr = $(this).data('marker-id');
                    if (listingAttr !== undefined) {
                        var listing_id = $(this).data('marker-id');
                        for (var i = 0; i < allMarkers.length; i++) {
                            if (allMarkers[i].args.marker_id == listing_id) {
                                var marker_div = allMarkers[i].div;
                                $(marker_div).addClass('clicked');
                                $(this).on('mouseout', function () {
                                    if ($(marker_div).is(":not(.infoBox-opened)")) {
                                        $(marker_div).removeClass('clicked');
                                    }
                                });
                            }
                        }
                    }
                });
            }
        });

        function locationData(locationURL, locationImg, locationTitle, locationAddress, phone) {
            return ('' + '<a href="' + locationURL + '" class="listing-img-container">' + '<div class="infoBox-close"><i class="fa fa-times"></i></div>' + '<img src="' + locationImg + '" alt="">' + '<div class="listing-item-content">' + '<h3>' + locationTitle + '</h3>' + '<span>' + locationAddress + '</span>' + '</div>' + '</a>' + '<div class="listing-content">' + '<div class="listing-title">' + '<div class="rating-counter">' + phone + '</div></div>' + '</div>' + '</div>')
        }
        var mapZoomAttr = $('#map').attr('data-map-zoom');
        var mapScrollAttr = $('#map').attr('data-map-scroll');
        if (typeof mapScrollAttr !== typeof undefined && mapScrollAttr !== false) {
            var scrollEnabled = parseInt(mapScrollAttr);
        } else {
            var scrollEnabled = false;
        }
        directionsService = new google.maps.DirectionsService();
        directionsDisplay = new google.maps.DirectionsRenderer({suppressMarkers: true});
        infowindow = new google.maps.InfoWindow();
        map = new google.maps.Map(document.getElementById('map'), {
            zoom: 11,
            scrollwheel: true,
            center: new google.maps.LatLng(-7.571840, 110.806699),
            mapTypeId: google.maps.MapTypeId.ROADMAP,
            zoomControl: false,
            mapTypeControl: false,
            scaleControl: false,
            panControl: false,
            navigationControl: false,
            streetViewControl: false,
            gestureHandling: 'cooperative',
styles: [
                {
                    "elementType": "labels.text.stroke",
                    "stylers": [
                        {
                            "visibility": "on"
                        },
                        {
                            "color": "#ffffff"
                        },
                        {
                            "lightness": 16
                        }
                    ]
                },
                {
                    "elementType": "labels.text.fill",
                    "stylers": [
                        {
                            "saturation": 36
                        },
                        {
                            "visibility": "on"
                        },
                        {
                            "color": "#333333"
                        },
                        {
                            "lightness": 40
                        }
                    ]
                },
                {
                    "featureType": "poi",
                    "stylers": [
                        {
                            "visibility": "off"
                        }
                    ]
                },
                {
                    "featureType": "transit",
                    "elementType": "geometry",
                    "stylers": [
                        {
                            "color": "#A5A5A5"
                        },
                        {
                            "lightness": 19
                        }
                    ]
                },
                {
                    "featureType": "road",
                    "elementType": "labels.icon",
                    "stylers": [
                        {
                            "visibility": "on"
                        }
                    ]
                }
            ]            
			});

        var boxText = document.createElement("div");
        boxText.className = 'map-box';
        var currentInfobox;
        var boxOptions = {
            content: boxText,
            disableAutoPan: false,
            alignBottom: true,
            maxWidth: 0,
            pixelOffset: new google.maps.Size(-134, -55),
            zIndex: null,
            boxStyle: {
                width: "270px"
            },
            closeBoxMargin: "0",
            closeBoxURL: "",
            infoBoxClearance: new google.maps.Size(25, 25),
            isHidden: false,
            pane: "floatPane",
            enableEventPropagation: false,
        };
//        google.maps.event.addDomListener(window, "resize", function () {
//            var center = map.getCenter();
//            google.maps.event.trigger(map, "resize");
//            map.setCenter(center);
//        });
        var zoomControlDiv = document.createElement('div');
        var zoomControl = new ZoomControl(zoomControlDiv, map);

        function ZoomControl(controlDiv, map) {
            zoomControlDiv.index = 1;
            map.controls[google.maps.ControlPosition.RIGHT_CENTER].push(zoomControlDiv);
            controlDiv.style.padding = '5px';
            controlDiv.className = "zoomControlWrapper";
            var controlWrapper = document.createElement('div');
            controlDiv.appendChild(controlWrapper);
            var zoomInButton = document.createElement('div');
            zoomInButton.className = "custom-zoom-in";
            controlWrapper.appendChild(zoomInButton);
            var zoomOutButton = document.createElement('div');
            zoomOutButton.className = "custom-zoom-out";
            controlWrapper.appendChild(zoomOutButton);
            google.maps.event.addDomListener(zoomInButton, 'click', function () {
                map.setZoom(map.getZoom() + 1);
            });
            google.maps.event.addDomListener(zoomOutButton, 'click', function () {
                map.setZoom(map.getZoom() - 1);
            });
        }
        var scrollEnabling = $('#scrollEnabling');
        $(scrollEnabling).click(function (e) {
            e.preventDefault();
            $(this).toggleClass("enabled");
            if ($(this).is(".enabled")) {
                map.setOptions({
                    'scrollwheel': true
                });
            } else {
                map.setOptions({
                    'scrollwheel': false
                });
            }
        });
    }
    var maps = document.getElementById('map');
    if (typeof (maps) != 'undefined' && maps != null) {
        google.maps.event.addDomListener(window, 'load', mainMap);
        //google.maps.event.addDomListener(window, 'resize', mainMap);
    }

    function CustomMarker(latlng, map, args, markerIco) {
        this.latlng = latlng;
        this.args = args;
        this.markerIco = markerIco;
        this.setMap(map);
    }
    CustomMarker.prototype = new google.maps.OverlayView();
    CustomMarker.prototype.draw = function () {
        var self = this;
        var div = this.div;
        if (!div) {
            div = this.div = document.createElement('div');
            div.className = 'map-marker-container';
            div.innerHTML = '<div class="marker-container">' + '<div class="marker-card">' + '<div class="front face">' + self.markerIco + '</div>' + '<div class="back face">' + self.markerIco + '</div>' + '<div class="marker-arrow"></div>' + '</div>' + '</div>'
            google.maps.event.addDomListener(div, "click", function (event) {
                $('.map-marker-container').removeClass('clicked infoBox-opened');
                google.maps.event.trigger(self, "click");
                $(this).addClass('clicked infoBox-opened');
            });
            if (typeof (self.args.marker_id) !== 'undefined') {
                div.dataset.marker_id = self.args.marker_id;
            }
            var panes = this.getPanes();
            panes.overlayImage.appendChild(div);
        }
        var point = this.getProjection().fromLatLngToDivPixel(this.latlng);
        if (point) {
            div.style.left = (point.x) + 'px';
            div.style.top = (point.y) + 'px';
        }
    };
    CustomMarker.prototype.remove = function () {
        if (this.div) {
            this.div.parentNode.removeChild(this.div);
            this.div = null;
            $(this).removeClass('clicked');
        }
    };
    CustomMarker.prototype.getPosition = function () {
        return this.latlng;
    };
})(this.jQuery);