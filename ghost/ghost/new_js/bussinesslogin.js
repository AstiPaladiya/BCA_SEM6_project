var otp;
var mrk_otp;
$("#frm").validate({
    rules:{
        "txtMail":{
            required:true,
            email:true,
        },
        "txtPwd":{
            required:true,
        }
    },
    messages:{
        "txtMail":
        {
            required:"<span class='text-danger' style='font-size:small'>Please enter your email address</span>",
            email: "<span class='text-danger' style='font-size:small'>Your email address must be in the format of name@domain.com</span>",
        },
        "txtPwd":{
            required:"<span class='text-danger' style='font-size:small'>Please fill your Password</span>",
        }

    },
});
$("#anchorforget").click(function(){
    //classes hiding
    $(".chckuname").show();
    $(".otp").hide();
    $(".newpas").hide();

    //button hiding
    $("#verifyotp").hide();
    $("#setnewpas").hide();
    $("#sendotp").removeAttr("disabled");
    $("#sendotp").show();

    //empting the values
    $("#frg_uname").val("");
    $("#otp").val("");
    $("#newpas").val("");
    $("#conpas").val("");
});

$("#verifyotp").click(function(){
    if(otp != $("#otp").val())
    {
        $.bootstrapGrowl("<div class='text-center' style='background-color:#FF3232; opacity:1;font-weight:bold;'><h1>Warning!</h1><p>Please enter correct otp</p></div>", {
            delay : 2500,
            allow_dismiss : false,
            width : 400,
            align : "center",
        })
    }
    else
    {
        $.bootstrapGrowl("<div class='text-center' style='background-color:#1eff1e;opacity:1;font-weight:bold'><h1>Success!</h1><p>OTP matched successfully.</p></div>",{
            // type : "success",
            delay : 2500,
            allow_dismiss : false,
            width : 400,
            align : "center",
        });

        $(".otp").hide();
        $(".newpas").show();

        $("#verifyotp").hide();
        $("#setnewpas").show();
    }
})

$("#setnewpas").click(function(){
    if($("#newpas").val() == "" || $("#newpas").val() == null || $("#conpas").val() == "" || $("#conpas").val() == null)
    {
        $.bootstrapGrowl("<div class='text-center' style='background-color:#FF3232;opacity:1;font-weight:bold'><h1>Error!</h1><p>Any field cannot be empty.</p></div>",{
            // type : "danger",
            delay : 2500,
            allow_dismiss : false,
            width : 400,
            align : "center",
        });
    }
    else if($("#newpas").val() != $("#conpas").val())
    {
        $.bootstrapGrowl("<div class='text-center' style='background-color:#FF3232;opacity:1;font-weight:bold'><h1>Error!</h1><p>Password and Confirm Password should be same.</p></div>",{
            // type : "danger",
            delay : 2500,
            allow_dismiss : false,
            width : 400,
            align : "center",
        });
    }
    else
    {
        $(this).attr("disabled", "disabled");
        const json = {"newpas" : $("#newpas").val(), "email" : $("#frg_uname").val()};

        $.ajax({
            type : "POST",
            method : "POST",
            data : json,
            dataType : "JSON",
            url : "crud.php?what=frgbuspas",
            success : function(response){
                if(response.success)
                {
                    $.bootstrapGrowl("<div class='text-center' style='background-color:#1eff1e;opacity:1;font-weight:bold'><h1>Success!</h1><p>"+ response.message +"</p></div>",{
                        // type : "success",
                        delay : 2500,
                        allow_dismiss : false,
                        width : 400,
                        align : "center",
                    });
                }
                else
                {
                    $.bootstrapGrowl("<div class='text-center' style='background-color:#FF3232;opacity:1;font-weight:bold'><h1>Error!</h1><p>Please enter registered email id.</p></div>",{
                        // type : "warning",
                        delay : 2500,
                        allow_dismiss : false,
                        width : 400,
                        align : "center",
                    })
                }
                setTimeout(() => {
                    window.location.replace("bussiness_login.php");
                }, 2500);
            }
        })
    }
})
$("#sendotp").click(function(event){

    if($("#frg_uname").val() == "" || $("#frg_uname").val() == null)
    {
        $.bootstrapGrowl("<div class='text-center' style='background-color:#FF3232;opacity:1;font-weight:bold'><h1>Error!</h1><p>Please enter registered email id.</p></div>",{
            // type : "warning",
            delay : 2500,
            allow_dismiss : false,
            width : 400,
            align : "center",
        })
    }
    else
    {
        $(this).attr("disabled", "disabled");
        const json = {"email" : $("#frg_uname").val()};

        $.ajax({
            type : "POST",
            method : "POST",
            data : json,
            dataType : "JSON",
            url : "crud.php?what=sendbusotp",
            success : function(response){
                $("#sendotp").removeAttr("disabled");
                if(response.success)
                {
                    otp = response.otp;
                    $.bootstrapGrowl("<div class='text-center' style='background-color:#1eff1e;opacity:1;font-weight:bold'><h1>Success!</h1><p>"+ response.message +"</p></div>",{
                        // type : "success",
                        delay : 2500,
                        allow_dismiss : false,
                        width : 400,
                        align : "center",
                    });

                    $(".chckuname").hide();
                    $(".otp").show();
                    $("#sendotp").hide();
                    $("#verifyotp").show();
                }
                else
                {
                    $.bootstrapGrowl("<div class='text-center' style='background-color:#FF3232;opacity:1;font-weight:bold'><h1>Error!</h1><p>"+ response.message +"</p></div>",{
                        // type : "danger",
                        delay : 2500,
                        allow_dismiss : false,
                        width : 400,
                        align : "center",
                    });
                }
            }
        })
    }
})
// Password eye icon
// $("#btnEye").click(
//     function()
//     {
//             var pass=$("#txtPwd");
//             if(pass.attr('type')==='password')
//             {
//                 pass.attr('type','text');
//                 $("i").addClass("fas fa-eye-slash");
//             }
//             else
//             {
//                 pass.attr('type','password');
//                 $("i").removeClass("fas fa-eye-slash");
               
