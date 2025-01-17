var otp;
$("#frg_pass").click(function(){
    $("#myModal").modal('show');

    $(".otp").hide();

    $(".pas").hide();

    $("#verifyotp").hide();

    $("#changepas").hide();

    $("#email").val("");
    $("#otp").val("");
    $("#pas").val("");
    $("#conpas").val("");

    $("#email").removeAttr("readonly");
    $("#sendotp").show();
    $("#sendotp").removeAttr("disabled");
});

$("#sendotp").click(function(event){
    event.preventDefault();

    $(this).attr("disabled", "disabled");

    $("#email").attr("readonly", "readonly");

    const json = {"email" : $("#email").val()};

    //console.log(json);

    $.ajax({
        type : "POST",
        method : "POST",
        data : json,
        dataType : "JSON",
        url : "../crud.php?what=checkemail",
        success : function(response){
            if(response["success"])
            {
                $.bootstrapGrowl("<div class='text-center' style='background-color:#1eff1e;opacity:1;font-weight:bold'><h1>Success!</h1><p>"+ response['message'] +"</p></div>",{
                    // type : "success",
                    delay : 2500,
                    align : "center",
                    allow_dismiss : false,
                    align : "center",
                    width : 400,
                });

                otp = response["otp"];
                $(".otp").show();
                $("#verifyotp").show();
                $("#sendotp").hide();
            }
            else
            {
                $.bootstrapGrowl("<div class='text-center' style='background-color:#FF3232;opacity:1;font-weight:bold'><h1>Error!</h1><p>"+ response['message'] +"</p></div>",{
                    // type : "danger",
                    delay : 2500,
                    align : "center",
                    allow_dismiss : false,
                    align : "center",
                    width : 400,
                });

                $("#sendotp").removeAttr("disabled");

                $("#email").removeAttr("readonly");
            }
        }
    });
});

$("#verifyotp").click(function(event){
    event.preventDefault();

    if($("#otp").val() != otp)
    {
        $.bootstrapGrowl("<div class='text-center' style='background-color:#FF3232;opacity:1;font-weight:bold'><h1>Error!</h1><p>OTP entered was not correct</p></div>",{
            // type : "danger",
            delay : 2500,
            allow_dismiss : false,
            align : "center",
            width : 400,
        });
    }
    else
    {
        $.bootstrapGrowl("<div class='text-center' style='background-color:#1eff1e;opacity:1;font-weight:bold'><h1>Success!</h1><p>OTP Verified</p></div>",{
            // type : "success",
            delay : 2500,
            allow_dismiss : false,
            align : "center",
            width : 400,
        });

        $(".otp").hide();
        $(".pas").show();
        $("#verifyotp").hide();
        $("#changepas").show();
    }
});

$("#changepas").click(function(event){
    event.preventDefault();

    if($("#pas").val() == "" || $("#pas").val() == null)
    {
        $.bootstrapGrowl("<div class='text-center' style='background-color:#FF3232;opacity:1;font-weight:bold'><h1>Error!</h1><p>Please enter new password</p></div>",{
            delay : 2500,
            allow_dismiss : false,
            // type : "warning",
            width : 400,
            align : "center"
        });
    }
    else if($("#conpas").val() == "" || $("#conpas").val() == null)
    {
        $.bootstrapGrowl("<div class='text-center' style='background-color:#FF3232;opacity:1;font-weight:bold'><h1>Error!</h1><p>Please enter confirm password</p></div>",{
            delay : 2500,
            allow_dismiss : false,
            // type : "warning",
            width : 400,
            align : "center"
        });
    }
    else if($("#pas").val() != $("#conpas").val())
    {
        $.bootstrapGrowl("<div class='text-center' style='background-color:#1eff1e;opacity:1;font-weight:bold'><h1>Success!</h1><p>Password and Confirm Password should be same</p></div>",{
            delay : 2500,
            allow_dismiss : false,
            // type : "warning",
            width : 400,
            align : "center"
        });
    }
    else
    {
        const json = {"password" : $("#pas").val(), "email" : $("#email").val()};

        $.ajax({
            type : "POST",
            method : "POST",
            data : json,
            dataType : "JSON",
            url : "../crud.php?what=changeadminpassword",
            success : function(response){
                if(response['success'])
                {
                    $.bootstrapGrowl("<div class='text-center' style='background-color:#1eff1e;opacity:1;font-weight:bold'><h1>Success!</h1><p>"+ response['message'] +"</p></div>",{
                        delay : 2500,
                        allow_dismiss : false,
                        // type : "success",
                        width : 400,
                        align : "center"
                    });
                }
                else
                {
                    $.bootstrapGrowl("<div class='text-center' style='background-color:#FF3232;opacity:1;font-weight:bold'><h1>Error!</h1><p>"+ response['message'] +"</p></div>",{
                        delay : 2500,
                        allow_dismiss : false,
                        // type : "danger",
                        width : 400,
                        align : "center"
                    });
                }

                $("#myModal").modal('hide');
            }
        });
    }
});