$(function(){
    $('#add-supplier').validate({
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