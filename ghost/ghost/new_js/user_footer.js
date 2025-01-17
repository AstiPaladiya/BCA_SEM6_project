$(document).ready(function(){
    $("#emailError").hide();
    $("#feedBackError").hide();

    $("#emailId").blur(function(){
        if($("#emailId").val() == "" || $("#emailId").val() == null)
        {
            $("#emailError").show();
            $("#emailId").focus();
        }
        else
        {
            $("#emailError").hide();
        }
    });

    $("#feedBackTxt").blur(function(){
        if($("#feedBackTxt").val() == "" || $("#feedBackTxt").val() == null)
        {
            $("#feedBackError").show();
            $("#feedBackTxt").focus();
        }
        else
        {
            $("#feedBackError").hide();
        }
    })

    $("#sendFeedbackBtn").click(function(){
        var currBtn = $(this);
        if($("#emailId").val() == "" || $("#emailId").val() == null)
        {
            $("#emailError").show();
            $("#emailId").focus();
        }
        else if($("#feedBackTxt").val() == "" || $("#feedBackTxt").val() == null)
        {
            $("#feedBackError").show();
            $("#feedBackError").focus();
        }
        else
        {
            $("#emailError").hide();
            $("#feedBackError").hide();

            var formData = $("#feedBackForm").serializeArray();
            const json = {};

            $.each(formData, function(){
                json[this.name] = this.value;
            })

            // console.log(json);

            currBtn.attr("disabled", "disabled");
            $.ajax({
                type : "POST",
                method : "POST",
                data : json,
                dataType : "JSON",
                url : "../crud.php?what=sendFeedBack",
                success : function(response){
                    if(response.success)
                    {
                        window.scrollTo({"top" : 0, "behaviour" : "smooth"});

                        $.bootstrapGrowl("<div class='text-center' style='background-color:#1eff1e;opacity:1;font-weight:bold'><h1>Success!</h1><p>"+response['message']+"</p></div>",
                        {
                            delay : 2500,
                            width : 400,
                            offset : {"from" : "top", "amount" : 20},
                            allow_dismiss : false,
                            align : "center",
                        }); 
                        
                        $("#feedBackForm")[0].reset();
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

                        currBtn.removeAttr("disabled");
                    }
                }
            })
        }
    })
})