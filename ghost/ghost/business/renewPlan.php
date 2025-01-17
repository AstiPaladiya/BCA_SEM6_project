<?php
    $page = "Renew";
    session_start();
    include("../connection.php");
    if(!isset($_SESSION["name"]))
    {
        if(!isset($_SESSION["mail"]))
        {
            if(!isset($_SESSION["role"]))
            {
                if(!isset($_SESSION["user_id"]))
                {
                    header("Location:../bussiness_login.php");
                }
            }
        }
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    <title>Ghost Marketer Dashboard</title>

    <!-- Favicon -->
    <link rel="shortcut icon" href="../image/logo.png">

    <!-- page css -->

    <!-- Core css -->
    <link href="../assets/css/app.min.css" rel="stylesheet">
    <style>
        /* .tbl_main
        {
            box-shadow:4px 4px  12px 1px grey; */
            
            /* box-shadow:0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19); */
            /* box-shadow:0 2px 4px 0 rgba(0, 0, 0, 0.2), 0 2px 10px 0 rgba(0, 0, 0, 0.19);
            padding-top: 15px;
            padding-bottom:15px;
            padding-left: 15px;
            padding-right: 15px;
            background-color: white;
            
        } */
        .main-content{
            background-color:whitesmoke;
        }
        .inpt_minifrm{
            /* background-color:whitesmoke;  */
            border:1px solid lightgrey;
        }
        .btn_styleprime{
            background-color: rgba(0,160,0,0.2);
            color:rgba(0, 160, 110, 1);
            font-weight:bold;
            text-align: center;
            font-size:small;
            padding-top: 2px;
            padding-right: 2px; 
            padding-left: 1px;
            /* padding-bottom: 2px; */
            border-radius: 100%;
        }
        .btn_close:hover{
            background-color: rgba(197, 239, 247,0.8);
            color:rgba(68, 108, 240,1);
            font-weight:500;
            border:0px;

       }
    </style>
</head>

<body>
    <div class="app">
        <div class="layout">
            <!-- Header START -->
            <?php
                include("header.php");
            ?>
            <!-- Header END -->

            <!-- Side Nav START -->
            <?php
                include("sidebar.php");
            ?>
            <!-- Side Nav END -->

            <!-- Page Container START -->
            <div class="page-container">
                
            <div class="main-content">
                <div class="row align-items-center" id="monthly-view">
                     <?php
                        $query = mysqli_query($con, "SELECT * FROM `subscription_master` WHERE `status` = 'Active'");
                        while($row = mysqli_fetch_array($query))
                        {?>
                            <div class="col-md-4">
                                <div class="card">
                                    <div class="card-body inpt_minifrm tbl_main">
                                        <div class="d-flex justify-content-between p-b-20 border-bottom">
                                            <div class="media align-items-center">
                                                <div class="avatar avatar-blue avatar-icon" style="height: 55px; width: 55px;">
                                                    <i class="anticon anticon-coffee font-size-25" style="line-height: 55px"></i>
                                                </div>
                                                <div class="m-l-15">
                                                    <h2 class="font-weight-bold font-size-30 m-b-0">
                                                    <span><i class="fas fa-rupee-sign pr-1" ></i><?php echo $row['rate'] ?></span>
                                                        <span class="font-size-13 font-weight-semibold" style="color:grey;">/
                                                            <?php
                                                                if($row['time_perioud'] <= 30)
                                                                {
                                                                    echo $row['time_perioud'] . " Days";
                                                                }
                                                                else if($row['time_perioud'] > 30 && $row['time_perioud'] <= 360)
                                                                {
                                                                    echo ($row['time_perioud'] / 30) . " Months";
                                                                }
                                                                else
                                                                {
                                                                    echo (($row['time_perioud'] / 30) / 12) . " Years";
                                                                }
                                                            ?>
                                                        </span>
                                                    </h2>
                                                    <h4 class="m-b-0"><?php echo $row['subscription_name'] ?></h4>
                    
                                                </div>
                                            </div>
                                        </div>
                                        <ul class="list-unstyled m-v-30">
                                            <li class="m-b-20">
                                                <div class="d-flex justify-content-between">
                                                    <span class="text-dark font-weight-semibold"><?php echo $row['description'] ?></span>
                                                    <div class="font-size-16">
                                                        <i class="anticon anticon-check btn_styleprime"></i>
                                                    </div>
                                                </div>
                                            </li>
                                            <!--<li class="m-b-20">
                                                <div class="d-flex justify-content-between">
                                                    <span class="text-dark font-weight-semibold">200 MB of Spaces</span>
                                                    <div class="font-size-16">
                                                        <i class="anticon anticon-check btn_styleprime"></i>
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="m-b-20">
                                                <div class="d-flex justify-content-between">
                                                    <span class="text-dark font-weight-semibold">Unlimited Bandwidth</span>
                                                    <div class="font-size-16">
                                                        <i class="anticon anticon-check btn_styleprime"></i>
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="m-b-20">
                                                <div class="d-flex justify-content-between">
                                                    <span class="text-dark font-weight-semibold">5 Add on Domains</span>
                                                    <div class="font-size-16">
                                                        <i class="anticon anticon-check btn_styleprime"></i>
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="m-b-20">
                                                <div class="d-flex justify-content-between">
                                                    <span class="text-dark font-weight-semibold">Free Microsoft Office 365</span>
                                                    <div class="font-size-16">
                                                        <i class="anticon anticon-check btn_styleprime"></i>
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="m-b-20">
                                                <div class="d-flex justify-content-between">
                                                    <span class="text-dark font-weight-semibold">Smart Sync</span>
                                                    <div class="font-size-16">
                                                        <i class="anticon anticon-check btn_styleprime"></i>
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="m-b-20">
                                                <div class="d-flex justify-content-between">
                                                    <span class="text-dark font-weight-semibold">24/7 Support</span>
                                                    <div class="font-size-16">
                                                        <i class="anticon anticon-check btn_styleprime"></i>
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="m-b-20">
                                                <div class="d-flex justify-content-between">
                                                    <span class="text-dark font-weight-semibold">1 Cloud Power</span>
                                                    <div class="font-size-16">
                                                        <i class="anticon anticon-check btn_styleprime"></i>
                                                    </div>
                                                </div>
                                            </li>-->
                                        </ul> 
                                        <div class="text-center">
                                            <button class="btn btn-primary btn_close m-r-5 planSelectBtn" data-desc="<?php echo $row['description'] ?>" data-price="<?php echo $row['rate'] ?>" data-days="<?php echo $row['time_perioud'] ?>" data-pid="<?php echo $row['id'] ?>">Choose Plane</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php
                        }
                    ?>
                <!-- <div class="row">
                    <?php
                        // $query = mysqli_query($con, "SELECT * FROM `subscription_master` WHERE `status` = 'Active'");
                        // while($row = mysqli_fetch_array($query))
                        //{?>
                            <div class="col-4">
                                <div class="card">
                                    <div class="card-header">
                                        <h5 class="card-title text-center"><?php //echo $row['subscription_name'] ?></h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="row mb-5">
                                            <div class="col-12"><?php //echo$row['description'] ?></div>
                                        </div>
                                        <div class="row">
                                            <div class="col-6">Rate :</div>
                                            <div class="col-6"><?php //echo $row['rate'] ?></div>
                                        </div>
                                        <div class="row">
                                            <div class="col-6">Duration :</div>
                                            <div class="col-6"><?php
                                                // if($row['time_perioud'] <= 30)
                                                // {
                                                //     echo $row['time_perioud'] . " Days";
                                                // }
                                                // else if($row['time_perioud'] > 30 && $row['time_perioud'] <= 360)
                                                // {
                                                //     echo ($row['time_perioud'] / 30) . " Months";
                                                // }
                                                // else
                                                // {
                                                //     echo (($row['time_perioud'] / 30) / 12) . " Years";
                                                // }
                                            ?></div>
                                        </div>
                                    </div>
                                    <div class="card-footer text-center">
                                        <button class="btn btn-warning btn-tone m-r-5 planSelectBtn" data-desc="<?php //echo $row['description'] ?>" data-price="<?php //echo $row['rate'] ?>" data-days="<?php //echo $row['time_perioud'] ?>" data-pid="<?php //echo $row['id'] ?>">Upgrade Your Plan</button>
                                    </div>
                                </div>
                            </div>
                        <?php
                        //}
                    ?>
                </div> -->
            </div>
          
                <!-- Footer START -->
                    <?php include("footer.php"); ?>
                <!-- Footer END -->
            </div>
            <!-- Page Container END -->

            <!-- Quick theme START -->
            <?php include("theme.php"); ?>
            <!-- Quick theme END -->
        </div>
    </div>

    <?php include("include.php"); ?>
    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
    <script>
        $(".planSelectBtn").click(function(){
            const paymentJson = {"price" : $(this).attr("data-price"), "days" : $(this).attr("data-days"), "pid" : $(this).attr("data-pid"), "desc" : $(this).attr("data-desc")};

            $.ajax({
                type : "POST",
                method : "POST",
                dataType : "JSON",
                url : "../crud.php?what=getBusinessDetailsForPlanRenew",
                success : function(response){
                    paymentJson.userId = response.id;
                    var options = {
                        "key": "rzp_test_mObd3U81dn4dzH",
                        "amount": Math.round(paymentJson.price * 100), // Example: 2000 paise = INR 20
                        "name": "Ghost Marketer",
                        "description": paymentJson.desc,
                        "image": "../image/logo.png",// COMPANY LOGO
                        "handler": function (response) {
                            $.ajax({
                                type : "POST",
                                method : "POST",
                                data : paymentJson,
                                dataType : "JSON",
                                url : "../crud.php?what=renewExistingBusinessPlan",
                                success : function(response){
                                    window.scrollTo({top: 0, behavior: 'smooth'});
                                    if(response["success"])
                                    {
                                        $.bootstrapGrowl("<div class='text-center'><h1>Success</h1><p>"+ response["message"] +"</p></div>",{
                                        type : "success",
                                        delay : 2500,
                                        align : "center",
                                        width : 400,
                                        allow_dismiss : false,
                                        });
                    
                                        setTimeout(function(){
                                        //set business login page here
                                        window.location.replace("../bussiness_login.php");
                                        },2500);
                                    }
                                    else
                                    {
                                        $.bootstrapGrowl("<div class='text-center'><h1>Error</h1><p>"+ response["message"] +"</p></div>",{
                                        type : "danger",
                                        delay : 2500,
                                        align : "center",
                                        width : 400,
                                        allow_dismiss : false,
                                        });
                                    }
                                }
                            });
                            // AFTER TRANSACTION IS COMPLETE YOU WILL GET THE RESPONSE HERE.
                        },
                        "prefill": {
                            "name": response.owner_name, // pass customer name
                            "email": response.email,// customer email
                            "contact": response.phone //customer phone no.
                            },
                        "theme": {
                            "color": "#15b8f3" // screen color
                        }
                    };
                    console.log(options);
                    var propay = new Razorpay(options);
                    propay.on("payment.failed", function(response){
                    //alert(response.error.description);
                    $.bootstrapGrowl("<div class='text-center'><h1>Error</h1><p>"+ response.error.description +"</p></div>",{
                        type : "danger",
                        delay : 2500,
                        align : "center",
                        width : 400,
                        allow_dismiss : false,
                    })
                    });
                    propay.open(); 
                }
            })
        })
    </script>
</body>

</html>