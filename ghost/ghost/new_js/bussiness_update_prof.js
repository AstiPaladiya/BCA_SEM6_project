var flag = false;
// var pin=false;
var radioflag = false;
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
        "txtState":
        {
                required:true,
        },
        "txtCity":
        {
                required:true,
        },
        "chk":
        {
            required:true,
        },
        "txtBus":
        {
          required : true,
        },
        "txtGst":
        {
          required : true,
          pattern : "^[0-9]{2}[A-Z]{5}[0-9]{4}[A-Z]{1}[1-9A-Z]{1}Z[0-9A-Z]{1}$",
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
            required:"<div class='text-danger'  style='font-size:small'>Please enter your password</div>",
            minlength:"<span class='text-danger' style='font-size:small'>Please enter minimum 5 charchater in your name</span>",
            pattern:"<span class='text-danger' style='font-size:small' >Please enter atleast one small and capital alphabat charchter, one special keyword and one digit with minimum range of 5</span>",
        },
        "txtCon":
        {
            required:"<span class='text-danger'  style='font-size:small'>Please enter your confrim password</span>",
            equalTo:"<span class='text-danger' style='font-size:small'>Password does not match</span>",
        },
        "txtPhone":
        {
            required:"<span class='text-danger' style='font-size:small'>Please enter your Phone no</span>",
            minlength:"<span class='text-danger' style='font-size:small'>Please enter only 10 digit in your phone no</span>",
            maxlength:"<span class='text-danger' style='font-size:small'>Please enter only 10 digit in your phone no</span>",

        },
        "pincode":
        {
            required:"<span class='text-danger' style='font-size:small'>Please enter your Pincode No</span>",
            minlength : "<span class='text-danger' style='font-size:small'>Please enter only 6 digit in your pincode no</span>",
            maxlength : "<span class='text-danger' style='font-size:small'>Please enter only 6 digit in your pincode no</span>",

        },
        "rdGender":
        {
            required:"<span class='text-danger' style='font-size:small' hidden>Please select one of these option</span>",
        },
        "txtBus":
        {
            required : "<span class='text-danger' style='font-size:small'>Please enter business name</span>",
        },
        "txtGst" : 
        {
            required : "<span class='text-danger' style='font-size:small'>Please enter GST Number</span>",
            pattern : "<span class='text-danger' style='font-size:small'>Please enter valid GST Number</span>",
        },
        "txtState":
        {
            required:"<span class='text-danger' style='font-size:small'>Please enter your state</span>",
        },
        "txtCity":
        {
            required:"<span class='text-danger' style='font-size:small'>Please enter your city</span>",
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
        // if(element.type == "number")
        // {
        //     if(!pin)
        //     {
        //         $("#inpt").after("<span id='pincoder' class='text-danger' style='font-size:small;'>Please enter your pincode no</span>");
        //         flag = true;
        //     }
        // }
        if(element.type == "radio")
        {
            if(!radioflag)
            {
                $(".temp").after("<span id='radioer' class='text-danger' style='font-size:small'>Please select one of these option</span>");
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
$("#button3").click(
    function(event)
    {
        // $("#frm").validate();
        // $("#secFrm").validate();
        // $("#thirdFrm").validate();
        if($("#frm").valid())
        {
            event.preventDefault();
            const json={};
            var formdata=$("#frm").serializeArray();

            $.each(formdata,function()
            {
                json[this.name]=this.value;
            });
            // console.log(json);
            $.ajax({
                type:"POST",
                method:"POST",
                url:"../crud.php?what=busUpdateDetail",
                data:json,
                dataType:"JSON",
                success:function(response)
                {
                    if(response.success=true)
                    {
                        // console.log(response);
                        window.location.reload();
                    }
                   
                }
            });
        }
    }
);
$("#pincode").blur(function(){
    $("#txtState").val("");
    $("#txtCity").val("");
    $.ajax({
        url : "https://api.postalpincode.in/pincode/" + $(this).val(),
        success : function(response)
        {
            $("#txtState").val(response[0].PostOffice[0].State);
            $("#txtCity").val(response[0].PostOffice[0].District);
        },
        error : function(response)
        {alert(response);}
    });
});
$("#btnImg").click(function(){
    $("#btnInpt").click();
});
$("#btnInpt").change(function(){
    if($("#btnInpt").val()!=null && $("#btnInpt").val() != "")
    {
        // var fileInpt = $("#btnInpt");
        var ofReader=new FileReader();
        ofReader.readAsDataURL($("#btnInpt")[0].files[0]);
        ofReader.onload=function(evt){
            $("#imgProfile").attr("src", evt.target.result);
        }
    }
});
$("#btnUpload").click(function(){
    if($("#btnInpt").val()!=null && $("#btnInpt").val() != "")
    {
        // const json = {"profile_img" : };
        var formData = new FormData();
        formData.append('file', $("#btnInpt")[0].files[0]);
        
        $.ajax({
            type : "POST",
            method : "POST",
            data : formData,
            cache:false,
            contentType:false,
            processData:false,
            enctype:'multipart/form-data',
            url : "../crud.php?what=changeBusProfile",
            success : function(response)
            {
                
                window.location.replace("update_profile.php");
                
            }
        });
    }
});