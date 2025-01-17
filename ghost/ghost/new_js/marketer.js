$("#marketer").validate({
    rules:
    {
        "txtName":
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
            //pattern:"^.*(?=.{5,})(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z]).*$",
        }
    },
    messages:
    {
        "txtName":{
            required:"<span class='text-danger' style='font-size:small'>Please enter Marketer Name</span>",
        },
        "txtMail":
        {
            required:"<span class='text-danger' style='font-size:small'>Please enter  email address</span>",
            email: "<span class='text-danger' style='font-size:small'>Email address must be in the format of name@domain.com</span>",
        },
        "txtPwd":
        {
            required:"<div class='text-danger'  style='font-size:small'>Please enter  password</div>",
            // minlength:"<span class='text-danger' style='font-size:small'>Please enter minimum 5 charchater in Pass</span>",
            //pattern:"<span class='text-danger' style='font-size:small;' hidden>Please enter atleast one small and capital alphabat charchter, one special keyword and one digit with minimum range of 5</span>",
        }
    }
});
$("#product").validate({
    rules:
    {
        "drpMark":
        {
            required:true,
        },
        "drpPrd":
        {
            required:true,
        },
        "txtCom":
        {
            required:true,
            min:1,
        }
    },
    messages:
    {
        "drpMark":{
            required:"<span class='text-danger' style='font-size:small'>Please select Marketer</span>",
        },
        "drpPrd":{
            required:"<span class='text-danger' style='font-size:small'>Please select Product</span>",
        },
        "txtCom":{
            required:"<span class='text-danger' style='font-size:small'>Please enter Comission <br/></span>",
            min : "<span class='text-danger' style='font-size:small'>Comission value should be minimum 1 <br/></span>",

        },

    }
});
$("#btnSubmit").click(
    function(event)
    {
         if(!$("#marketer").valid())
         {
            event.preventDefault();
         }
         else
        {
            var passPat = /^.*(?=.{5,})(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z]).*$/;
            if(!passPat.test($("#txtPwd").val()))
            {
                $("#passChk").show();
                return false;
            }
            else
            {
                $("#passChk").hide();
            }

            event.preventDefault();

            const json = {};
            var formdata = $("#marketer").serializeArray();

            $.each(formdata, function(){
                json[this.name] = this.value;
            });

            $("#btnSubmit").attr("disabled", "disabled");
            $.ajax
            ({
                type:"POST",
                method:"POST",
                url:"../crud.php?what=insertMarketer",
                data:json,
                dataType:"JSON",
                success:function(response)
                {
                    
                    window.scrollTo({"top" : 0, "behavior" : "smooth"});
                        if(response["success"])
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
                                    window.location.reload();
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

                            $("#btnSubmit").removeAttr("disabled");
                        }
              
                }
           });
        }
    });
