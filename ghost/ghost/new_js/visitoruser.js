$("#visitor").on("click", ".btnViewMore", function(){
    const json={"year":$(this).attr("data-id")};
        // console.log(json);
    $.ajax({
        type:"POST",
        method:"POST",
        url:"../crud.php?what=visitoruser",
        data:json,
        dataType:"JSON",
        success:function(response){
            console.log(response);
            $("#monwisedetai").empty();
            $.each(response,function(key,value){
                    $("#monwisedetai").append("<tr><td>"+ key +"</td><td>"+ value +"</td></tr>");
            });
        }
        
    });
})
// $(".btnViewMore").click(
//     function()
//     {
       
//         const json={"year":$(this).attr("data-id")};
//         // console.log(json);
//         $.ajax({
//             type:"POST",
//             method:"POST",
//             url:"../crud.php?what=visitoruser",
//             data:json,
//             dataType:"JSON",
//             success:function(response){
//                 console.log(response);
//                 $("#monwisedetai").empty();
//                 $.each(response,function(key,value){
//                         $("#monwisedetai").append("<tr><td>"+ key +"</td><td>"+ value +"</td></tr>");
//                 });
//             }
            
//         });
//     }
// );