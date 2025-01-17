$("#substable, #userTable").on("click", ".block", function(){
    $("#reason-Label").html("Block User Reason :");
    $("#exampleModalLabel").html("Block User");
    $("#exampleModal").modal('show');

    $("#save").attr("data-id", $(this).attr("data-id"));
    $("#save").attr("data-do", $(this).attr("data-do"));
});


// $(".block").click(function(){
//     $("#reason-Label").html("Block User Reason :");
//     $("#exampleModalLabel").html("Block User");
//     $("#exampleModal").modal('show');

//     $("#save").attr("data-id", $(this).attr("data-id"));
//     $("#save").attr("data-do", $(this).attr("data-do"));
//     // const json = {"userid" : $(this).attr("data-id"), "status" : "block"};

//     // $.ajax({
//     //     type : "POST",
//     //     method : "POST",
//     //     data : json,
//     //     dataType : "JSON",
//     //     url : "../crud.php?what=blockcustomer",
//     //     success : function(response){
//     //         if(response["success"])
//     //         {
//     //             $.bootstrapGrowl("<div class='text-center' style='background-color:#1eff1e;opacity:1;font-weight:bold'><h1>Success</h1><p>"+ response["message"] +"</p></div>",{
//     //                 delay : 2500,
//     //                 allow_dismiss : false,
//     //                 width : 400,
//     //                 align : "center",
//     //             });

//     //             setTimeout(function(){
//     //                 window.location.reload();
//     //             }, 2500);
//     //         }
//     //         else
//     //         {
//     //             $.bootstrapGrowl("<div class='text-center' style='background-color:#FF3232;opacity:1;font-weight:bold'><h1>Error</h1><p>"+ response["message"] +"</p></div>",{
//     //                 delay : 2500,
//     //                 allow_dismiss : false,
//     //                 width : 400,
//     //                 align : "center",
//     //             });
//     //         }
//     //     }
//     // })
// });

$("#substable, #userTable").on("click", ".unblock", function(){
    $("#reason-Label").html("Active User Reason:");
    $("#exampleModalLabel").html("Activate User");
    $("#exampleModal").modal('show');

    $("#save").attr("data-id", $(this).attr("data-id"));
    $("#save").attr("data-do", $(this).attr("data-do"));
})

// $(".unblock").click(function(){
//     $("#reason-Label").html("Active User Reason:");
//     $("#exampleModalLabel").html("Activate User");
//     $("#exampleModal").modal('show');

//     $("#save").attr("data-id", $(this).attr("data-id"));
//     $("#save").attr("data-do", $(this).attr("data-do"));
//     // const json = {"userid" : $(this).attr("data-id"), "status" : "active"};

//     // $.ajax({
//     //     type : "POST",
//     //     method : "POST",
//     //     data : json,
//     //     dataType : "JSON",
//     //     url : "../crud.php?what=unblockcustomer",
//     //     success : function(response){
//     //         if(response["success"])
//     //         {
//     //             $.bootstrapGrowl("<div class='text-center' style='background-color:#1eff1e;opacity:1;font-weight:bold'><h1>Success</h1><p>"+ response["message"] +"</p></div>",{
//     //                 delay : 2500,
//     //                 allow_dismiss : false,
//     //                 width : 400,
//     //                 align : "center",
//     //             });

//     //             setTimeout(function(){
//     //                 window.location.reload();
//     //             }, 2500);
//     //         }
//     //         else
//     //         {
//     //             $.bootstrapGrowl("<div class='text-center' style='background-color:#FF3232;opacity:1;font-weight:bold'><h1>Error</h1><p>"+ response["message"] +"</p></div>",{
//     //                 delay : 2500,
//     //                 allow_dismiss : false,
//     //                 width : 400,
//     //                 align : "center",
//     //             });
//     //         }
//     //     }
//     // })
// })

$("#save").click(function(){
    if($("#reason").val() != "" && $("#reason").val() != null)
    {
        var btn = $(this);
        var json = {"id" : $(this).attr("data-id"), "status" : $(this).attr("data-do")};

        btn.attr("disabled", "disabled");

        if(json.status == "Active")
        {
            var jsonData = {"userid" : json.id, "status" : "active", "message" : $("#reason").val()};

            $.ajax({
                type : "POST",
                method : "POST",
                data : jsonData,
                dataType : "JSON",
                url : "../crud.php?what=unblockcustomer",
                success : function(response){
                    if(response["success"])
                    {
                        $.bootstrapGrowl("<div class='text-center' style='background-color:#1eff1e;opacity:1;font-weight:bold'><h1>Success!</h1><p>"+ response["message"] +"</p></div>",{
                            delay : 2500,
                            allow_dismiss : false,
                            width : 400,
                            align : "center",
                        });

                        setTimeout(function(){
                            window.location.reload();
                        }, 2500);
                    }
                    else
                    {
                        $.bootstrapGrowl("<div class='text-center' style='background-color:#FF3232;opacity:1;font-weight:bold'><h1>Error!</h1><p>"+ response["message"] +"</p></div>",{
                            delay : 2500,
                            allow_dismiss : false,
                            width : 400,
                            align : "center",
                        });

                        btn.removeAttr("disabled");
                    }
                }
            })
        }
        else
        {
            var jsonData = {"userid" : json.id, "status" : "block", "message" : $("#reason").val()};

            $.ajax({
                type : "POST",
                method : "POST",
                data : jsonData,
                dataType : "JSON",
                url : "../crud.php?what=unblockcustomer",
                success : function(response){
                    if(response["success"])
                    {
                        $.bootstrapGrowl("<div class='text-center' style='background-color:#1eff1e;opacity:1;font-weight:bold'><h1>Success!</h1><p>"+ response["message"] +"</p></div>",{
                            delay : 2500,
                            allow_dismiss : false,
                            width : 400,
                            align : "center",
                        });

                        setTimeout(function(){
                            window.location.reload();
                        }, 2500);
                    }
                    else
                    {
                        $.bootstrapGrowl("<div class='text-center' style='background-color:#FF3232;opacity:1;font-weight:bold'><h1>Error!</h1><p>"+ response["message"] +"</p></div>",{
                            delay : 2500,
                            allow_dismiss : false,
                            width : 400,
                            align : "center",
                        });

                        btn.removeAttr("disabled");
                    }
                }
            })
        }
    }
    else
    {
        $("#reason").focus();
    }
})