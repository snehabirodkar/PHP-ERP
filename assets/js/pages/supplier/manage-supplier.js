var TableDatatables = function(){
    var handleSupplierTable = function(){
        var manageSupplierTable = $("#manage-supplier-table");
        var baseURL = window.location.origin;
        var filePath = "/helper/routing.php";
        manageSupplierTable.dataTable({
            "processing":true,
            "serverSide":true,
            "ajax":{
                url:baseURL+filePath,//base url ka constant use nahi kr sakte
                type:"POST",//default get hai abh post likha
                data:{
                    "page": "manage_supplier"
                }
            },
            "lengthMenu":[
                [5,15,25,-1],
                [5,15,25,"All"]
            ],
            "order":[
                [1,"desc"]
            ],
            "columnDefs":[
                {
                    'orderable':false,
                    'targets':[0,-1]
                }
            ]
        });
       manageSupplierTable.on('click','.edit', function(e){
                                        
            var id = $(this).data('id');
            // console.log($(this).data('id'));
            $("#edit_supplier_id").val(id);
            //Fetching all other values from the database `using AJAX ombimand loading them onto thier respective fields in the modal.
            $.ajax({
                url:baseURL+filePath,
                method:"POST",
                data:{
                    "supplier_id":id,
                    "fetch":"supplier"
                },
                dataType:"json",
                success:function(data){
                    // alert("hello");
                   
                        var form = document.createElement('form');
                        document.body.appendChild(form);
                        form.method = 'post';
                        form.action = './edit-supplier.php';
                        for (var name in data) {
                            var input = document.createElement('input');
                            input.type = 'hidden';
                            input.name = name;
                            input.value = data[name];
                            form.appendChild(input);
                        }
                        form.submit();
                }           
            })
        });
        manageSupplierTable.on('click','.delete',function(e){
            // alert("hey");
            var id = $(this).data('id');
            $("#delete_record_id").val(id);
        }); 

       
    }
    return{
        //main function to handle all the datatables

        init: function(){
            handleSupplierTable();
        }
    }
}();//iifee hai ye

jQuery(document).ready(function(){
    TableDatatables.init();
});

//Jabhi classes nahi the tabhi fun ke andar fun banate the