$("#btnProdctSubmit").click(
    function(event)
    {
        if(!$("#product").valid())
        {
            event.preventDefault();
        }
        else
        {
            event.preventDefault();
            var formdata = $("#product").serializeArray();

            const json = {};

            $.each(formdata, function(){
                json[this.name] = this.value;
            });

            $("#btnProdctSubmit").attr("disabled", "disabled");
            $.ajax({
                type:"POST",
                method:"POST",
                url:"../crud.php?what=assignProduct",
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
                                    window.location.reload();
                                },4000);
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

                            $("#btnProdctSubmit").removeAttr("disabled");
                        }
              
                }
            });
        }
    });
    // Assign Product block-active
    $("#tblProduct").on("click", ".activeAssign", function(){
        var CurrentBtn = $(this);
            $(this).attr("disabled", "disabled");
            const json={"id":$(this).attr("data-id")};

            $.ajax({
            type:"POST",
            method:"POST",
            url:"../crud.php?what=blockMarketerProduct",
            data:json,
            dataType:"JSON",
            success:function(response){
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
                            window.location.replace("marketer.php");
                        },4000);
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

                    CurrentBtn.removeAttr("disabled");
                }
            }
        });
    })
    // $(".activeAssign").click(
    //     function()
    //     {
    //         var CurrentBtn = $(this);
    //         $(this).attr("disabled", "disabled");
    //         const json={"id":$(this).attr("data-id")};

    //         $.ajax({
    //             type:"POST",
    //             method:"POST",
    //             url:"../crud.php?what=blockMarketerProduct",
    //             data:json,
    //             dataType:"JSON",
    //             success:function(response){
    //                 console.log(response);
    //                 window.scrollTo({"top" : 0, "behavior" : "smooth"});
    //                 if(response["success"]==true)
    //                 {
    //                     $.bootstrapGrowl("<div class='text-center' style='background-color:#1eff1e;opacity:1;font-weight:bold'><h1>Success!</h1><p>"+response['message']+"</p></div>",
    //                         {
    //                             delay : 2500,
    //                             width : 400,
    //                             offset : {"from" : "top", "amount" : 20},
    //                             allow_dismiss : false,
    //                             align : "center",
    //                         }); 
    //                         setTimeout(function(){
    //                             window.location.replace("marketer.php");
    //                         },4000);
    //                 }
    //                 else
    //                 {
    //                     $.bootstrapGrowl("<div class='text-center' style='background-color:#FF3232;opacity:1;font-weight:bold'><h1>Error!</h1><p>"+response['message']+"</p></div>",
    //                     {
    //                         delay : 2500,
    //                         width : 400,
    //                         offset : {"from" : "top", "amount" : 20},
    //                         allow_dismiss : false,
    //                         align : "center",
    //                     }); 

    //                     CurrentBtn.removeAttr("disabled");
    //                 }
    //             }

    //     });
    // });
    // Assign Product active-block
    $("#tblProduct").on("click", ".blockAssign", function(){
        var CurrentBtn = $(this);
            $(this).attr("disabled", "disabled");
            const json={"id":$(this).attr("data-id")};
            $.ajax({
            type:"POST",
            method:"POST",
            url:"../crud.php?what=ActiveMarketerProduct",
            data:json,
            dataType:"JSON",
            success:function(response){
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
                            window.location.replace("marketer.php");
                        },4000);
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

                    CurrentBtn.removeAttr("disabled");
                }
            }
        });
    })
    // $(".blockAssign").click(
    //     function()
    //     {
    //         var CurrentBtn = $(this);
    //         $(this).attr("disabled", "disabled");
    //         const json={"id":$(this).attr("data-id")};
    //         $.ajax({
    //             type:"POST",
    //             method:"POST",
    //             url:"../crud.php?what=ActiveMarketerProduct",
    //             data:json,
    //             dataType:"JSON",
    //             success:function(response){
    //                     window.scrollTo({"top" : 0, "behavior" : "smooth"});
    //                     if(response["success"]==true)
    //                     {
    //                         $.bootstrapGrowl("<div class='text-center' style='background-color:#1eff1e;opacity:1;font-weight:bold'><h1>Success!</h1><p>"+response['message']+"</p></div>",
    //                             {
    //                                 delay : 2500,
    //                                 width : 400,
    //                                 offset : {"from" : "top", "amount" : 20},
    //                                 allow_dismiss : false,
    //                                 align : "center",
    //                             }); 
    //                             setTimeout(function(){
    //                                 window.location.replace("marketer.php");
    //                             },4000);
    //                     }
    //                     else
    //                     {
    //                         $.bootstrapGrowl("<div class='text-center' style='background-color:#FF3232;opacity:1;font-weight:bold'><h1>Error!</h1><p>"+response['message']+"</p></div>",
    //                         {
    //                             delay : 2500,
    //                             width : 400,
    //                             offset : {"from" : "top", "amount" : 20},
    //                             allow_dismiss : false,
    //                             align : "center",
    //                         }); 

    //                         CurrentBtn.removeAttr("disabled");
    //                     }
    //             }

    //     });
    // });
  // Marketer block
  $("#tblMarketer").on("click", ".blockMarketer", function(){
    $(this).attr("disabled", "disabled");
        var CurrentBtn = $(this);
        const json={"id":$(this).attr("data-id")};
    
        $.ajax({
        type:"POST",
        method:"POST",
        url:"../crud.php?what=blockMarketer",
        data:json,
        dataType:"JSON",
        success:function(response){
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
                        window.location.replace("marketer.php");
                    },4000);
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
                
                CurrentBtn.removeAttr("disabled");
            }
        }
    });
  })
//   $(".blockMarketer").click(
//     function()
//     {
//         $(this).attr("disabled", "disabled");
//         var CurrentBtn = $(this);
//         const json={"id":$(this).attr("data-id")};
    
//         $.ajax({
//             type:"POST",
//             method:"POST",
//             url:"../crud.php?what=blockMarketer",
//             data:json,
//             dataType:"JSON",
//             success:function(response){
//                 console.log(response);
//                 window.scrollTo({"top" : 0, "behavior" : "smooth"});
//                 if(response["success"]==true)
//                 {
//                     $.bootstrapGrowl("<div class='text-center' style='background-color:#1eff1e;opacity:1;font-weight:bold'><h1>Success!</h1><p>"+response['message']+"</p></div>",
//                         {
//                             delay : 2500,
//                             width : 400,
//                             offset : {"from" : "top", "amount" : 20},
//                             allow_dismiss : false,
//                             align : "center",
//                         }); 
//                         setTimeout(function(){
//                             window.location.replace("marketer.php");
//                         },4000);
//                 }
//                 else
//                 {
//                     $.bootstrapGrowl("<div class='text-center' style='background-color:#FF3232;opacity:1;font-weight:bold'><h1>Error!</h1><p>"+response['message']+"</p></div>",
//                     {
//                         delay : 2500,
//                         width : 400,
//                         offset : {"from" : "top", "amount" : 20},
//                         allow_dismiss : false,
//                         align : "center",
//                     });
                    
