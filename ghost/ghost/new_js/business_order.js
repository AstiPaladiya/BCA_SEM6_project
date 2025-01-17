//get on the tab where you are at last stage
if(sessionStorage.getItem("current") == "" || sessionStorage.getItem("current") == null)
{
    sessionStorage.setItem("current", "home-tab");
}
else if(sessionStorage.getItem("current") == "home-tab")
{
    $("#myTab").children().find("a").removeClass("active");
    
}
else if(sessionStorage.getItem("current") == "profile-tab")
{
    $("#myTab").children().find("a").removeClass("active");
    
}
else if(sessionStorage.getItem("current") == "contact-tab")
{
    $("#myTab").children().find("a").removeClass("active");
    
}
else if(sessionStorage.getItem("current") == "contact2-tab")
{
    $("#myTab").children().find("a").removeClass("active");
    
}

$(`#${sessionStorage.getItem("current")}`).attr("aria-selected", true);
$(`#${sessionStorage.getItem("current")}`).addClass("active");

$(".tab-pane").removeClass("active");
$(".tab-pane").removeClass("show");
$(`[aria-labelledby=${sessionStorage.getItem("current")}]`).addClass("show");
$(`[aria-labelledby=${sessionStorage.getItem("current")}]`).addClass("active");


$("#home-tab").click(function(){
    sessionStorage.setItem("current", "home-tab");
});
$("#profile-tab").click(function(){
    sessionStorage.setItem("current", "profile-tab");
});
$("#contact-tab").click(function(){
    sessionStorage.setItem("current", "contact-tab");
});
$("#contact2-tab").click(function(){
    sessionStorage.setItem("current", "contact2-tab");
});


//jQuery Code Starts Here
$("#undeliveredProduTbl").on("click", ".chngLoc", function(){
    const json = {"id" : $(this).attr("data-id"), "status" : $(this).attr("data-loc")};

    $.ajax({
        type : "POST",
        method : "POST",
        data : json,
        dataType : "JSON",
        url : "../crud.php?what=getcurrloc",
        success : function(response){
            console.log(response);

            $("#saveloc").attr("data-id", json.id);
            $("#oldLoc").val(response.location);
            $("#saveloc").attr("data-loc", json.status);
        }
    })
})
// $(".chngLoc").click(function(){
//     const json = {"id" : $(this).attr("data-id"), "status" : $(this).attr("data-loc")};

//     $.ajax({
//         type : "POST",
//         method : "POST",
//         data : json,
//         dataType : "JSON",
//         url : "../crud.php?what=getcurrloc",
//         success : function(response){
//             console.log(response);

//             $("#saveloc").attr("data-id", json.id);
//             $("#oldLoc").val(response.location);
//             $("#saveloc").attr("data-loc", json.status);
//         }
//     })
// });

