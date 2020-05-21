var TableDatatables = function(){
    var handleCustomerTable = function(){
        var manageCustomerTable = $("#manage-customer-table");
        var baseURL = window.location.origin;
        var filePath = "/helper/routing.php";
        var oTable = manageCustomerTable.dataTable({
            "processing":true,
            "serverSide":true,
            "ajax":{
                url:baseURL+filePath,//base url ka constant use nahi kr sakte
                type:"POST",//default get hai abh post likha
                data:{
                    "page": "manage_customer"
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
        var manFunc = manageCustomerTable.on('click','.edit', function(e){
                                        
            var id = $(this).data('id');
            // console.log($(this).data('id'));
            $("#edit_customer_id").val(id);
            //Fetching all other values from the database `using AJAX ombimand loading them onto thier respective fields in the modal.
            $.ajax({
                url:baseURL+filePath,
                method:"POST",
                data:{
                    "customer_id":id,
                    "fetch":"customer"
                },
                dataType:"json",
                success:function(data){
                   
                        var form = document.createElement('form');
                        document.body.appendChild(form);
                        form.method = 'post';
                        form.action = './edit-customer.php';
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
        manageCustomerTable.on('click','.delete',function(e){
        
            var id = $(this).data('id');
            $("#delete_record_id").val(id);
        }); 
      
        
    }
    return{
        //main function to handle all the datatables

        init: function(){
            handleCustomerTable();
        }
    }
}();//iifee hai ye

jQuery(document).ready(function(){
    TableDatatables.init();
});

//Jabhi classes nahi the tabhi fun ke andar fun banate the