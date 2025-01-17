$("#cntfrm").validate({
    rules:
    {
        "txtName":
        {
            required:true,
            minlength:3,
            pattern:"^[A-Za-z ]{3,}$",
        },
        "txtMail":
        {
                required:true,
                email:true,
        },
        "txtNum":
        {
                required:true,
                minlength:10,
                maxlength:10,
                pattern:"^[0-9]{10}$",
        },
        "txtMsg":
        {
                required:true,
        },
    },
    messages:
    {
        "txtName":
        {
            required:"<span class='text-danger'  style='font-size:small'>Please enter your name</span>",
            minlength:"<span class='text-danger' style='font-size:small'>Please enter minimum 3 charchater in your name</span>",
            pattern:"<span class='text-danger' style='font-size:small'>Please enter only A-z or a-z charchter in your name</span>",
        },
        "txtMail":
        {
            required:"<span class='text-danger' style='font-size:small'>Please enter your email address</span>",
            email: "<span class='text-danger' style='font-size:small'>Your email address must be in the format of name@domain.com</span>",
        },
        "txtNum":
        {
            required:"<span class='text-danger' style='font-size:small'>Please enter your Phone no</span>",
            minlength:"<span class='text-danger' style='font-size:small'>Please enter only 10 digit in your phone no</span>",
            maxlength:"<span class='text-danger' style='font-size:small'>Please enter only 10 digit in your phone no</span>",

        },
        "txtMsg":
        {
            required:"<span class='text-danger' style='font-size:small'>Please enter your message</span>",
        }
    }        
});

$("#btnCnt").click(
function(event){
    if($("#cntfrm").valid())
    {
        event.preventDefault();

        const json={};
        var formdata=$("#cntfrm").serializeArray();

        $.each(formdata,function()
        {
            json[this.name]=this.value;
        });
        console.log(formdata);
        $.ajax({
            type:"POST",
            method:"POST",
            url:"../crud.php?what=contact",
            data:json,
            dataType:"JSON",
            success:function(response)
            {
                window.scrollTo({top: 0, behavior: 'smooth'});
                if(response.success=true)
                {
                    $.bootstrapGrowl("<div class='text-center' style='background-color:#1eff1e;opacity:1;font-weight:bold'><h1>Success!</h1><p>"+ response["message"] +"</p></div>",{
                    // type : "success",
                    delay : 2500,
                    align : "center",
                    width : 400,
                    allow_dismiss : false,
                    });

                    setTimeout(function(){
                    //set business login page here
                    window.location.replace("contact_us.php");
                    },2500);
                }
                else
                {
                    $.bootstrapGrowl("<div class='text-center'  style='background-color:#FF3232;opacity:1;font-weight:bold'><h1>Error!</h1><p>"+ response["message"] +"</p></div>",{
                    // type : "danger",
                    delay : 2500,
                    align : "center",
                    width : 400,
                    allow_dismiss : false,
                    });
                }
           
            }
        });
    }
});