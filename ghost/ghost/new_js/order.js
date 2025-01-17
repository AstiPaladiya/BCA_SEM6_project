$("#reqFrm").validate({
    rules:
    {
        "reasonReturn":
        {
            required:true,
        },
        "txtFile":{
            required : true,
            // accept : "jpg,png,jpeg",
        },
    },
    messages:
    {
        "reasonReturn":
        {
            required:"<span class='text-danger' style='font-size:small' hidden>Please select one of these option</span>",
        },
        "txtFile" : {
            required : "<span class='text-danger' style='font-size:small'>Select compulsory first Product image is required</span>",
            // accept : "<span class='text-danger' style='font-size:small'>Image can only be in jpg, jpeg, png format</span>",
        },
    },
    highlight : function(tags)
    {
        if(tags.type == "radio")
        {
            $("#OptionError").show();
        }
    },
    unhighlight : function(tags)
    {
        if(tags.type == "radio")
        {
            $("#OptionError").hide();
        }
    }
});
// View More About order
$(".eyeView").click(function(){
    const json={"id":$(this).attr("data-id")};
    console.log(json);
    $.ajax({
        type:"POST",
        method:"POST",
        url:"../crud.php?what=ViewMore",
        data:json,
        dataType:"JSON",
        success:function(response){
            
            $("#detailTable").empty();
            $("#detailTable").append(response[0]);
        }
    });
});
// vlidation for send request

// return order
// $('input[name="name_of_your_radiobutton"]:checked').click(function(){

// })
// $("#txtFile").change(function(){
//     if($("#btnInpt").val()!=null && $("#btnInpt").val() != "")
//     {
//         // var fileInpt = $("#btnInpt");
//         var ofReader=new FileReader();
//         ofReader.readAsDataURL($("#btnInpt")[0].files[0]);
//         ofReader.onload=function(evt){
//             $("#reImg").attr("src", evt.target.result);
//         }
//     }
// });

$("#tbl").on("click", ".returnBtn", function(){
    $(".rqu").attr("rqdata-id", $(this).attr("data-id"));
});
// $(".returnBtn").click(function(){
//     $(".rqu").attr("rqdata-id", $(this).attr("data-id"));
// })

// Return Modal request click event
$(".rqu").click(
    function(event)
    {
        event.preventDefault();
        if($("#reqFrm").valid())
        {
            var id=$(".rqu").attr("rqdata-id");
            var mes=$('input[name="reasonReturn"]:checked').val();
           
            var file_data = $('#txtFile').prop('files')[0];
            var gambar = new FormData();
            gambar.append('file', file_data);
            var formData = new FormData();
            formData.append('file', $("#txtFile")[0].files[0]);
            formData.append("id", id);
            formData.append("mes", mes);
            
            $.ajax({
                type : "POST",
                method : "POST",
                data : formData,
                cache:false,
                contentType:false,
                processData:false,
                enctype:'multipart/form-data',
                url : "../crud.php?what=returnRequest",
                success : function(response)
                {
                    var resp = $.parseJSON(response);

                    if(resp['success'] == true)
                    {
                        window.location.replace("order.php");
                    }
                    else
                    {
                        $.bootstrapGrowl("<div class='text-center' style='background-color:#FF3232;opacity:1;font-weight:bold'><h1>Error!</h1><p>"+resp['message']+"</p></div>",
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
    }
);


// cancle return order request
$("#tbl").on("click", ".cancleBtn", function(){
    const json={"id":$(this).attr("data-id")};
    console.log(json);
    $.ajax({
        type:"POST",
        method:"POST",
        url:"../crud.php?what=cancleReq",
        data:json,
        dataType:"JSON",
        success:function(response){
            
            window.location.reload();
        }
    });
})
// $(".cancleBtn").click(function(){
//     const json={"id":$(this).attr("data-id")};
//     console.log(json);
//     $.ajax({
//         type:"POST",
//         method:"POST",
//         url:"../crud.php?what=cancleReq",
//         data:json,
//         dataType:"JSON",
//         success:function(response){
            
//             window.location.reload();
//         }
//     });
// });
