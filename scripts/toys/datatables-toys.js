var TableDatatablesButtons = function () {

    var initToyTable = function () {
        var table = $('#sample_1');

        var oTable = table.dataTable({
            "language": {
                "aria": {
                    "sortAscending": ": activate to sort column ascending",
                    "sortDescending": ": activate to sort column descending"
                },
                "emptyTable": "No data available in table",
                "info": "Showing _START_ to _END_ of _TOTAL_ entries",
                "infoEmpty": "No entries found",
                "infoFiltered": "(filtered1 from _MAX_ total entries)",
                "lengthMenu": "_MENU_ entries",
                "search": "Search:",
                "zeroRecords": "No matching records found"
            },


            responsive: true,

            "order": [
                [0, 'asc']
            ],

            "lengthMenu": [
                [5, 10, 15, 20, -1],
                [5, 10, 15, 20, "All"]
            ],

            "pageLength": 10,
            "pagingType": "bootstrap_full_number",
            "columnDefs": [
                { "orderable": false, "targets": 17 },
                { "searchable": false, "targets": 17 },
                { "responsivePriority": 1, "targets": [1, 16, 17] },
                { "visible": false, "targets": [7, 8, 9, 10, 11, 12, 13, 14, 15] },
                { "className": "none", "targets": 6 },
                { render: function (data, type, row) {
                    if(type === 'export'){
                        if(/[\u200A]/g.test(data)){ return 'Yes'; }
                        else { return 'No'; }
                    } else { return data; }
                  },
                   "targets": [7, 8, 9 , 10, 11, 12, 13, 14, 15]
                }
            ]
        });

        $('#sample_1_tools > li > a.tool-action').on('click', function() {
            var action = $(this).attr('data-action');
            oTable.DataTable().button(action).trigger();
        });
    }

    return {
        init: function () {

            if (!jQuery().dataTable) {
                return;
            }
            initToyTable();
        }
    };

}();

jQuery(document).ready(function() {
    TableDatatablesButtons.init();
});
