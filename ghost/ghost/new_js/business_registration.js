$("#f1").show();
$("#f2").hide();
$("#f3").hide();

$("#next1").click(function(){
    if($("#frm").valid())
    {
        $("#f1").hide();
        $("#f2").show();
        $("#f3").hide();
        $("#pg1").css("width", "20%");
        $("#pg1").text("20%");
    }
});

$("#next2").click(function(){
    if($("#frm").valid())
    {
        $("#f1").hide();
        $("#f2").hide();
        $("#f3").show();
        $("#pg1").css("width", "50%");
        $("#pg1").text("50%");
    }
})

$("#prev1").click(function(){
    $("#f1").show();
    $("#f2").hide();
    $("#f3").hide();
    $("#pg1").css("width", "0%");
    $("#pg1").text("");
});

$("#prev2").click(function(){
    $("#f1").hide();
    $("#f2").show();
    $("#f3").hide();
    $("#pg1").css("width", "20%");
    $("#pg1").text("20%");
});

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
      },
      "busName":
      {
        required : true,
      },
      "gstin":
      {
        required : true,
        pattern : "^[0-9]{2}[A-Z]{5}[0-9]{4}[A-Z]{1}[1-9A-Z]{1}Z[0-9A-Z]{1}$",
      },
      "pincode":
      {
            required:true,
            minlength:6,
            maxlength:6,
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
            required:"<span class='text-danger' style='font-size:small' hidden>Please check the terms and condition.</span>",
        },
        "busName":
        {
            required : "<span class='text-danger' style='font-size:small'>Please enter business name.</span>",
        },
        "gstin" : 
        {
            required : "<span class='text-danger' style='font-size:small'>Please enter GST Number.</span>",
            pattern : "<span class='text-danger' style='font-size:small'>Please enter valid GST Number.</span>",
        },
        "pincode":
        {
            required:"<span class='text-danger' style='font-size:small'>Please enter your pincode</span>",
            minlength : "<span class='text-danger' style='font-size:small'>Please enter only 6 digit in your pincode no</span>",
            maxlength : "<span class='text-danger' style='font-size:small'>Please enter only 6 digit in your pincode no</span>",
        }
    },
    highlight: function(element) {
        if(element.type == "password")
        {
            if(!flag)
            {
                $("#inpt").after("<span id='paserr' class='text-danger' style='font-size:small;font-weight:bolder;'>Password should atleast contain 5 characters with one small, one capital, one special character, one digit in password</span>");
                flag = true;
            }
        }
            if(element.type == "checkbox")
            {
                if(!chckflag)
                {
                    $("#chk").after("<div id='chker' class='text-danger' style='font-size:small;font-weight:bold;'>*Please read all details carefully and then select here.</div>");
                    flag = true;
                }
            }

        if(element.type == "radio")
        {
            if(!radioflag)
            {
                $(".temp").after("<span id='radioer' class='text-danger' style='font-size:small;font-weight:bolder'>Please select one of these option</span>");
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

$(".purchasenow").click(function(){
    const json = {};
    var formdata = $("#frm").serializeArray();

    

    json.duration = $(this).attr("data-duration");
    json.planid = $(this).attr("data-id");
    json.pprice = $(this).attr("data-price");

    $.each(formdata, function(){
        json[this.name] = this.value;
    });

    $.ajax({
        type : "POST",
        method : "POST",
        data : json,
        dataType : "JSON",
        url : "crud.php?what=checkfornewbusiness",
        success : function(response)
        {
            if(response["success"])
            {
                var options = {
                    "key": "rzp_test_mObd3U81dn4dzH",
                    "amount": Math.round(json.pprice * 100), // Example: 2000 paise = INR 20
                    "name": "Ghost Marketer",
                    "description": $(this).attr("data-desc"),
                    "image": "image/logo.png",// COMPANY LOGO
                    "handler": function (response) {
                        $.ajax({
                          type : "POST",
                          method : "POST",
                          data : json,
                          dataType : "JSON",
                          url : "crud.php?what=registernewbusiness",
                          success : function(response){
                            window.scrollTo({top: 0, behavior: 'smooth'});
                            if(response["success"])
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
                                window.location.replace("bussiness_login.php");
                              },2500);
                            }
                            else
                            {
                              $.bootstrapGrowl("<div class='text-center' style='background-color:#FF3232;opacity:1;font-weight:bold'><h1>Error!</h1><p>"+ response["message"] +"</p></div>",{
                                // type : "danger",
                                delay : 2500,
                                align : "center",
                                width : 400,
                                allow_dismiss : false,
                              });
                            }
                          }
                        });
                        // AFTER TRANSACTION IS COMPLETE YOU WILL GET THE RESPONSE HERE.
                    },
                    "prefill": {
                      "name": $("#txtName").val(), // pass customer name
                      "email": $("#txtMail").val(),// customer email
                      "contact": $("#txtPhone").val() //customer phone no.
                     },
                    "theme": {
                        "color": "#15b8f3" // screen color
                    }
                  };
                  console.log(options);
                  var propay = new Razorpay(options);
                  propay.on("payment.failed", function(response){
                    //alert(response.error.description);
                    $.bootstrapGrowl("<div class='text-center' style='background-color:#FF3232;opacity:1;font-weight:bold'><h1>Error!</h1><p>"+ response.error.description +"</p></div>",{
                        // type : "danger",
                        delay : 2500,
                        align : "center",
                        width : 400,
                        allow_dismiss : false,
                    })
                  });
                  propay.open(); 
            }
            else
            {
                window.scrollTo({"top" : 0, "behavior" : "smooth"});
                $.bootstrapGrowl("<div class='text-center' style='background-color:#FF3232;opacity:1;font-weight:bold'><h1>Error!</h1><p>"+ response['message'] +"</p></div>",{
                    // type : "warning",
                    delay : 2500,
                    align : "center",
                    width : 400,
                    allow_dismiss : false,
                });
            }
        }
    });

     
})