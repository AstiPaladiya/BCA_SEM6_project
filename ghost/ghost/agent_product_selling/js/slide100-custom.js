(function ($) {
    // "use strict";
    $(document).ready(function() {
        var img1 = "";
        var img2 = "";
        var img3 = "";
        var img4 = "";
        $.ajax({
            type : "POST",
            method : "POST",
            dataType : "JSON",
            url : "../crud.php?what=GetSpecificProductImagesForAgentSellingPage",
            success : function(response){
                // console.log(response);

                img1 = response.img1;
                img2 = response.img2;
                img3 = response.img3;
                img4 = response.img4;
            }
        })
        $('#slide100-01').slide100({
            autoPlay: "false",
            timeAuto: 3000,
            deLay: 400,

            linkIMG: [
            img1,
            img2,
            img3,
            img4
            ],

            linkThumb: [
            img1,
            img2,
            img3,
            img4
            ]
        });
    });
})(jQuery);