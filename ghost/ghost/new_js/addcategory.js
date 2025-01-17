$("#add_category_form").validate({
    rules : {
        "cat_name" : {
            required : true,
        },
        "cat_icon" : {
            required : true,
            accept : "jpg,png,jpeg",
        }
    },
    messages : {
        "cat_name" : {
            required : "<span class='text-danger' style='font-size:small'>Please enter category name</span>",
        },
        "cat_icon" : {
            required : "<span class='text-danger' style='font-size:small'>Please select category icon</span>",
            accept : "<span class='text-danger' style='font-size:small'Image can only be in jpg, jpeg, png format</span>",
        }
    }
});

$("#save").click(function(event){
    if(!$("#add_category_form").valid())
    {
        event.preventDefault();
    }
});

$("#edit_category_form").validate({
    rules : {
        "editCategory" : {
            required : true,
        },
    },
    messages : {
        "editCategory" : {
            required : "<span class='text-danger'>Please enter category name</span>",
        },
    }
});

$("#edit").click(function(event){
    if(!$("#editcategory").valid())
    {
        event.preventDefault();
    }
});

$("#categorytable").on("click", ".editcategory", function(){
    const json = {"id" : $(this).attr("data-id")};

    $.ajax({
        type : "POST",
        method : "POST",
        data : json,
        dataType : "JSON",
        url : "../crud.php?what=getcategory",
        success : function(response){
            $("#editCategory").val(response["name"]);
            $("#category_id").val(response["id"]);
        }
    })
})
// $(".editcategory").click(function(event){
//     const json = {"id" : $(this).attr("data-id")};

//     $.ajax({
//         type : "POST",
//         method : "POST",
//         data : json,
//         dataType : "JSON",
//         url : "../crud.php?what=getcategory",
//         success : function(response){
//             $("#editCategory").val(response["name"]);
//             $("#category_id").val(response["id"]);
//         }
//     })
// });

$("#updatemodalclose").click(function(event){
    event.preventDefault();
});