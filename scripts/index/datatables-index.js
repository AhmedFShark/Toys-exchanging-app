var TableDatatablesButtons = function () {

    var initCardTable = function () {
        var table = $('#example');

        var oTable = table.dataTable({
            "language": {
                "emptyTable": "No data available in table",
                "info": "Showing _START_ to _END_ of _TOTAL_ entries",
                "infoEmpty": "No entries found",
                "infoFiltered": "(filtered1 from _MAX_ total entries)",
                "lengthMenu": "_MENU_ entries",
                "search": "Search:",
                "zeroRecords": "No matching records found"
            },

            "lengthMenu": [
                [8, 16, 32, -1],
                [8, 16, 32, "All"]
            ],

            "columnDefs": [
                { "searchable": false, "targets": 0 },
                { "className": "dt-center", "targets": "_all"}
            ],

            'dom':
            "<'row'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-6'<'float-md-right ml-2'B>f>>" +
            "<'row'<'col-sm-12'tr>>" +
            "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",         
         
            'buttons': [ ],

            'drawCallback': function (settings) {
               var api = this.api();
               var $table = $(api.table().node());
               
               var labels = [];
               $('thead th', $table).each(function () {
                  labels.push($(this).text());
               });

               var max = 0;
               $('tbody tr', $table).each(function () {
                  max = Math.max($(this).height(), max);
               }).height(max);
            }
        });
    }

    return {
        init: function () {
            if (!jQuery().dataTable) {
                return;
            }
            initCardTable();
        }
    };
}();

jQuery(document).ready(function() {
    TableDatatablesButtons.init();
});