var tb_vertex;
$(function () {
    tb_vertex = $('#tb_vertex').DataTable(
            {
                "columnDefs": [
                    {
                        "targets": [6],
                        "orderable": false
                    },
                    {
                        "targets": [7, 8],
                        "visible": false
                    },
                    {
                        width: 10, targets: [0],
                        width: 100, targets: [1]
                    }
                ],
                "language": {
                    "lengthMenu": 'Tampil <select class="form-control select2">' +
                            '<option value="10">10</option>' +
                            '<option value="25">25</option>' +
                            '<option value="50">50</option>' +
                            '<option value="-1">All</option>' +
                            '</select> records',
                    "search": "Cari:",
                    "sSearchPlaceholder": "Any...",
                    "sInfo": "Menampilkan _START_ - _END_ dari _TOTAL_",
                },
                "pagingType": "simple_numbers"
            });
    var buttons_keluhan = new $.fn.dataTable.Buttons(tb_vertex, {
        buttons: [
            {
                extend: 'pdf',
                exportOptions: {
                    columns: [0, 1, 2, 3, 4, 5]
                },
                title: 'Data Vertex',
                "className": 'btn btn-danger'
            },
            {
                extend: 'csv',
                exportOptions: {
                    columns: [0, 1, 2, 3, 4, 5]
                },
                title: "Data Vertex",
                "className": 'btn btn-danger'
            },
            {
                extend: 'excel',
                exportOptions: {
                    columns: [0, 1, 2, 3, 4, 5]
                },
                title: 'Data Vertex',
                "className": 'btn btn-danger'
            },
            {
                extend: 'print',
                exportOptions: {
                    columns: [0, 1, 2, 3, 4, 5]
                },
                title: 'Data Vertex',
                "className": 'btn btn-danger'
            }
        ]
    }).container().appendTo($('#export_button_vertex'));
});
function showEditDialog_vertex(lat, lng) {
    $('#md_edit_vertex').modal();
    $('#tb_vertex tbody').on('click', 'tr', function () {
        var rows = tb_vertex.rows(this).data();
        $('#nomor_vertex').val(rows[0][1]);
        $('#koordinat_vertex').val(lat + ',' + lng);
        $('#nama_vertex').val(rows[0][2]);
        if (rows[0][7] == 'TRUE') {
            $('#has_source').iCheck('check');
        } else {
            $('#has_source').iCheck('uncheck');
        }

    });
}

$('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
    checkboxClass: 'icheckbox_minimal-blue',
    radioClass: 'iradio_minimal-blue'
});

function postEditVertex() {
    if ($('#has_source').is(":checked")) {
        var has_source = 'TRUE';
    } else {
        var has_source = 'FALSE';
    }
    var nama = $('#nama_vertex').val();
    var node = $('#nomor_vertex').val();
    $.post('ajax/edit_vertex.php', {'node': node, 'nama': nama, 'has_source': has_source}, function (result) {
        if (result) {
            location.reload();
        } else {
            alert('Edit data gagal');
        }
    });
}

function showMapModal(lat, lng) {
    $("#md_map").modal();
    $('#tb_vertex tbody').on('click', 'tr', function () {
        var rows = tb_vertex.rows(this).data();
        var nomor = rows[0][1];
        if (rows[0][2] == '') {
            var nama = 'Nomor Node: ' + rows[0][1];
        } else {
            var nama = rows[0][2];
        }
        $('#md_map_title').text(nomor + ' | ' + nama);
        $('#footer_koordinat').html('<a class="fa fa-map"></a> ' + lat + ',' + lng);
        var latlng = new google.maps.LatLng(lat, lng);
        marker.setPosition(latlng);
        marker.setTitle(nama);
        map.setZoom(16);
        map.setCenter(marker.position);
        infowindow.setContent(nama);
        infowindow.open(map, marker);
        setTimeout(function () {
            marker.setAnimation(google.maps.Animation.BOUNCE);
        }, 500);
    });
}
$("#md_map").on("shown.bs.modal", function () {
    google.maps.event.trigger(map, "resize");
});

var map;
var marker;
var infowindow;
function initMap() {
    map = new google.maps.Map(document.getElementById('map-modal'),
            {
                zoom: 15,
                center: {lat: -7.5659265, lng: 110.8272557},
                disableDefaultUI: true,
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
            }
    );
    infowindow = new google.maps.InfoWindow();
    marker = new google.maps.Marker({
        //position: 0,
        map: map,
        title: '',
        icon: 'nodemaker/assets/marker/ts-map-pin.png',
        draggable: false
    });
    google.maps.event.addListener(marker, 'click', function () {
        infowindow.open(map, this);
    });

}