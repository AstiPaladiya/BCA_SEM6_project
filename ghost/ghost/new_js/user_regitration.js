var flag = false;
var radioflag = false;
var chckflag=false;
$("#frm").validate({
    rules:
    {
        "txtName":
        {
            required:true,
            minlength:3,
            pattern:"^[A-Za-z ]{3,}$",
      },
      "txtUser":
      {
           required:true,
           pattern:"^[A-Za-z0-9._@]+$",
      },
      "txtAdd":
      {
            required:true,
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
      },
      "txtPhone":
      {
            required:true,
            minlength:10,
            maxlength:10,
            pattern:"^[0-9]{10}$",
      },
      "rdGender":
      {
            required:true,
      },
      "pincode":
      {
            required:true,
            minlength:6,
            maxlength:6,
      },
      "state":
      {
            required:true,
      },
      "city":
      {
            required:true,
      },
      "chk":
      {
        required:true,
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
        "txtUser":
        {
            required:"<span class='text-danger'  style='font-size:small'>Please enter your username</span>",
            pattern:"<span class='text-danger'  style='font-size:small'>Please enter only A_Z,a-z,0-9,.and _ charachter in your username</span>",
        },
        "txtAdd":
        {
            required:"<span class='text-danger' style='font-size:small'>Please enter your address</span>",
        },
        "txtMail":
        {
            required:"<span class='text-danger' style='font-size:small'>Please enter your email address</span>",
            email: "<span class='text-danger' style='font-size:small'>Your email address must be in the format of name@domain.com</span>",
        },
        "txtPwd":
        {
            required:"<div class='text-danger'  style='font-size:small' hidden>Please enter your password</div>",
            minlength:"<span class='text-danger' style='font-size:small' hidden>Please enter minimum 5 charchater in your name</span>",
            pattern:"<span class='text-danger' style='font-size:small;' hidden>Please enter atleast one small and capital alphabat charchter, one special keyword and one digit with minimum range of 5</span>",
        },
        "txtCon":
        {
            required:"<span class='text-danger'  style='font-size:small'>Please enter your password</span>",
            equalTo:"<span class='text-danger' style='font-size:small'>Password does not match</span>",
        },
        "txtPhone":
        {
            required:"<span class='text-danger' style='font-size:small'>Please enter your Phone no</span>",
            minlength:"<span class='text-danger' style='font-size:small'>Please enter only 10 digit in your phone no</span>",
            maxlength:"<span class='text-danger' style='font-size:small'>Please enter only 10 digit in your phone no</span>",

        },
        "rdGender":
        {
            required:"<span class='text-danger' style='font-size:small' hidden>Please select one of these option</span>",
        },
        "pincode":
        {
            required:"<span class='text-danger' style='font-size:small'>Please enter your pincode</span>",
            minlength : "<span class='text-danger' style='font-size:small'>Please enter only 6 digit in your pincode no</span>",
            maxlength : "<span class='text-danger' style='font-size:small'>Please enter only 6 digit in your pincode no</span>",
        },
        
        "state":
        {
            required:"<span class='text-danger' style='font-size:small'>Please enter your state</span>",
        },
        "city":
        {
            required:"<span class='text-danger' style='font-size:small'>Please enter your city</span>",
        },
        "chk":
        {
            required:"<span class='text-danger' style='font-size:small' hidden>Please read all terms and coditions and  select this feild</span>",
        },

    },
    highlight: function(element) {
        if(element.type == "password")
        {
            if(!flag)
            {
                $("#inpt").after("<span id='paserr' class='text-danger' style='font-size:small;font-weight:bold'>Please enter atleast one small and capital alphabat charchter, one special keyword and one digit with minimum range of 5</span>");
                flag = true;
            }
        }
        if(element.type == "checkbox")
        {
            if(!chckflag)
            {
                $("#chker").html("*Please read all details carefully and then select here.");
                flag = true;
            }
        }

        if(element.type == "radio")
        {
            if(!radioflag)
            {
                $(".temp").after("<span id='radioer' class='text-danger' style='font-size:small;font-weight:bold'>Please select one of these option</span>");
                radioflag = true;
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
        if(element.type == "checkbox")
        {
            $("#chker").hide();
            flag = false;
        }
        if(element.type == "radio")
        {
            $("#radioer").hide();
            radioflag = false;
        }
        $(element).removeClass('is-invalid').addClass('is-valid');
    },
});
// Password eye icon
$("#btnEye").click(
function()
{
        var pass=$("#txtPwd");
        if(pass.attr('type')==='password')
        {
            pass.attr('type','text');
            $("i").addClass("fas fa-eye-slash");
        }
        else
        {
            pass.attr('type','password');
            $("i").removeClass("fas fa-eye-slash");
           
        }
});
// Retrive From data
$("#btnSubmit").click(
    function(event)
    {
        if($("#frm").valid())
        {
            event.preventDefault();
            
            const json={};
            var formdata=$("#frm").serializeArray();

            $.each(formdata,function()
            {
                json[this.name]=this.value;
            });
            //console.log(json);

            $.ajax({
                type:"POST",
                method:"POST",
                url:"crud.php?what=user_registration",
                data:json,
                dataType:"JSON",
                success:function(response)
                {
                    window.scrollTo({"top" : 0, "behavior" : "smooth"});
                    if(response["success"]==true)
                    {
                        $.bootstrapGrowl("<div class='text-center' style='background-color:#1eff1e;opacity:1;font-weight:bold'><h1>Success!</h1><p>"+response['message']+"</p></div>",
                        {
                            delay : 2500,
                            width : 400,
                            offset : {"from" : "top", "amount" : 20},
                            allow_dismiss : false,
                            align : "center",
                        }); 
                        setTimeout(function(){
                            window.location.replace('user_login.php');
                        },2500);

                    }
                    else
                    {
                        //style='background-color:#FF3232;opacity:0.6;font-weight:bold'
                        $.bootstrapGrowl("<div class='text-center' style='background-color:#FF3232;opacity:1;font-weight:bold'><h1>Error!</h1><p>"+response['message']+"</p></div>",
                        {
                            delay : 2500,
                            width : 400,
                            offset : {"from" : "top", "amount" : 20},
                            allow_dismiss : false,
                            align : "center",
                        }); 
                    }
                }
            });
        }
        // const json = {"name":$("#txtName").val(),"username":$("#txtUser").val(),"address":$("#txtAdd").val(),"mail":$("#txtMail").val(),"password":$("#txtPwd").val(),"phone":$("#txtPhone").val(),"gender":$("#rdGender").val(),"state":$("#txtState").val(),"city":$("#txtCity").val()};
        // console.log(json);
    });

$("#pincode").blur(function(){
    $("#state").val("");
    $("#city").val("");
    $.ajax({
        url : "https://api.postalpincode.in/pincode/" + $(this).val(),
        success : function(response)
        {
            $("#state").val(response[0].PostOffice[0].State);
            $("#city").val(response[0].PostOffice[0].District);
        },
        error : function(response)
        {alert(response);}
    });
});

    //selecting state from database code
// $("#txtState").on('change',function()
// {
//     var state_id=this.value;
//     const json={state_id:state_id};
//     $.ajax({
//             type:"POST",
//             method:"POST",
//             url:"crud.php?what=selectCity",
//             data:json,
//             dataType:"JSON",
//             Cache:false,
//             success:function(response)
//             {
//                 $("#txtCity").empty();
//                 $.each(response,function(key,value)
//                 {
//                     $("#txtCity").append(`<option value=${key}>${value}</option>`);
//                 });
//             }
//         })
// });
 