var tb_hotel;
$(function () {
    tb_hotel = $('#tb_hotel').DataTable(
            {
                "columnDefs": [
                    {
                        "targets": [1, 6],
                        "orderable": false
                    },
                    {
                        width: 10, targets: [0]
                    },
                    {
                        width: 40, targets: [1]
                    },
                    {
                        width: 100, targets: [2]
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
            }
    );
    var buttons_keluhan = new $.fn.dataTable.Buttons(tb_hotel, {
        buttons: [
            {
                extend: 'pdf',
                exportOptions: {
                    columns: [0, 2, 3, 4, 5]
                },
                title: 'Data hotel',
                "className": 'btn btn-danger'
            },
            {
                extend: 'csv',
                exportOptions: {
                    columns: [0, 2, 3, 4, 5]
                },
                title: "Data hotel",
                "className": 'btn btn-danger'
            },
            {
                extend: 'excel',
                exportOptions: {
                    columns: [0, , 2, 3, 4, 5]
                },
                title: 'Data hotel',
                "className": 'btn btn-danger'
            },
            {
                extend: 'print',
                exportOptions: {
                    columns: [0, 2, 3, 4, 5]
                },
                title: 'Data hotel',
                "className": 'btn btn-danger'
            }
        ]
    }).container().appendTo($('#export_button_hotel'));
});
function showEditDialog_hotel(id_vertex, id_tempat) {
    $('#md_edit_hotel').modal();
    $('#id_vertex').val(id_vertex);
    $('#id_tempat').val(id_tempat);
    $('#tb_hotel tbody').on('click', 'tr', function () {
        var rows = tb_hotel.rows(this).data();
        $('#namahotel_edit').val(rows[0][2]);
        $('#alamathotel_edit').val(rows[0][3]);
        $('#infohotel_edit').val(rows[0][5]);
        $('#telphotel_edit').val(rows[0][4]);
        $('#imghotel_edit').attr('src', '');
        $('#imghotel_edit').attr('src', $('#imgThumb' + id_vertex).attr('src'));
        $('#node').val(rows[0][7]).change();
    });
}