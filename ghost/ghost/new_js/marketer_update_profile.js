var flag = false;
var pin=false;
var radioflag = false;
$("#markFrm").validate({
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
        "txtPwd":
        {
                required:true,
                minlength:5,
                pattern:"^.*(?=.{5,})(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z]).*$",
        },
        "txtCon":
        {
                required:true,
                equalTo:"#txtPwd",
        }
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
        "txtPwd":
        {
            required:"<div class='text-danger'  style='font-size:small'>Please enter your password</div>",
            minlength:"<span class='text-danger' style='font-size:small'>Please enter minimum 5 charchater in your name</span>",
            pattern:"<span class='text-danger' style='font-size:small' >Please enter atleast one small and capital alphabat charchter, one special keyword and one digit with minimum range of 5</span>",
        },
        "txtCon":
        {
            required:"<span class='text-danger'  style='font-size:small'>Please enter your confrim password</span>",
            equalTo:"<span class='text-danger' style='font-size:small'>Password does not match</span>",
        },
    },
    highlight: function(element) {
        if(element.type == "password")
        {
            if(!flag)
            {
                $("#inpt").after("<span id='paserr' class='text-danger' style='font-size:small;'>Please enter atleast one small and capital alphabat charchter, one special keyword and one digit with minimum range of 5</span>");
                flag = true;
            }
        }
        $(element).removeClass('is-valid').addClass('is-invalid');
    },
unhighlight: function (element)
{
   if(element.type == "password")
   {
       $("#paserr").hide();
       flag = false;
   }
   // if(element.type == "number")
   // {
   //     $("#pincoder").hide();
   //     flag = false;
   // }
   if(element.type == "radio")
   {
       $("#radioer").hide();
       radioflag = false;
   }
   $(element).removeClass('is-invalid').addClass('is-valid');
},
});
$("#btnSub").click(
    function(event)
    {
        // $("#frm").validate();
        // $("#secFrm").validate();
        // $("#thirdFrm").validate();
        if($("#markFrm").valid())
        {
            event.preventDefault();
            const json={};
            var formdata=$("#markFrm").serializeArray();

            $.each(formdata,function()
            {
                json[this.name]=this.value;
            });

            //  console.log(json);
            $.ajax({
                type:"POST",
                method:"POST",
                url:"../crud.php?what=markUpdateDetail",
                data:json,
                dataType:"JSON",
                success:function(response)
                {
                    if(response.success=true)
                    {
                        //  console.log(response);
                        window.location.reload();
                    }
                   
                }
            });
        }
    }
);
