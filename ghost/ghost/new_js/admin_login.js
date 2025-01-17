$("#frm").validate({
    rules:{
        "txtMail":{
            required:true,
            email:true,
        },
        "txtPwd":{
            required:true,
            minlength:6,
        }      
    },
    messages:{
        "txtMail":{
            required:"<span class='text-danger' style='font-size:small'>Please enter your email address</span>",
            email: "<span class='text-danger' style='font-size:small'>Your email address must be in the format of name@domain.com</span>",
        },
        "txtPwd":{
            required:"<span class='text-danger' style='font-size:small'>Please enter your Password</span>",
            minlength : "<span class='text-danger' style='font-size:small'>At least {6} character  required</span>",
        }
    },
   
});
$("#submit_login").click(function(event)
    {   
        //event.preventDefault();
        if($("#frm").valid())
        {
            event.preventDefault();
        }
        
        // var CurrentBtn = $(this);
        // $(this).attr("disabled", "disabled");
        const json = {"mail":$("#txtMail").val(),"pas":$("#txtPwd").val()};
         $.ajax({
            type:"POST",
            method:"POST",
            url:"../crud.php?what=checkloginsuper",
            data:json,
            dataType:"JSON",
            success:function(response)
            {
                if(response["success"]==true)
                {
                    $.bootstrapGrowl("<div class='text-center'  style='background-color:#1eff1e;opacity:1;font-weight:bold' ><h1>Success!</h1><p>"+ response["message"] +"</p></div>",{
                        delay : 2500,
                        width : 400,
                        offset : {"from" : "top", "amount" : 20},
                        allow_dismiss : false,
                        align : "center",
                    });
    
                    setTimeout(function(){
                        window.location.replace('index.php');
                    },2500);
                }
                else
                {
                    $.bootstrapGrowl("<div class='text-center' style='background-color:#FF3232;opacity:1;font-weight:bold'><h1>Error!</h1><p>"+ response["message"] +"</p></div>",{
                        delay : 2500,
                        width : 400,
                        offset : {"from" : "top", "amount" : 20},
                        allow_dismiss : false,
                        align : "center",
                    });
                }
            }
        });
        // $.ajax({
        //     type: "POST",
        //     method : "POST",
        //     url : "../crud.php?what=checkloginsuper",
        //     data : json,
        //     dataType : "JSON",
        //     success : function(response){
        //         console.log(response);
        //     }
        // });
    });
