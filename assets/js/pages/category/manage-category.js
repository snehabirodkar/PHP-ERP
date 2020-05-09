var TableDatatables = function() {
    var handleCategoryTable = function() {
        var manageCategoryTable = $("#manage-category-table");
        var baseURL = window.location.origin;
        var filePath = "/helper/routing.php";
        var oTable = manageCategoryTable.DataTable({
            "processing": true,
            "serverSide": true,
            "ajax": {
                url: baseURL + filePath, //base url ka constant use nahi kr sakte
                type: "POST", //default get hai abh post likha
                data: {
                    "page": "manage_category"
                }
            },
            "lengthMenu": [
                [5, 15, 25, -1],
                [5, 15, 25, "All"]
            ],
            "order": [
                [1, "desc"]
            ],
            "columnDefs": [{
                'orderable': false,
                'targets': [0, -1]
            }]
        });
        new $.fn.dataTable.Buttons(oTable, {
            buttons: [
                'copy', 'csv', 'pdf'
            ]
        });
        oTable.buttons().container().appendTo($('#export-buttons'));
    }
    return {

        //main function to handle all the datatables

        init: function() {
            handleCategoryTable();
        }
    }
}(); //iifee hai ye

jQuery(document).ready(function() {
    TableDatatables.init();
});

//Jabhi classes nahi the tabhi fun ke andar fun banate the