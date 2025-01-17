// Add wishlist
$(".btn-wishlist").click(function(){
    const json = {"product_id" : $(this).attr("data-pid")};
    console.log(json);
    $.ajax({
        type : "POST",
        method : "POST",
        data : json,
        dataType : "JSON",
        url : "../crud.php?what=wishlistAUserItem",
        success : function(response){
            if(response.success)
            {
                window.location.reload();
            }
            else
            {
                window.location.replace(response.url);
            }
        }
    });
});
// remove wishlist
$(".btn-unwishlist").click(
    function()
    {   
        const json={"pid":$(this).attr("removedata-id")};
        console.log(json);
        $.ajax({
            type:"POST",
            method:"POST",
            url:"../crud.php?what=removeWishList",
            data:json,
            dataType:"JSON",
            success:function(response){
                if(response.success)
                {
                    window.location.reload();
                }
                else
                {
                    $.bootstrapGrowl("<div class='text-center' style='background-color:#FF3232;opacity:1;font-weight:bold'><h1>Error!</h1><p>"+ response["message"] +"</p></div>",{
                        delay : 2500,
                        allow_dismiss : false,
                        width : 400,
                        align : "center",
                    });
                }
            }
        });
    });
// Add to cart
$(".chkCart").click(
function()
{
    const json={"pid":$(this).attr("addData-id")};
    console.log(json);
    $.ajax({
        type:"POST",
        method:"POST",
        url:'../crud.php?what=checkAddToCart',
        data:json,
        dataType:"JSON",
        success:function(response)
        {
            console.log(response);
            if(response.success)
            {
                window.location.reload();
            }
            else
            {
                window.location.replace(response.url);
            }  
        }
    });
});
// Delete cart
$(".deleteCart").click(
    function()
    {
        const json={"pid":$(this).attr("removeData-id")};
        console.log(json);
        $.ajax({
            type:"POST",
            method:"POST",
            url:"../crud.php?what=removeCartList",
            data:json,
            dataType:"JSON",
            success:function(response)
            {
                if(response.success)
                {
                    window.location.reload();
                }
                else
                {
                    $.bootstrapGrowl("<div class='text-center' style='background-color:#FF3232;opacity:1;font-weight:bold'><h1>Error!</h1><p>"+ response["message"] +"</p></div>",{
                        delay : 2500,
                        allow_dismiss : false,
                        width : 400,
                        align : "center",
                    }); 
                }
            }
        });
    });

    //Css
    $(".chkViewMore").mouseenter(function(){
        $($(this).find("a")).css("color", "black");
    })
    $(".chkViewMore").mouseleave(function(){
        $($(this).find("a")).css("color", "white");
    })
    // check on view more button
    $(".chkViewMore").click(
        function(event)
        {
            //New
            event.preventDefault();
            var href = $($(this).find("a")).attr("href");
            window.location.href = href;

            //Old
            // const json={"id":$(this).attr("data-id")};
            // console.log(json);
            // $.ajax({
            //     type:"POST",
            //     method:"POST",
            //     url:"../crud.php?what=checkViewMore",
            //     data:json,
            //     dataType:"JSON",
            //     success:function(response){
            //         if(response.success)
            //         {
            //             // window.location.replace(response.url);
            //             window.location.href = response.url;
            //         }
            //         else
            //         {
            //             // window.location.replace(response.url);
            //             window.location.href = response.url;
            //         }
            //     }
            // });
        });

$("#talkBtn").click(function(){
    const params = new URLSearchParams(window.location.search);
    
    const json = {};
    json['pid'] = params.get("id");

    $.ajax({
        type : "POST",
        method : "POST",
        data : json,
        dataType : "JSON",
        url : "../crud.php?what=setToSession",
        success : function(response){
            window.location.href = response.url;
        }
    })
})

$("#sendToLogin").click(function(){
    window.location.href = "../user_login.php";
})