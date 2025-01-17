$("#producttable").on("click", ".blockProduct", function(){
    $("#exampleModal").modal('show');
    // const json = {"do" : "Block", "id" : $(this).attr("data-id")};

    $("#reasonHeader").text("Block Product");
    $("#reason-Label-id").text("Block Product Reason :");

    $("#saveReasonBtn").attr("data-do", "Block");
    $("#saveReasonBtn").attr("data-id", $(this).attr("data-id"));
})

// $(".blockProduct").click(function(){
//     $("#exampleModal").modal('show');
//     // const json = {"do" : "Block", "id" : $(this).attr("data-id")};

//     $("#reasonHeader").text("Block Product");
//     $("#reason-Label-id").text("Block Product Reason :");

//     $("#saveReasonBtn").attr("data-do", "Block");
//     $("#saveReasonBtn").attr("data-id", $(this).attr("data-id"));
// });

$("#saveReasonBtn").click(function(){
    if($("#reasonTxtArea").val().trim() == "" || $("#reasonTxtArea").val().trim() == null)
    {
        $.bootstrapGrowl("<div class='text-center' style='background-color:#FF3232;opacity:1;font-weight:bold'><h1>Error !</h1><p>Please enter reason</p></div>",
        {
            delay : 2500,
            width : 400,
            offset : {"from" : "top", "amount" : 20},
            allow_dismiss : false,
            align : "center",
        }); 
    }
    else
    {
        const json = {"do" : $(this).attr("data-do"), "id" : $(this).attr("data-id"), "reason" : $("#reasonTxtArea").val().trim()};
        console.log(json);

        $(this).attr("disabled", "disabled");

        $.ajax({
            type : "POST",
            method : "POST",
            data : json,
            dataType : "JSON",
            url : "../crud.php?what=blunblproduct",
            success : function(response){
                if(response.success)
                {
                    $.bootstrapGrowl("<div class='text-center' style='background-color:#1eff1e;opacity:1;font-weight:bold'><h1>Success!</h1><p>"+response['message']+"</p></div>",{
                        delay : 2500,
                        width : 400,
                        allow_dismiss : false,
                        align : "center",
                        offset : {"from" : "top", "amount" : 20},
                    });

                    setTimeout(function(){
                        window.location.replace("products.php");
                    },2500);
                }
                else
                {
                    $("#saveReasonBtn").removeAttr("disabled");
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
        })
    }
})

$("#producttable").on("click", ".activeProduct", function(){
    $("#exampleModal").modal('show');
    // const json = {"do" : "Block", "id" : $(this).attr("data-id")};

    $("#reasonHeader").text("Active Product");
    $("#reason-Label-id").text("Active Product Rason :");

    $("#saveReasonBtn").attr("data-do", "Active");
    $("#saveReasonBtn").attr("data-id", $(this).attr("data-id"));
})
// $(".activeProduct").click(function(){
//     // const json = {"do" : "Active", "id" : $(this).attr("data-id")};

//     $("#exampleModal").modal('show');
//     // const json = {"do" : "Block", "id" : $(this).attr("data-id")};

//     $("#reasonHeader").text("Active Product");
//     $("#reason-Label-id").text("Active Product Rason :");

//     $("#saveReasonBtn").attr("data-do", "Active");
//     $("#saveReasonBtn").attr("data-id", $(this).attr("data-id"));

//     // $.ajax({
//     //     type : "POST",
//     //     method : "POST",
//     //     data : json,
//     //     dataType : "JSON",
//     //     url : "../crud.php?what=blunblproduct",
//     //     success : function(response){
//     //         if(response.success)
//     //         {
//     //             $.bootstrapGrowl("<div class='text-center' style='background-color:#1eff1e;opacity:1;font-weight:bold'><h1>Success!</h1><p>"+response['message']+"</p></div>",{
//     //                 delay : 2500,
//     //                 width : 400,
//     //                 allow_dismiss : false,
//     //                 align : "center",
//     //                 offset : {"from" : "top", "amount" : 20},
//     //             });

//     //             setTimeout(function(){
//     //                 window.location.replace("products.php");
//     //             },2500);
//     //         }
//     //         else
//     //         {
//     //             $.bootstrapGrowl("<div class='text-center' style='background-color:#FF3232;opacity:1;font-weight:bold'><h1>Error !</h1><p>"+response['message']+"</p></div>",
//     //             {
//     //                 delay : 2500,
//     //                 width : 400,
//     //                 offset : {"from" : "top", "amount" : 20},
//     //                 allow_dismiss : false,
//     //                 align : "center",
//     //             }); 
//     //         }
//     //     }
//     // });
// });

$("#producttable").on("click", ".btnViewMore", function(){
    const json={"id":$(this).attr("data-id")};
    $.ajax({
        type:"POT",
        method:"POST",
        url:"../crud.php?what=viewMoreAdminProduct",
        data:json,
        dataType:"JSON",
        success:function(response)
        {
            $("#viewMoreModel").empty();
            $("#viewMoreModel").append(response);
        }
    })
})
// $(".btnViewMore").click(
//     function()
//     {
//         const json={"id":$(this).attr("data-id")};
//         $.ajax({
//             type:"POT",
//             method:"POST",
//             url:"../crud.php?what=viewMoreAdminProduct",
//             data:json,
//             dataType:"JSON",
//             success:function(response)
//             {
//                 $("#viewMoreModel").empty();
//                 $("#viewMoreModel").append(response);
//             }
//         })
//     }
// );