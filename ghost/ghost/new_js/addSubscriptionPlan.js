$("#subscriptionPlan").validate({
    rules:{
        "subName":{
            required:true,
            pattern:"^[A-Za-z ]+$",
        },
        "subDes":{
            required:true,
        },
        "subPrice":{
            required:true,
            min:1,
          
        },
        "subTime":{
            required:true,
            min:1,
        }
    },
    messages:{
        "subName":{
            required:"<span class='text-danger'  style='font-size:small'>Please enter subscription name</span>",
            pattern:"<span class='text-danger'  style='font-size:small'>Please enter only a-z and A-Z charachter</span>",
        },
        "subDes":{
            required:"<span class='text-danger'  style='font-size:small'>Please enter subscription description</span>",
        },
        "subPrice":{
            required:"<span class='text-danger'  style='font-size:small'>Please enter subscription price</span>",
            min : "<span class='text-danger' style='font-size:small'>Price should be minimum 1</span>",

        },
        "subTime":{
            required:"<span class='text-danger'  style='font-size:small'>Please enter time in days</span>",
            min : "<span class='text-danger' style='font-size:small'>Duration should be minimum 1</span>",

        }
    },
});
$("#btnSubmit").click(
    function(event)
    {
        if($("#subscriptionPlan").valid())
        {
            event.preventDefault();
             var CurrentBtn = $(this);
            $(this).attr("disabled", "disabled");
            const json={"name":$("#subName").val(),"des":$("#subDes").val(),"price":$("#subPrice").val(),"time":$("#subTime").val()};
           
            $.ajax({
                type:"POST",
                method:"POST",
                url:"../crud.php?what=addSubscription",
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
                        },2500);

                    }
                    else
                    {
                        $.bootstrapGrowl("<div class='text-center' style='background-color:#FF3232;opacity:1;font-weight:bold><h1>Error!</h1><p>"+response['message']+"</p></div>",
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
    $(".active_block").click(
    function()
    {
        var CurrentBtn = $(this);
         $(this).attr("disabled", "disabled");
        const json = {"id" : $(this).attr("data-id"), "status" : "Block"};

        $.ajax({
            type : "POST",
            method : "POST",
            data : json,
            dataType : "JSON",
            url : "../crud.php?what=activesubs",
            success : function(response){
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
                    $.bootstrapGrowl("<div class='text-center' style='background-color:#FF3232;opacity:1;font-weight:bold><h1>Error !</h1><p>"+response['message']+"</p></div>",
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
    $(".block_active").click(
    function()
    {
        var CurrentBtn = $(this);
        $(this).attr("disabled", "disabled");
        const json={"id":$(this).attr("data-id"),"status":"Active"};

            $.ajax({
                type:"POST",
                method:"POST",
                url:"../crud.php?what=activesubs",
                data:json,
                dataType:"JSON",
                success:function(response)
                {
                    window.scrollTo({"top" : 0, "behavior" : "smooth"});
                        if(response["success"])
                        {
                            $.bootstrapGrowl("<div class='text-center' style='background-color:#1eff1e;opacity:0.6;font-weight:bold'><h1>Success !</h1><p>"+response['message']+"</p></div>",
                                {
                                    delay : 4000,
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
                            $.bootstrapGrowl("<div class='text-center' style='background-color:#FF3232;opacity:0.6;font-weight:bold><h1>Error !</h1><p>"+response['message']+"</p></div>",
                            {
                                delay : 4000,
                                width : 400,
                                offset : {"from" : "top", "amount" : 20},
                                allow_dismiss : false,
                                align : "center",
                            }); 
                        }
                }
            });
 });
//  view subscription plan
$(".viewbutton").click(
    function()
    {
        const json={"id":$(this).attr("data-id")};
        var bt = $(this);
        $.ajax({
            type:"POST",
            method:"POST",
            url:"../crud.php?what=viewSubscription",
            data:json,
            dataType:"JSON",
            success:function(response)
            {
                // console.log($($(bt).parent().parent().find("td")[0]).text());
                $("#viewMoreHeader").text($($(bt).parent().parent().find("td")[0]).text() + " Current User Details");
                $("#subscri").empty();
                $("#subscri").append(response[0]);
               
            }
        });
    });