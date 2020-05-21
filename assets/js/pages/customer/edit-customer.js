$(function(){
    $("#edit-customer").validate({
        rules: {
            
            'first_name' : {
                required : true,
                minlength : 3,
                maxlength : 50,
            },
            'last_name' :{
                required : true,
                minlength : 3,
                maxlength : 25,
            },
            'gst_no' :{
                required : true,
                minlength : 3,
                maxlength : 50,
            },
            'phone_no' :{
                required : true,
                minlength : 3,
                maxlength : 25,
            },
            'email_id' :{
                required : true,
                minlength : 3,
                maxlength : 25,
            },
            'gender' :{
                required : true,
                minlength : 3,
                maxlength : 255
            }
        },
        submitHandler: function (form){
            form.submit();
        }
    })
});