
            // $("#theme").click(
            //     function()
            //     {
            //         var value1=$("#theme").val();
            //         alert(value1);
                    // var value2=$("#theme2").val();
                    // alert(value2);
                    // if(value1 == "primary")
                    // {
                    //     $(".header").addClass("green");
                    //       $(".header").removeClass("blue");
                    // }
                    // else
                    // {
                    //     $(".header").addClass("blue");
                    //     $(".header").removeClass("green");
                    // } 
                // });
                $("#theme").click(
                    function()
                    {
                        var value1=$("#theme").val();
                        alert(value1);
                        if(value1 == "danger")
                        {
                            $(".header").addClass("blue");
                            $(".header").removeClass("green");
                        } 
                    });