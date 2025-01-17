$("#product_frm").validate({
    rules:{
        "drpCat":{
            required:true,
        },
        "txtName":{
            required:true,
        },
        "txtDes":{
            required:true,
        },
        "txtPrice":{
            required:true,
            min:1,
        },
        "img1":{
            required : true,
            accept : "jpg,png,jpeg",
        },
        "img2":{
            // required : true,
            accept : "jpg,png,jpeg",
        },
        "img3":{
            //required : true,
            accept : "jpg,png,jpeg",
        },
        "img4":{
            //required : true,
            accept : "jpg,png,jpeg",
        }

    },
    messages:{
        "drpCat":{
            required:"<span class='text-danger' style='font-size:small'>Please select Catagory</span>",
        },
        "txtName":{
            required:"<span class='text-danger' style='font-size:small'>Please enter Product Name</span>",
        },
        "txtDes":{
            required:"<span class='text-danger' style='font-size:small'>Please enter Product Description</span>",
        },
        "txtPrice":{
            required:"<span class='text-danger' style='font-size:small'>Please enter Product Price </span>",
            min : "<span class='text-danger' style='font-size:small'>Price should be minimum 1</span>",
        },
        "img1" : {
            required : "<span class='text-danger' style='font-size:small'>Select compulsory first Product image is required</span>",
            accept : "<span class='text-danger' style='font-size:small'>Image can only be in jpg, jpeg, png format</span>",
        },
        "img2" : {
           // required : "<span class='text-danger' style='font-size:small'>Please select Product image</span>",
            accept : "<span class='text-danger' style='font-size:small''>Image can only be in jpg, jpeg, png format</span>",
        },
        "img3" : {
            //required : "<span class='text-danger' style='font-size:small'>Please select Product image</span>",
            accept : "<span class='text-danger' style='font-size:small'>Image can only be in jpg, jpeg, png format</span>",
        },
        "img4" : {
            //required : "<span class='text-danger' style='font-size:small'>Please select Product image</span>",
            accept : "<span class='text-danger' style='font-size:small'>Image can only be in jpg, jpeg, png format</span>",
        }


    }
 });
 $("#updateForm").validate({
    rules:{
        "txtDesUpd":{
            required:true,
        },
        "txtPriceUpd":{
            required:true,
            min:1,
        },
        "img1Upd":{
            // required : true,
            accept : "jpg,png,jpeg",
        },
        "img2Upd":{
            // required : true,
            accept : "jpg,png,jpeg",
        },
        "img3Upd":{
            //required : true,
            accept : "jpg,png,jpeg",
        },
        "img4Upd":{
            //required : true,
            accept : "jpg,png,jpeg",
        }

    },
    messages:{
        "txtDesUpd":{
            required:"<span class='text-danger' style='font-size:small'>Please enter Product Description</span>",
        },
        "txtPriceUpd":{
            required:"<span class='text-danger' style='font-size:small'>Please enter Product Price </span>",
            min : "<span class='text-danger' style='font-size:small'>Price should be minimum 1</span>",
        },
        "img1Upd" : {
            // required : "<span class='text-danger' style='font-size:small'>Select compulsory first Product image is required</span>",
            accept : "<span class='text-danger' style='font-size:small'>Image can only be in jpg, jpeg, png format</span>",
        },
        "img2Upd" : {
           // required : "<span class='text-danger' style='font-size:small'>Please select Product image</span>",
            accept : "<span class='text-danger' style='font-size:small''>Image can only be in jpg, jpeg, png format</span>",
        },
        "img3Upd" : {
            //required : "<span class='text-danger' style='font-size:small'>Please select Product image</span>",
            accept : "<span class='text-danger' style='font-size:small'>Image can only be in jpg, jpeg, png format</span>",
        },
        "img4Upd" : {
            //required : "<span class='text-danger' style='font-size:small'>Please select Product image</span>",
            accept : "<span class='text-danger' style='font-size:small'>Image can only be in jpg, jpeg, png format</span>",
        }


    }
 });

 $("#img1").change(function(){
    $("#img2").removeAttr("disabled");
 });
 $("#img2").change(function(){
    $("#img3").removeAttr("disabled");
 });
 $("#img3").change(function(){
    $("#img4").removeAttr("disabled");
 });
