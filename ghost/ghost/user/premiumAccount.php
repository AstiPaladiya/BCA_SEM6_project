<?php
    session_start();
    include("../connection.php");

    $page = "Home";

    if(!isset($_SESSION['front_user_id']))
    {
        header("Location:../user_login.php");
    }
    else if(!$_SESSION['front_user_premium'])
    {?>
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <title>Upgrade to Premium</title>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <?php
                include("include.php");
            ?>
            <link rel="icon" type="image/png" href="../image/logo.png" class="rounded-circle"/>

            <style>
                .heart_nav{
                    font-size:180%;
                    color:black;
                    /* background-color: white;
                    border-radius: 50%;
                    padding-top:2%;
                    padding-bottom: 2%;
                    padding-left: 2%;
                    padding-right:2%; */
                    text-align: center;
                }
                .subLogin
                {
                    color:cornflowerblue;
                    font-size:120%;
                }
                .main-menu{
                    font-weight:600;
                    font-family: Georgia, 'Times New Roman', Times, serif;
                    /* letter-spacing: 2px; */
                }
                .login:hover
                {
                    background-color:orange;
                    color:white;
                    border: 3px solid black; 
                    /* box-shadow: 3px 3px 5px 2px black; */
                    animation: pulse 1s ease-in-out;
                    transition: .3s;
                }
                .bg10{
                    background-color: red !important;
                }
            </style>
        </head>
        <body class="animsition">

            <?php
                include("navbar.php");
            ?>
            <!-- content page -->
            <div class="bg0 p-t-120 p-b-80">
                <div class="container">
                    <div class="row">
                        <?php
                            $query = mysqli_query($con, "SELECT * FROM `subscription_master` WHERE `status` = 'Active'");

                            while($row = mysqli_fetch_array($query))
                            {?>
                                <div class="col-lg-4 col-md-12">
                                    <div class="card">
                                        <h3 class="card-header"><?php echo $row['subscription_name'] ?></h3>
                                        <div class="card-body">
                                            <h5 class="card-title">Description</h5>
                                            <p class="card-text"><?php echo $row['description'] ?></p>

                                            <br/>
                                            <h5>Price : <?php echo $row['rate'] ?></h5>
                                        </div>
                                        <div class="card-footer">
                                            <button class="btn btn-info plansID" data-price="<?php echo $row['rate'] ?>" data-description="<?php echo $row['description'] ?>" data-pid="<?php echo $row['id'] ?>">Select Plan</button>
                                        </div>
                                    </div>
                                </div>
                            <?php
                            }
                        ?>
                    </div>
                </div>
            </div>
        
            <!-- Footer -->
            <?php
                include("footer.php");
            ?>
            

            <!-- Back to top -->
            <div class="btn-back-to-top bg0-hov" id="myBtn">
                <span class="symbol-btn-back-to-top">
                    <span class="lnr lnr-chevron-up"></span>
                </span>
            </div>

            

        <!--===============================================================================================-->	
            <script src="vendor/jquery/jquery-3.2.1.min.js"></script>
        <!--===============================================================================================-->
            <script src="vendor/animsition/js/animsition.min.js"></script>
        <!--===============================================================================================-->
            <script src="vendor/bootstrap/js/popper.js"></script>
            <script src="vendor/bootstrap/js/bootstrap.min.js"></script>
        <!--===============================================================================================-->
            <script src="vendor/select2/select2.min.js"></script>
        <!--===============================================================================================-->
            <script src="vendor/daterangepicker/moment.min.js"></script>
            <script src="vendor/daterangepicker/daterangepicker.js"></script>
        <!--===============================================================================================-->
            <script src="vendor/slick/slick.min.js"></script>
            <script src="js/slick-custom.js"></script>
        <!--===============================================================================================-->
            <script src="vendor/parallax100/parallax100.js"></script>
        <!--===============================================================================================-->
            <script src="vendor/lightbox2/js/lightbox.min.js"></script>
        <!--===============================================================================================-->
            <script src="vendor/isotope/isotope.pkgd.min.js"></script>
        <!--===============================================================================================-->
            <script src="vendor/sweetalert/sweetalert.min.js"></script>
        <!--===============================================================================================-->
            <script src="vendor/perfect-scrollbar/perfect-scrollbar.min.js"></script>
        <!--===============================================================================================-->
            <script src="js/main.js"></script>

            <!-- Bootstrapgrowl -->
            <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-growl/1.0.0/jquery.bootstrap-growl.min.js" integrity="sha512-pBoUgBw+mK85IYWlMTSeBQ0Djx3u23anXFNQfBiIm2D8MbVT9lr+IxUccP8AMMQ6LCvgnlhUCK3ZCThaBCr8Ng==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

            <!-- Razorpay -->
            <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
            <script src="../new_js/user_footer.js"></script>

            <script>
                $(document).ready(function(){
                    $(".plansID").click(function(){
                        var currentBtn = $(this);

                        var planPrice = $(this).attr("data-price");
                        var desc = $(this).attr("data-description");
                        var pid = $(this).attr("data-pid");

                        const json = {"pid" : pid}
                        $.ajax({
                            type : "POST",
                            method : "POST",
                            dataType : "JSON",
                            url : "../crud.php?what=getCurrentUserDetailsForUserToPremium",
                            success : function(response){
                                var options = {
                                "key": "rzp_test_mObd3U81dn4dzH",
                                "amount": Math.round(planPrice * 100), // Example: 2000 paise = INR 20
                                "name": "Ghost Marketer",
                                "description": desc,
                                "image": "../image/logo.png",// COMPANY LOGO
                                "handler": function (response) {
                                    $.ajax({
                                    type : "POST",
                                    method : "POST",
                                    data : json,
                                    dataType : "JSON",
                                    url : "../crud.php?what=userUpgradeToPremium",
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

                                        $.ajax({
                                            type : "POST",
                                            method : "POST",
                                            dataType : "JSON",
                                            url : "../crud.php?what=sendUpgradationMail",
                                        })
                        
                                        setTimeout(function(){
                                            window.location.replace("index.php");
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
                                "name": response.name, // pass customer name
                                "email": response.email,// customer email
                                "contact": response.phone //customer phone no.
                                },
                                "theme": {
                                    "color": "#15b8f3" // screen color
                                }
                            };
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
                })
            </script>

        </body>
        </html>
    <?php
    }
?>