//             }
//     });
    $("#txtSubmit").click(function(event)
    {
        if($("#frm").valid())
        {
            event.preventDefault();
            const json={"mail":$("#txtMail").val(),"pass":$("#txtPwd").val()};
          //console.log(json);
             
           $.ajax({
            type:"POST",
            method:"POST",
            url:"crud.php?what=chkBussinessUser",
            data:json,
            dataType:"JSON",
            success:function(response)
            {
                console.log(response);
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
                                window.location.replace('business/index.php');
                            },2500);
                         }
                        else
                        {
                            if(response["plan"] == true)
                            {
                                $.bootstrapGrowl("<div class='text-center' style='background-color:#FCA510;opacity:1;font-weight:bold'><h1>Error!</h1><p>"+response['message']+"</p></div>",
                                {
                                    delay : 2500,
                                    width : 400,
                                    offset : {"from" : "top", "amount" : 20},
                                    allow_dismiss : false,
                                    align : "center",
                                });

                                setTimeout(function(){
                                    window.location.replace('business/index.php');
                                },2500);
                            }
                            else
                            {
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
            }
        });
     }
});

$("#txtSubmitMarketer").click(
    function(event)
    {
         if($("#frm").valid())
         {
             event.preventDefault();

         const json={"mail":$("#txtMail").val(),"password":$("#txtPwd").val()};
         console.log(json);

         $.ajax({
            type:"POST",
            method:"POST",
            url:"crud.php?what=chkMarketerUser",
            data:json,
            dataType:"JSON",
            success:function(response)
            {
                console.log(response);
         
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
                        window.location.replace('marketer/index.php');
                    },2500);
                }
                else
                {
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
});


// Marketer Forgot Password code
$("#marketerFrgPass").click(function(){
    $("#mrk_email").show();
    $("#mrk_email").val("");

    $("#mrk_otp").hide();
    $("#mrk_otp").val("");

    $("#mrk_newpass").hide();
    $("#mrk_newpass").val("");

    $("#mrk_conpass").hide();
    $("#mrk_conpass").val("");

    $("#mrk_sned").show();
    $("#mrk_verify").hide();
    $("#mrk_setnew").hide();

    $(".chckuname").show();
    $(".otp, .newpas").hide();
});

$("#mrk_sned").click(function(){
    var offset;
    if($(window).width() < 449)
    {
        offset = 20;
    }
    else
    {
        offset = 100;
    }
    if($("#mrk_email").val() == "" || $("#mrk_email").val() == null)
    {
        $.bootstrapGrowl("<div class='text-center' style='background-color:#FF3232;opacity:1;font-weight:bold'><h1>Error!</h1><p>Please enter registered email id.</p></div>",{
            offset: {from: 'top', amount: offset}, 
            delay : 2500,
            allow_dismiss : false,
            width : 400,
            align : "center",
        })
    }
    else
    {
        $(this).attr("disabled", "disabled");
        const json = {"email" : $("#mrk_email").val()};

        $.ajax({
            type : "POST",
            method : "POST",
            data : json,
            dataType : "JSON",
            url : "crud.php?what=markOtp",
            success : function(response){
                console.log(response);
                $("#mrk_sned").removeAttr("disabled");
                if(response.success)
                {
                    mrk_otp = response.otp;
                    $.bootstrapGrowl("<div class='text-center' style='background-color:#1eff1e;opacity:1;font-weight:bold;'><h1>Success!</h1><p>"+ response.message +"</p></div>", {
                        delay : 2500,
                        allow_dismiss : false,
                        width : 400,
                        align : "center",
                        offset: {from: 'top', amount: offset}, 
                    })
                    
                    $("#mrk_email").hide();
                    // $("#mrk_email").val("");

                    $("#mrk_otp").show();
                    $("#mrk_otp").val("");

                    $("#mrk_newpass").hide();
                    $("#mrk_newpass").val("");

                    $("#mrk_conpass").hide();
                    $("#mrk_conpass").val("");

                    $("#mrk_sned").hide();
                    $("#mrk_verify").show();
                    $("#mrk_setnew").hide();

                    $(".otp").show();
                    $(".chckuname, .newpas").hide();
                }
                else
                {
                    $.bootstrapGrowl("<div class='text-center' style='background-color:#FF3232; opacity:1;font-weight:bold;'><h1>Error!</h1><p>"+ response.message +"</p></div>", {
                        delay : 2500,
                        allow_dismiss : false,
                        width : 400,
                        align : "center",
                        offset: {from: 'top', amount: offset}, 
                    })
                }
            }
        })
    }
});

$("#mrk_verify").click(function(){
    var offset;
    if($(window).width() < 449)
    {
        offset = 20;
    }
    else
    {
        offset = 100;
    }
    if(mrk_otp != $("#mrk_otp").val())
    {
        // $.bootstrapGrowl("<div class='text-center' style='background-color:#FF3232; opacity:1;font-weight:bold;'><h1>Warning!</h1><p>Please enter correct otp</p></div>", {
        //     delay : 2500,
        //     allow_dismiss : false,
        //     width : 400,
        //     align : "center",
        // })
        $.bootstrapGrowl("<div class='text-center' style='background-color:#FF3232; opacity:1;font-weight:bold;'><h1>Error!</h1><p>Please enter correct OTP</p></div>", {
            delay : 2500,
            allow_dismiss : false,
            width : 400,
            align : "center",
            offset: {from: 'top', amount: offset}, 
        })
        
    }
    else
    {
        $.bootstrapGrowl("<div class='text-center' style='background-color:#1eff1e;opacity:1;font-weight:bold'><h1>Success!</h1><p>OTP matched successfully.</p></div>",{
            delay : 2500,
            allow_dismiss : false,
            width : 400,
            align : "center",
            offset: {from: 'top', amount: offset}, 
        });

        $("#mrk_email").hide();
        // $("#mrk_email").val("");

        $("#mrk_otp").hide();
        $("#mrk_otp").val("");

        $("#mrk_newpass").show();
        $("#mrk_newpass").val("");

        $("#mrk_conpass").show();
        $("#mrk_conpass").val("");

        $("#mrk_sned").hide();
        $("#mrk_verify").hide();
        $("#mrk_setnew").show();

        $(".newpas").show();
        $(".chckuname, .otp").hide();
    }
});

$("#mrk_setnew").click(function(){
    var offset;
    if($(window).width() < 449)
    {
        offset = 20;
    }
    else
    {
        offset = 100;
    }
    if($("#mrk_newpass").val() == "" || $("#mrk_newpass").val() == null || $("#mrk_conpass").val() == "" || $("#mrk_conpass").val() == null)
    {
        $.bootstrapGrowl("<div class='text-center' style='background-color:#FF3232;opacity:1;font-weight:bold'><h1>Error!</h1><p>Any field cannot be empty.</p></div>",{
            offset: {from: 'top', amount: offset}, 
            delay : 2500,
            allow_dismiss : false,
            width : 400,
            align : "center",
        });
    }
    else if($("#mrk_newpass").val() != $("#mrk_conpass").val())
    {
        $.bootstrapGrowl("<div class='text-center' style='background-color:#FF3232;opacity:1;font-weight:bold'><h1>Error!</h1><p>Password and Confirm Password should be same.</p></div>",{
            offset: {from: 'top', amount: offset}, 
            delay : 2500,
            allow_dismiss : false,
            width : 400,
            align : "center",
        });
    }
    else
    {
        $(this).attr("disabled", "disabled");
        const json = {"newpas" : $("#mrk_newpass").val(), "email" : $("#mrk_email").val()};

        $.ajax({
            type : "POST",
            method : "POST",
            data : json,
            dataType : "JSON",
            url : "crud.php?what=resetPassMark",
            success : function(response){
                if(response.success)
                {
                    $.bootstrapGrowl("<div class='text-center' style='background-color:#1eff1e;opacity:1;font-weight:bold'><h1>Success!</h1><p>"+ response.message +"</p></div>",{
                        offset: {from: 'top', amount: offset}, 
                        delay : 2500,
                        allow_dismiss : false,
                        width : 400,
                        align : "center",
                    });
                }
                else
                {
                    $.bootstrapGrowl("<div class='text-center' style='background-color:#FF3232;opacity:1;font-weight:bold'><h1>Error!</h1><p>Please enter registered email id.</p></div>",{
                        offset: {from: 'top', amount: offset}, 
                        delay : 2500,
                        allow_dismiss : false,
                        width : 400,
                        align : "center",
                    })
                }
                setTimeout(() => {
                    window.location.replace("bussiness_login.php");
                }, 2500);
            }
        })
    }
})