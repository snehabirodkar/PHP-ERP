$(function(){
    $('#add-customer').validate({
        rules:{
         'name':{
                required:true
            }
        },
        submitHandler: function(form){
            form.submit();
        }
    })
});