//                     CurrentBtn.removeAttr("disabled");
//                 }
//             }

//     });
// });  
// Marketer Active
$("#tblMarketer").on("click", ".activeMarketer", function(){
    $(this).attr("disabled", "disabled");
        var CurrentBtn = $(this);
        const json={"id":$(this).attr("data-id")};
        $.ajax({
        type:"POST",
        method:"POST",
        url:"../crud.php?what=activeMarketer",
        data:json,
        dataType:"JSON",
        success:function(response){
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
                        window.location.replace("marketer.php");
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
                CurrentBtn.removeAttr("disabled");
            }
        }
    });
})
// $(".activeMarketer").click(
//     function()
//     {
//         $(this).attr("disabled", "disabled");
//         var CurrentBtn = $(this);
//         const json={"id":$(this).attr("data-id")};
//         $.ajax({
//             type:"POST",
//             method:"POST",
//             url:"../crud.php?what=activeMarketer",
//             data:json,
//             dataType:"JSON",
//             success:function(response){
//                 window.scrollTo({"top" : 0, "behavior" : "smooth"});
//                 if(response["success"]==true)
//                 {
//                     $.bootstrapGrowl("<div class='text-center' style='background-color:#1eff1e;opacity:1;font-weight:bold'><h1>Success!</h1><p>"+response['message']+"</p></div>",
//                         {
//                             delay : 2500,
//                             width : 400,
//                             offset : {"from" : "top", "amount" : 20},
//                             allow_dismiss : false,
//                             align : "center",
//                         }); 
//                         setTimeout(function(){
//                             window.location.replace("marketer.php");
//                         },2500);
//                 }
//                 else
//                 {
//                     $.bootstrapGrowl("<div class='text-center' style='background-color:#FF3232;opacity:1;font-weight:bold'><h1>Error!</h1><p>"+response['message']+"</p></div>",
//                     {
//                         delay : 2500,
//                         width : 400,
//                         offset : {"from" : "top", "amount" : 20},
//                         allow_dismiss : false,
//                         align : "center",
//                     }); 
//                     CurrentBtn.removeAttr("disabled");
//                 }
//             }

//     });
// });  
//edit assign marketer product
$("#tblProduct").on("click", ".editAssign", function(){
    const json={"id":$(this).attr("data-id")};
        $.ajax({
        type:"POST",
        method:"POST",
        url:"../crud.php?what=edit",
        data:json,
        dataType:"JSON",
        success:function(response){
            $("#assignProduct").empty();
            $("#assignProduct").append(response);
        }
    });
})
// $(".editAssign").click(
//     function()
//     {
//         const json={"id":$(this).attr("data-id")};
//         $.ajax({
//             type:"POST",
//             method:"POST",
//             url:"../crud.php?what=edit",
//             data:json,
//             dataType:"JSON",
//             success:function(response){
//                 $("#assignProduct").empty();
//                 $("#assignProduct").append(response);
//             }

//     });
// });  
// Editable Table
$("#btnEditProductSubmit").click(
    function(event)
    {
    
            event.preventDefault();
            var com=$("#txtEditCom").val();
            if(com=="")
            {
                $("#errorMsg").html("<br/>Please enter commission in percentage");
                $("#errorMsg").css("color"," red");
                return false;
            }
            else
            {
                    if(com > 0)
					{ 
                        var CurrentBtn = $(this);
                        $(this).attr("disabled", "disabled");
                        const json={"id":$("#assignProduct").children().find("input[id=txtEditId]").val(),"com":$("#txtEditCom").val()};
                    
                        $.ajax({
                            type:"POST",
                            method:"POST",
                            url:"../crud.php?what=editTable",
                            data:json,
                            dataType:"JSON",
                            success:function(response){
                               
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
                                            window.location.replace("marketer.php");
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
					else
					{
						$("#errorMsg").html("<br/><small>Comission value should be minimum 1</small>");
						$("#errorMsg").css("color"," red");	
						return false;
					}
            }
    }
);

$("#drpMark").blur(function(){
    if($(this).val() != "" && $(this).val() != null)
    {
        const json = {"mrkId" : $(this).val()};

        $.ajax({
            type : "POST",
            method : "POST",
            data : json,
            dataType : "JSON",
            url : "../crud.php?what=getMarketerAssignedProductId",
            success : function(response){
                console.log(response);

                $.each(response, function(key, value){
                    $.each($("#drpPrd").find("option"), function(){
                        if($(this).val() == value)
                        {
                            $(this).attr("disabled", "disabled");
                            $(this).css("color", "lightgrey");
                        }
                    })  
                })
            }
        })
    }
})
