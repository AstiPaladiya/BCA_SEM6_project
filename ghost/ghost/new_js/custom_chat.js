$(".changeChat").click(function(){
    const json = {"pid" : $(this).attr("data-pid"), "uid" : $(this).attr("data-uid")};
    console.log(json);

    $.ajax({
        type : "POST",
        method : "POST",
        data : json,
        dataType : "JSON",
        url : "../crud.php?what=changeUserChat",
        success : function(response){
            $("#receiver_name").html(response['receiver_name']);
            $("#which_product").html(response['product_name']);

            $("#sendMessageBtn").removeAttr("disabled");

            $("#conversation-body").html(response.new_chat)

            $("#conversation-body").scrollTop($("#conversation-body").prop("scrollHeight"));
        }
    })
})

$("#messageTxt").keypress(function(e){
    var key = e.which;
    if(key == 13)
    {
        $("#sendMessageBtn").click();
    }
})

$("#sendMessageBtn").click(function(){
    if($("#messageTxt").val() != "" && $("#messageTxt").val() != null)
    {
        const json = {"message" : $("#messageTxt").val()};

        $.ajax({
            type : "POST",
            method : "POST",
            data : json,
            dataType : "JSON",
            url : "../crud.php?what=sendMessageFromChat",
            success : function(response){
                if(response.success)
                {
                    // document.getElementById("conversation-body").scrollIntoView({ behavior: 'smooth', block: 'end' });
                    // $("#conversation-body").scrollIntoView({ behavior: 'smooth', block: 'end' });
                    // $("#conversation-body").scrollTop(10000000);
                    $("#messageTxt").val("");
                    var today = new Date();
                    var date = today.getFullYear()+'-'+(today.getMonth()+1)+'-'+today.getDate();
                    var time = today.getHours() + ":" + today.getMinutes() + ":" + today.getSeconds();
                    var dateTime = date+' '+time;
                    $("#conversation-body").append('<div class="msg msg-sent"><div class="bubble"><div class="bubble-wrapper style_sendmsg" style="background-color:white;color:black;border:1px solid lightgrey;"><span>'+ json.message +'</span></div><div class="text-right"><span style="color:black;font-size:x-small;">'+ dateTime +'</span></div></div></div>');

                    $("#conversation-body").scrollTop($("#conversation-body").prop("scrollHeight"));
                }
            }
        })
    }
});

setInterval(() => {
    $.ajax({
        type : "POST",
        method : "POST",
        dataType : "JSON",
        url : "../crud.php?what=getNewChatsForUser",
        success : function(response){
            if(response.success)
            {
                $("#conversation-body").append(response.new_chat);
                $("#conversation-body").scrollTop($("#conversation-body").prop("scrollHeight"));
            }
        }
    })
}, 1000);

$("#conversation-body").scrollTop($("#conversation-body").prop("scrollHeight"));