$("#btnSubmit").click(
    function(event)
    {
        if(!$("#product_frm").valid())
        {
            event.preventDefault();
        }
    }
);
$("#btnUpdateSubmit").click(
    function(event)
    {
        if(!$("#product_frm").valid())
        {
            event.preventDefault();
        }
    }
);

$("#tblPlan").on("click", ".UnSold", function(){
    var CurrentBtn = $(this);
    $(this).attr("disabled", "disabled");
    const json = {"id" : $(this).attr("data-id")};
  
    $.ajax({
        type:"POST",
        method:"POST",
        url:"../crud.php?what=UnsoldProduct",
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
                            window.location.replace("product.php");
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
                }
        }
    });
})
// $(".UnSold").click(function(){
//     var CurrentBtn = $(this);
//     $(this).attr("disabled", "disabled");
//     const json = {"id" : $(this).attr("data-id")};
  
//     $.ajax({
//         type:"POST",
//         method:"POST",
//         url:"../crud.php?what=UnsoldProduct",
//         data:json,
//         dataType:"JSON",
//         success:function(response)
//         {
//             console.log(response);
//             window.scrollTo({"top" : 0, "behavior" : "smooth"});
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
//                             window.location.replace("product.php");
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
//                 }
//         }
//     });
// });

$("#tblPlan").on("click", ".Sold", function(){
    var CurrentBtn = $(this);
    $(this).attr("disabled", "disabled");   
    const json={"id":$(this).attr("data-id")};
    
    $.ajax({
        type:"POST",
        method:"POST",
        url:"../crud.php?what=SoldProduct",
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
                        window.location.replace("product.php");
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
            }
        }
    });
})
// $(".Sold").click(function()
// {
//     var CurrentBtn = $(this);
//     $(this).attr("disabled", "disabled");   
//     const json={"id":$(this).attr("data-id")};
    
//     $.ajax({
//         type:"POST",
//         method:"POST",
//         url:"../crud.php?what=SoldProduct",
//         data:json,
//         dataType:"JSON",
//         success:function(response)
//         {
         
//             window.scrollTo({"top" : 0, "behavior" : "smooth"});
//             if(response["success"]==true)
//             {
//                 $.bootstrapGrowl("<div class='text-center' style='background-color:#1eff1e;opacity:1;font-weight:bold'><h1>Success!</h1><p>"+response['message']+"</p></div>",
//                     {
//                         delay : 2500,
//                         width : 400,
//                         offset : {"from" : "top", "amount" : 20},
//                         allow_dismiss : false,
//                         align : "center",
//                     }); 
//                     setTimeout(function(){
//                         window.location.replace("product.php");
//                     },4000);
//             }
//             else
//             {
//                 $.bootstrapGrowl("<div class='text-center' style='background-color:#FF3232;opacity:1;font-weight:bold'><h1>Error!</h1><p>"+response['message']+"</p></div>",
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
// $(".block-active").click(function(){
//     var CurrentBtn = $(this);
//     $(this).attr("disabled", "disabled");
//     const json ={"id":$(this).attr("data-id")};
//     $.ajax({
//         type:"POST",
//         method:"POST",
//         url:"../crud.php?what=blockProduct",
//         data:json,
//         dataType:"JSON",
//         success:function(response){
            