$("#saveloc").click(function(){
    if($("#entLoc").val() == "" || $("#entLoc").val() == null)
    {
        $.bootstrapGrowl("<div class='text-center' style='background-color:#FF3232;opacity:1;font-weight:bold'><h1>Error!</h1><p>Please enter new location</p></div>",
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
        $(this).attr("disabled", "disabled");
        const json = {"id" : $(this).attr("data-id"), "location" : $("#entLoc").val(), "status" : $(this).attr("data-loc")}
        $.ajax({
            type : "POST",
            method : "POST",
            data : json,
            dataType : "JSON",
            url : "../crud.php?what=chngNewLoc",
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
                        window.location.replace("order.php");
                    },2500);
                }
                else
                {
                    $("#saveloc").removeAttr("disabled");
                    $.bootstrapGrowl("<div class='text-center' style='background-color:#FF3232;opacity:1;font-weight:bold'><h1>Error!</h1><p>"+ response.message +"</p></div>",
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
});

$("#undeliveredProduTbl").on("click", ".markDelivered", function(){
    $("#confirmBtn").attr("data-id", $(this).attr("data-id"));
})
// $(".markDelivered").click(function(){
//     $("#confirmBtn").attr("data-id", $(this).attr("data-id"));
// });

$("#confirmBtn").click(function(){
    $(this).attr("disabled", "disabled");
    const json = {"id" : $(this).attr("data-id")};

    $.ajax({
        type : "POST",
        method : "POST",
        data : json,
        dataType : "JSON",
        url : "../crud.php?what=markasDel",
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
                        window.location.replace("order.php");
                    },2500);
                }
                else
                {
                    $("#saveloc").removeAttr("disabled");
                    $.bootstrapGrowl("<div class='text-center' style='background-color:#FF3232;opacity:1;font-weight:bold'><h1>Error!</h1><p>"+ response.message +"</p></div>",
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
});

$("#return_order_req").on("click", ".acceptReturn", function(){
    $(this).attr("disabled", "disabled");
    var curr = $(this);
    const json = {"id" : $(this).attr("data-id"), "do" : "Accepted"};

    console.log(json);

    $.ajax({
        type : "POST",
        method : "POST",
        data : json,
        dataType : "JSON",
        url : "../crud.php?what=returnRequestAppRej",
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
                        window.location.replace("order.php");
                    },2500);
                }
            else
            {
                curr.removeAttr("disabled");
                $.bootstrapGrowl("<div class='text-center' style='background-color:#FF3232;opacity:1;font-weight:bold'><h1>Error!</h1><p>"+ response.message +"</p></div>",
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
})
// $(".acceptReturn").click(function(){
//     $(this).attr("disabled", "disabled");
//     var curr = $(this);
//     const json = {"id" : $(this).attr("data-id"), "do" : "Accepted"};

//     console.log(json);

//     $.ajax({
//         type : "POST",
//         method : "POST",
//         data : json,
//         dataType : "JSON",
//         url : "../crud.php?what=returnRequestAppRej",
//         success : function(response){
//             if(response.success)
//                 {
//                     $.bootstrapGrowl("<div class='text-center' style='background-color:#1eff1e;opacity:1;font-weight:bold'><h1>Success!</h1><p>"+response['message']+"</p></div>",{
//                         delay : 2500,
//                         width : 400,
//                         allow_dismiss : false,
//                         align : "center",
//                         offset : {"from" : "top", "amount" : 20},
//                     });

//                     setTimeout(function(){
//                         window.location.replace("order.php");
//                     },2500);
//                 }
//             else
//             {
//                 curr.removeAttr("disabled");
//                 $.bootstrapGrowl("<div class='text-center' style='background-color:#FF3232;opacity:1;font-weight:bold'><h1>Error!</h1><p>"+ response.message +"</p></div>",
//                 {
//                     delay : 2500,
//                     width : 400,
//                     offset : {"from" : "top", "amount" : 20},
//                     allow_dismiss : false,
//                     align : "center",
//                 });    
//             }
//         }
//     });
// });

$("#return_order_req").on("click", ".rejectReturn", function(){
    $(this).attr("disabled", "disabled");
    const json = {"id" : $(this).attr("data-id"), "do" : "Rejected"};
    var curr = $(this);
    console.log(json);

    $.ajax({
        type : "POST",
        method : "POST",
        data : json,
        dataType : "JSON",
        url : "../crud.php?what=returnRequestAppRej",
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
                        window.location.replace("order.php");
                    },2500);
                }
            else
            {
                curr.removeAttr("disabled");

                $.bootstrapGrowl("<div class='text-center' style='background-color:#FF3232;opacity:1;font-weight:bold'><h1>Error!</h1><p>"+ response.message +"</p></div>",
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
});
// $(".rejectReturn").click(function(){
//     $(this).attr("disabled", "disabled");
//     const json = {"id" : $(this).attr("data-id"), "do" : "Rejected"};
//     var curr = $(this);
//     console.log(json);

//     $.ajax({
//         type : "POST",
//         method : "POST",
//         data : json,
//         dataType : "JSON",
//         url : "../crud.php?what=returnRequestAppRej",
//         success : function(response){
//             if(response.success)
//                 {
//                     $.bootstrapGrowl("<div class='text-center' style='background-color:#1eff1e;opacity:1;font-weight:bold'><h1>Success!</h1><p>"+response['message']+"</p></div>",{
//                         delay : 2500,
//                         width : 400,
//                         allow_dismiss : false,
//                         align : "center",
//                         offset : {"from" : "top", "amount" : 20},
//                     });

//                     setTimeout(function(){
//                         window.location.replace("order.php");
//                     },2500);
//                 }
//             else
//             {
//                 curr.removeAttr("disabled");

//                 $.bootstrapGrowl("<div class='text-center' style='background-color:#FF3232;opacity:1;font-weight:bold'><h1>Error!</h1><p>"+ response.message +"</p></div>",
//                 {
//                     delay : 2500,
//                     width : 400,
//                     offset : {"from" : "top", "amount" : 20},
//                     allow_dismiss : false,
//                     align : "center",
//                 });    
//             }
//         }
//     });
// });

$("#return_order_tbl").on("click", ".receivedReturn", function(){
    const json = {"id" : $(this).attr("data-id"), "do" : "Received Return"};

    var curr = $(this);
    curr.attr("disabled", "disabled");

    $.ajax({
        type : "POST",
        method : "POST",
        data : json,
        dataType : "JSON",
        url : "../crud.php?what=changeReturnOrderStatus",
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
                        window.location.replace("order.php");
                    },2500);
                }
            else
            {
                curr.removeAttr("disabled");

                $.bootstrapGrowl("<div class='text-center' style='background-color:#FF3232;opacity:1;font-weight:bold'><h1>Error!</h1><p>"+ response.message +"</p></div>",
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
})
// $(".receivedReturn").click(function(){
//     const json = {"id" : $(this).attr("data-id"), "do" : "Received Return"};

//     var curr = $(this);
//     curr.attr("disabled", "disabled");

//     $.ajax({
//         type : "POST",
//         method : "POST",
//         data : json,
//         dataType : "JSON",
//         url : "../crud.php?what=changeReturnOrderStatus",
//         success : function(response){
//             if(response.success)
//                 {
//                     $.bootstrapGrowl("<div class='text-center' style='background-color:#1eff1e;opacity:1;font-weight:bold'><h1>Success!</h1><p>"+response['message']+"</p></div>",{
//                         delay : 2500,
//                         width : 400,
//                         allow_dismiss : false,
//                         align : "center",
//                         offset : {"from" : "top", "amount" : 20},
//                     });

//                     setTimeout(function(){
//                         window.location.replace("order.php");
//                     },2500);
//                 }
//             else
//             {
//                 curr.removeAttr("disabled");

//                 $.bootstrapGrowl("<div class='text-center' style='background-color:#FF3232;opacity:1;font-weight:bold'><h1>Error!</h1><p>"+ response.message +"</p></div>",
//                 {
//                     delay : 2500,
//                     width : 400,
//                     offset : {"from" : "top", "amount" : 20},
//                     allow_dismiss : false,
//                     align : "center",
//                 });    
//             }
//         }
//     })
// });

$("#return_order_tbl").on("click", ".pickedUp", function(){
    var curr = $(this);

    const json = {"id" : $(this).attr("data-id"), "do" : "Picked Up"}
    curr.attr("disabled", "disabled");

    $.ajax({
        type : "POST",
        method : "POST",
        data : json,
        dataType : "JSON",
        url : "../crud.php?what=changeReturnOrderStatus",
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
                        window.location.replace("order.php");
                    },2500);
                }
            else
            {
                curr.removeAttr("disabled");

                $.bootstrapGrowl("<div class='text-center' style='background-color:#FF3232;opacity:1;font-weight:bold'><h1>Error!</h1><p>"+ response.message +"</p></div>",
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
})
// $(".pickedUp").click(function(){
//     var curr = $(this);

//     const json = {"id" : $(this).attr("data-id"), "do" : "Picked Up"}
//     curr.attr("disabled", "disabled");

//     $.ajax({
//         type : "POST",
//         method : "POST",
//         data : json,
//         dataType : "JSON",
//         url : "../crud.php?what=changeReturnOrderStatus",
//         success : function(response){
//             if(response.success)
//                 {
//                     $.bootstrapGrowl("<div class='text-center' style='background-color:#1eff1e;opacity:1;font-weight:bold'><h1>Success!</h1><p>"+response['message']+"</p></div>",{
//                         delay : 2500,
//                         width : 400,
//                         allow_dismiss : false,
//                         align : "center",
//                         offset : {"from" : "top", "amount" : 20},
//                     });

//                     setTimeout(function(){
//                         window.location.replace("order.php");
//                     },2500);
//                 }
//             else
//             {
//                 curr.removeAttr("disabled");

//                 $.bootstrapGrowl("<div class='text-center' style='background-color:#FF3232;opacity:1;font-weight:bold'><h1>Error!</h1><p>"+ response.message +"</p></div>",
//                 {
//                     delay : 2500,
//                     width : 400,
//                     offset : {"from" : "top", "amount" : 20},
//                     allow_dismiss : false,
//                     align : "center",
//                 });    
//             }
//         }
//     })
// });

$("#return_order_tbl").on("click", ".alterRejection", function(){
    var curr = $(this);

    const json = {"id" : $(this).attr("data-id"), "do" : "Accepted"}
    curr.attr("disabled", "disabled");

    $.ajax({
        type : "POST",
        method : "POST",
        data : json,
        dataType : "JSON",
        url : "../crud.php?what=changeReturnOrderStatus",
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
                        window.location.replace("order.php");
                    },2500);
                }
            else
            {
                curr.removeAttr("disabled");

                $.bootstrapGrowl("<div class='text-center' style='background-color:#FF3232;opacity:1;font-weight:bold'><h1>Error!</h1><p>"+ response.message +"</p></div>",
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
})
// $(".alterRejection").click(function(){
//     var curr = $(this);

//     const json = {"id" : $(this).attr("data-id"), "do" : "Accepted"}
//     curr.attr("disabled", "disabled");

//     $.ajax({
//         type : "POST",
//         method : "POST",
//         data : json,
//         dataType : "JSON",
//         url : "../crud.php?what=changeReturnOrderStatus",
//         success : function(response){
//             if(response.success)
//                 {
//                     $.bootstrapGrowl("<div class='text-center' style='background-color:#1eff1e;opacity:1;font-weight:bold'><h1>Success!</h1><p>"+response['message']+"</p></div>",{
//                         delay : 2500,
//                         width : 400,
//                         allow_dismiss : false,
//                         align : "center",
//                         offset : {"from" : "top", "amount" : 20},
//                     });

//                     setTimeout(function(){
//                         window.location.replace("order.php");
//                     },2500);
//                 }
//             else
//             {
//                 curr.removeAttr("disabled");

//                 $.bootstrapGrowl("<div class='text-center' style='background-color:#FF3232;opacity:1;font-weight:bold'><h1>Error!</h1><p>"+ response.message +"</p></div>",
//                 {
//                     delay : 2500,
//                     width : 400,
//                     offset : {"from" : "top", "amount" : 20},
//                     allow_dismiss : false,
//                     align : "center",
//                 });    
//             }
//         }
//     })
// });

$("#return_order_tbl").on("click", ".makePayment", function(){
    $("#paymentBtn").attr("data-id", $(this).attr("data-id"));
})
// $(".makePayment").click(function(){
//     $("#paymentBtn").attr("data-id", $(this).attr("data-id"));
// });

$("#paymentBtn").click(function(){
    var curr = $(this);

    const json = {"id" : $(this).attr("data-id"), "do" : "Completed"}
    curr.attr("disabled", "disabled");

    $.ajax({
        type : "POST",
        method : "POST",
        data : json,
        dataType : "JSON",
        url : "../crud.php?what=changeReturnOrderStatus",
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
                        window.location.replace("order.php");
                    },2500);
                }
            else
            {
                curr.removeAttr("disabled");

                $.bootstrapGrowl("<div class='text-center' style='background-color:#FF3232;opacity:1;font-weight:bold'><h1>Error!</h1><p>"+ response.message +"</p></div>",
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
})