//             window.scrollTo({"top" : 0, "behavior" : "smooth"});
//             if(response["success"]==true)
//             {
//                 $.bootstrapGrowl("<div class='text-center' style='background-color:#1eff1e;opacity:0.6;font-weight:bold'><h1>Success!</h1><p>"+response['message']+"</p></div>",
//                     {
//                         delay : 2500,
//                         width : 400,
//                         offset : {"from" : "top", "amount" : 20},
//                         allow_dismiss : false,
//                         align : "center",
//                     }); 
//                     setTimeout(function(){
//                         window.location.replace("product.php");
//                     },4000);
//             }
//             else
//             {
//                 $.bootstrapGrowl("<div class='text-center' style='background-color:#FF3232;opacity:1;font-weight:bold'><h1>Error!</h1><p>"+response['message']+"</p></div>",
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
$("#tblPlan").on("click", ".active-block", function(){
    var CurrentBtn = $(this);
    $(this).attr("disabled", "disabled");
    const json ={"id":$(this).attr("data-id")}; 

    $.ajax({
        type:"POST",
        method:"POST",
        url:"../crud.php?what=activeProduct",
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
                        window.location.replace("product.php");
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
            }

        }
    });
})
$("#tblPlan").on("click",".block-active", function(){
    var CurrentBtn = $(this);
    $(this).attr("disabled", "disabled");
    const json ={"id":$(this).attr("data-id")};
    $.ajax({
        type:"POST",
        method:"POST",
        url:"../crud.php?what=blockProduct",
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
                        window.location.replace("product.php");
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
            }
        }
    });   
});
// $(".active-block").click(function()
// {
//     var CurrentBtn = $(this);
//     $(this).attr("disabled", "disabled");
//     const json ={"id":$(this).attr("data-id")}; 

//     $.ajax({
//         type:"POST",
//         method:"POST",
//         url:"../crud.php?what=activeProduct",
//         data:json,
//         dataType:"JSON",
//         success:function(response)
//         {
            
//             window.scrollTo({"top" : 0, "behavior" : "smooth"});
//             if(response["success"]==true)
//             {
//                 $.bootstrapGrowl("<div class='text-center' style='background-color:#1eff1e;opacity:1;font-weight:bold'><h1>Success!</h1><p>"+response['message']+"</p></div>",
//                     {
//                         delay : 2500,
//                         width : 400,
//                         offset : {"from" : "top", "amount" : 20},
//                         allow_dismiss : false,
//                         align : "center",
//                     }); 
//                     setTimeout(function(){
//                         window.location.replace("product.php");
//                     },4000);
//             }
//             else
//             {
//                 $.bootstrapGrowl("<div class='text-center' style='background-color:#FF3232;opacity:1;font-weight:bold'><h1>Error!</h1><p>"+response['message']+"</p></div>",
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

$("#tblPlan").on("click" ,".viewmore", function(){
    const json={"id":$(this).attr("data-id")};
    
    $.ajax({
        type:"POST",
        method:"POST",
        url:"../crud.php?what=viewMoreProduct",
        data:json,
        dataType:"JSON",
        success:function(response){
            
            $("#detailTable").empty();
            $("#detailTable").append(response[0]);
        }
    });
})
// $(".viewmore").click(
// function()
// {
//     const json={"id":$(this).attr("data-id")};
    
//     $.ajax({
//         type:"POST",
//         method:"POST",
//         url:"../crud.php?what=viewMoreProduct",
//         data:json,
//         dataType:"JSON",
//         success:function(response){
            
//             $("#detailTable").empty();
//             $("#detailTable").append(response[0]);
//         }
//     }); 
// });

$("#tblPlan").on("click", ".editcategory", function(){
    const json={"id":$(this).attr("data-id")};
        console.log(json);
        $.ajax({
            type:"POST",
            method:"POST",
            url:"../crud.php?what=editProduct",
            data:json,
            dataType:"JSON",
            success:function(response){
            
                $("#editFrm").empty();
                $("#editFrm").append(response[0]);
            }
        });
})
// $(".editcategory").click(
//     function()
//     {
//         const json={"id":$(this).attr("data-id")};
//         console.log(json);
//         $.ajax({
//             type:"POST",
//             method:"POST",
//             url:"../crud.php?what=editProduct",
//             data:json,
//             dataType:"JSON",
//             success:function(response){
            
//                 $("#editFrm").empty();
//                 $("#editFrm").append(response[0]);
//             }
//         });
        
//     }
// );

$("#UpdateProduct").on("change", "#img1Upd", function(){
    $("#img2Upd").removeAttr("disabled");
});

$("#UpdateProduct").on("change", "#img2Upd", function(){
    $("#img3Upd").removeAttr("disabled");
});

$("#UpdateProduct").on("change", "#img3Upd", function(){
    $("#img4Upd").removeAttr("disabled");
});

$("#btnUpdateSubmit").click(function(event){
    if(!$("#updateForm").valid())
    {
        event.preventDefault();
    }
});