<?php
    session_start();
    include("../connection.php");
    if(!isset($_SESSION['mark_id']) || !isset($_SESSION['comm']) || !isset($_SESSION['product_id']))
    {
        echo "<script>alert('URL not available. Please ask agent to share link again.');</script>";
    }
    else
    {?>

        <!DOCTYPE html>
        <html lang="en">
        <?php
            include("links_include.php");
        ?>
        <body class="animsition">
            <!-- Getting Product Details -->
            <?php
                $query = mysqli_query($con, "SELECT * FROM `listing_products` WHERE `id` = ". $_SESSION['product_id'] ."");
                $result = mysqli_fetch_array($query);
            ?>

            <!-- Order Quantity COnfirmation Modal -->
            <!-- Modal -->
            <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Confirm Order</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <?php
                            $tempQuery = mysqli_query($con, "select * from listing_products where id = ". $_SESSION['product_id'] ."");
                            $tempResult = mysqli_fetch_array($tempQuery);
                        ?>
                        <div class="row">
                            <div class="col-6">
                                Product Name : 
                            </div>
                            <div class="col-6">
                                <?php
                                    echo $tempResult['product_name'];
                                ?>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-6">
                                Quantity : 
                            </div>
                            <div class="col-6">
                                <span id="qty_display"></span>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-6">
                                Product Price : 
                            </div>
                            <div class="col-6">
                                <?php
                                    echo $tempResult['price'];
                                ?>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-6">
                                Total Amount : 
                            </div>
                            <div class="col-6">
                                <span id="total_amount"></span>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" id="confirmOrder" class="btn btn-info">Confirm</button>
                    </div>
                    </div>
                </div>
            </div>

            <!-- Login Modal -->
            <!-- Modal -->
            <div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <form method="post" id="loginUser">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle">User Login</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="usrEmail" class="form-label">Email ID :</label>
                                <input type="email" name="usrEmail" id="usrEmail" class="form-control" placeholder="Enter Registered Email ID">
                            </div>
                            <div class="form-group">
                                <label for="usrPas" class="form-label">Password :</label>
                                <input type="password" name="usrPas" id="usrPas" class="form-control" placeholder="Enter Password Here">
                            </div>
                            <hr>
                            <a href="#" id="registerAnchor" class="text-danger" style="font-size: smaller;" data-target="#registrationModal" data-toggle="modal">Don't Have an account ? Register Here</a>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="button" id="login" name="login" class="btn btn-info">Login</button>
                        </div>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Registration Modal -->
            <!-- Modal -->
            <div class="modal fade" id="registrationModal" tabindex="-1" role="dialog" aria-labelledby="registrationModal" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <form id="registerUser" method="post">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle">Registration for User</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <fieldset id="f1">
                                <div class="form-group">
                                    <label for="uName" class="form-label">Name : </label>
                                    <input type="text" name="uName" id="uName" class="form-control">
                                </div>
                                
                                <div class="form-group">
                                    <label for="uEmail" class="form-label">Email : </label>
                                    <input type="email" name="uEmail" id="uEmail" class="form-control">
                                </div>
    
                                <div class="form-group">
                                    <label for="uPass" class="form-label">Password : </label>
                                    <input type="password" name="uPass" id="uPass" class="form-control">
                                </div>

                                <div class="form-group">
                                    <label for="uPhone" class="form-label">Phone Number : </label>
                                    <input type="number" name="uPhone" id="uPhone" class="form-control">
                                </div>
                            </fieldset>
                            <fieldset id="f2" style="display:none;">
                                <div class="form-check ml-3">
                                    <input type="radio" name="gender" id="male" value="Male" class="form-check-input">
                                    <label class="form-check-label" for="male">Male</label>
                                </div>
                                <div class="form-check ml-3">
                                    <input type="radio" name="gender" id="female" value="Female" class="form-check-input">
                                    <label class="form-check-label" for="female">Female</label>
                                </div>
                                <div class="form-check ml-3">
                                    <input type="radio" name="gender" id="other" value="Other" class="form-check-input">
                                    <label class="form-check-label" for="other">Other</label>
                                </div>


                                <div class="form-group">
                                    <label for="uAddress" class="form-label">Address : </label>
                                    <textarea name="uAddress" id="uAddress" cols="15" rows="3" class="form-control"></textarea>
                                </div>

                                <div class="form-group">
                                    <label for="pincode" class="form-label">Pincode : </label>
                                    <input type="number" name="pincode" id="pincode" class="form-control">
                                </div>

                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="state">State : </label>
                                            <input type="text" name="state" id="state" class="form-control" readonly>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="state">City : </label>
                                            <input type="text" name="city" id="city" class="form-control" readonly>
                                        </div>
                                    </div>
                                </div>
                            </fieldset>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="button" id="registerBtn" class="btn btn-info">Register</button>
                            <button class="btn btn-info" type="button" id="next1">Next</button>
                        </div>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Product detail -->
            <section class="sec-product-detail bg0 p-t-105 p-b-70">
                <div class="container">
                    <div class="row">

                        <!-- Bootstrap Carousel -->
                        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                            <ol class="carousel-indicators">
                                <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                                <?php
                                    if($result['img2'] != "" && $result['img2'] != null)
                                    {?>
                                        <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                                    <?php
                                    }
                                ?>
                                <?php
                                    if($result['img3'] != "" && $result['img3'] != null)
                                    {?>
                                        <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                                    <?php
                                    }
                                ?>
                                <?php
                                    if($result['img4'] != "" && $result['img4'] != null)
                                    {?>
                                        <li data-target="#carouselExampleIndicators" data-slide-to="3"></li>
                                    <?php
                                    }
                                ?>
                            </ol>
                            <div class="carousel-inner">
                                <div class="carousel-item active">
                                    <img class="d-block img-fluid pic-deep-image" src="../product_image/<?php echo $result['img1'] ?>" alt="First slide">
                                </div>

                                <?php
                                    if($result['img2'] != "" && $result['img2'] != null)
                                    {?>
                                        <div class="carousel-item">
                                            <img class="d-block pic-deep-image" src="../product_image/<?php echo $result['img2'] ?>" alt="Second slide">
                                        </div>
                                    <?php
                                    }
                                ?>
                                <?php
                                    if($result['img3'] != "" && $result['img3'] != null)
                                    {?>
                                        <div class="carousel-item">
                                            <img class="d-block pic-deep-image" src="../product_image/<?php echo $result['img3'] ?>" alt="Second slide">
                                        </div>
                                    <?php
                                    }
                                ?>
                                <?php
                                    if($result['img4'] != "" && $result['img4'] != null)
                                    {?>
                                        <div class="carousel-item">
                                            <img class="d-block pic-deep-image" src="../product_image/<?php echo $result['img2'] ?>" alt="Second slide">
                                        </div>
                                    <?php
                                    }
                                ?>
                            </div>
                            <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="sr-only">Previous</span>
                            </a>
                            <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="sr-only">Next</span>
                            </a>
                        </div>

                        <div class="col-md-5 col-lg-6">
                            <div class="p-l-70 p-t-35 p-l-0-lg">
                                <h4 class="js-name1 txt-l-104 cl3 p-b-16">
                                    <?php echo $result['product_name'] ?>
                                </h4>

                                <span class="txt-m-117 cl9">
                                    <?php echo $result['price'] . " Rs." ?>
                                </span>

                                <div class="flex-w flex-m p-t-55 p-b-30">
                                    <div class="wrap-num-product flex-w flex-m bg12 p-rl-10 m-r-30 m-b-30">
                                        <div class="btn-num-product-down flex-c-m fs-29"></div>

                                        <input class="txt-m-102 cl6 txt-center num-product" readonly type="number" name="num-product" id="num-product" value="1">

                                        <div class="btn-num-product-up flex-c-m fs-16"></div>
                                    </div>

                                    <button id="buyNow" name="buyNow" class="flex-c-m rounded txt-s-103 cl0 bg10 size-a-2 hov-btn2 trans-04 m-b-30" style="background-color:red;" <?php
                                        if(!isset($_SESSION['front_user_id']) || $_SESSION['front_user_id'] == "" || $_SESSION['front_user_id'] == null)
                                        {
                                            echo "data-toggle='modal' data-target='#exampleModalLong'";
                                        }
                                        else
                                        {
                                            echo "data-toggle='modal' data-target='#exampleModalCenter'";
                                        }
                                    ?>>
                                        Buy Now
                                    </button>
                                </div>

                                <div class="txt-s-107 p-b-6">
                                    <span class="cl6">
                                        Seller :
                                    </span>

                                    <span class="cl9">
                                        <?php
                                            $getSellerQuery = mysqli_query($con, "SELECT `bussiness_name` FROM `marketer` JOIN `user_master` ON `user_master`.`id` = `marketer`.`user_id` WHERE `marketer`.`id` = ". $_SESSION['mark_id'] .";");
                                            $getSellerName = mysqli_fetch_array($getSellerQuery);

                                            echo $getSellerName[0]
                                        ?>
                                    </span>
                                </div>

                                <div class="txt-s-107 p-b-6">
                                    <span class="cl6">
                                        Category:
                                    </span>

                                    <span class="cl9">
                                        <?php
                                            $getCatQuery = mysqli_query($con, "SELECT `category_master`.`name` FROM `listing_products` JOIN `category_master` ON `category_master`.`id` = `listing_products`.`catagory_id` WHERE `listing_products`.`id` = ". $_SESSION['product_id'] .";");
                                            $getCategory = mysqli_fetch_array($getCatQuery);

                                            echo $getCategory[0];
                                        ?>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Tab01 -->
                    <div class="tab02 p-t-80">
                        <!-- Nav tabs -->
                        <ul class="nav nav-tabs" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" data-toggle="tab" href="#description" role="tab">Description</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#info" role="tab">Additional Information</a>
                            </li>
                        </ul>

                        <!-- Tab panes -->
                        <div class="tab-content">
                            <!-- - -->
                            <div class="tab-pane fade show active" id="description" role="tabpanel">
                                <div class="p-t-30">
                                    <p class="txt-s-112 cl9">
                                        <?php echo $result['product_description']; ?>
                                    </p>
                                </div>
                            </div>

                            <!-- - -->
                            <div class="tab-pane fade" id="info" role="tabpanel">
                                <ul class="p-t-21">
                                    <li class="txt-s-101 flex-w how-bor2 p-tb-14">
                                        <span class="cl6 size-w-54">
                                            Return 
                                        </span>

                                        <span class="cl9 size-w-55">
                                            Within 7 days of delivery
                                        </span>
                                    </li>

                                    <li class="txt-s-101 flex-w how-bor2 p-tb-14">
                                        <span class="cl6 size-w-54">
                                            Payment Method
                                        </span>

                                        <span class="cl9 size-w-55">
                                            Cash on Delivery
                                        </span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Footer -->
            <footer class="bg12" style="background-color: grey;">
                <div class="container">
                    <div class="wrap-footer flex-w p-t-60 p-b-62">
                        <div class="footer-col1">
                            <div class="footer-col-title">
                                <a href="#">
                                    <!-- <img src="images/icons/logo-01.png" alt="LOGO"> -->
                                    <img src="../image/ghost.png" class="rounded-circle">
                                </a>
                            </div>
                        </div>

                        <div class="footer-col4">
                            <div class="footer-col-title flex-m">
                                <span class="txt-m-109 cl3" style="color:white;">
                                    Our Services
                                </span>
                            </div>

                            <div class="flex-w flex-sb p-t-6" style="color:white;">
                                <div class="size-w-13 m-b-10" style="border:2px solid white; padding-left: 5px;">
                                    <!-- <a href="#" class="dis-block size-a-7 bg-img1 hov4"
                                    style="background-image: url('images/instagram-01.jpg');"></a> -->
                                    Fast Delivery
                                </div>
                                
                                <div class="size-w-13 m-b-10" style="border:2px solid white;padding-left: 5px;">
                                    <!-- <a href="#" class="dis-block size-a-7 bg-img1 hov4"
                                    style="background-image: url('images/instagram-02.jpg');"></a> -->
                                    Easy Returns
                                </div>

                                <div class="size-w-13 m-b-10" style="border:2px solid white;padding-left: 5px;">
                                    <!-- <a href="#" class="dis-block size-a-7 bg-img1 hov4"
                                    style="background-image: url('images/instagram-03.jpg');"></a> -->
                                    100% Money Back
                                </div>

                                <div class="size-w-13 m-b-10" style="border:2px solid white;padding-left: 5px;">
                                    <!-- <a href="#" class="dis-block size-a-7 bg-img1 hov4"
                                    style="background-image: url('images/instagram-04.jpg');"></a> -->
                                    Best Products
                                </div>

                                <div class="size-w-13 m-b-10" style="border:2px solid white;padding-left: 5px;">
                                    <!-- <a href="#" class="dis-block size-a-7 bg-img1 hov4"
                                    style="background-image: url('images/instagram-05.jpg');"></a> -->
                                    Assurred Quality
                                </div>

                                <div class="size-w-13 m-b-10" style="border:2px solid white;padding-left: 5px;">
                                    <!-- <a href="#" class="dis-block size-a-7 bg-img1 hov4"
                                    style="background-image: url('images/instagram-06.jpg');"></a> -->
                                    100% Genuine Products
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="flex-w flex-sb-m bo-t-1 bocl14 p-tb-14">
                        <span class="txt-s-101 cl9 p-tb-10 p-r-29" style="color:white;">
                            Copyright © 2023 Ghost Marketer. All rights reserved.
                        </span>
                    </div>
                </div>
            </footer>
            

            <!-- Back to top -->
            <div class="btn-back-to-top bg0-hov" id="myBtn">
                <span class="symbol-btn-back-to-top">
                    <span class="lnr lnr-chevron-up"></span>
                </span>
            </div>

            <?php
                include("scripts_include.php");
            ?>

            <script>
                $("#confirmOrder").click(function(){
                    const json = {"quantity" : $("#qty_display").html(), "total_amount" : $("#total_amount").html()};

                    $.ajax({
                        type : "POST",
                        method : "POST",
                        data : json,
                        dataType : "JSON",
                        url : "marketer_crud.php?what=confirmQty",
                        success : function(response){
                            window.location.href = response.url;
                        }
                    })
                });

                $("#registerUser").validate({
                    rules : {
                        uName : {
                            required : true,
                        },
                        uEmail : {
                            required : true,
                        },
                        uPass : {
                            required : true,
                            pattern:"^[A-Za-z0-9._@]+$",
                        },
                        uPhone : {
                            required : true,
                            digits : true,
                            minlength:10,
                            maxlength:10,
                        },
                        uAddress : {
                            required : true,
                        },
                        pincode : {
                            required : true,
                            digits : true,
                            minlength:6,
                            maxlength:6,
                        },
                        state : {
                            required : true,
                        },
                        city : {
                            required : true,
                        }
                    },
                    messages : {
                        uName : {
                            required : "<span class='text-danger'>*Please enter name.</span>",
                        },
                        uEmail : {
                            required : "<span class='text-danger'>*Please enter email.</span>",
                        },
                        uPass : {
                            required : "<span class='text-danger'>*Please enter password.</span>",
                            pattern:"<span class='text-danger'>*Password should contain atleast small capital numbers and special characters.</span>",
                        },
                        uPhone : {
                            required : "<span class='text-danger'>*Please enter phone number.</span>",
                            digits : "<span class='text-danger'>*Phone number only contains digits.</span>",
                            minlength:"<span class='text-danger'>*Phone number is of length 10.</span>",
                            maxlength:"<span class='text-danger'>*Phone number is of length 10.</span>",
                        },
                        uAddress : {
                            required : "<span class='text-danger'>*Please enter address.</span>",
                        },
                        pincode : {
                            required : "<span class='text-danger'>*Please enter pincode.</span>",
                            digits : "<span class='text-danger'>*Pincode contains only digits.</span>",
                            minlength:"<span class='text-danger'>*Pincode is of length 6.</span>",
                            maxlength:"<span class='text-danger'>*Pincode is of length 6.</span>",
                        },
                        state : {
                            required : "<span class='text-danger'>*Please enter state.</span>",
                        },
                        city : {
                            required : "<span class='text-danger'>*Please enter city.</span>",
                        }
                    }
                })

                $('#exampleModalCenter').on('show.bs.modal', function (e) {
                    $("#qty_display").html($("#num-product").val());

                    var price = <?php
                        echo $result['price'];
                    ?>

                    $("#total_amount").html(($("#num-product").val() * price).toFixed(2));
                })

                $("#registerAnchor").click(function(){
                    $("#exampleModalLong").modal('hide');
                    $("#f1").show();

                    $("#f2").hide();
                    $("#registerBtn").hide();
                });

                $("#pincode").blur(function(){
                    if($("#pincode").val() != "" && $("#pincode").val() != null)
                    {
                        $.ajax({
                            url : "https://api.postalpincode.in/pincode/" + $(this).val(),
                            success : function(response)
                            {
                                $("#state").val(response[0].PostOffice[0].State);
                                $("#city").val(response[0].PostOffice[0].District);
                            },
                            error : function(response)
                            {alert(response);}
                        });
                    }
                });

                $("#next1").click(function(){
                    if($("#registerUser").valid())
                    {
                        $("#f1").hide();
                        $("#next1").hide();
    
                        $("#f2").show();
                        $("#registerBtn").show();
                    }
                });

                $("#registerBtn").click(function(){
                    if($("#registerUser").valid())
                    {
                        // console.log($("input[name=gender]:checked").val());
                        if($("input[name=gender]:checked").val() == "" || $("input[name=gender]:checked").val() == null)
                        {
                            $.bootstrapGrowl("<div class='text-center' style='background-color:#FF3232;opacity:1;font-weight:bold'><h1>Warning</h1><p>Please Select Gender.</p></div>",{
                                delay : 2500,
                                allow_dismiss : false,
                                align : "center",
                                width : 400,
                            });
                        }
                        else
                        {
                            var formData = $("#registerUser").serializeArray();
                            const json = {};
    
                            $.each(formData, function(){
                                json[this.name] = this.value;
                            })
    
                            console.log(json);

                            $.ajax({
                                type : "POST",
                                method : "POST",
                                data : json,
                                dataType : "JSON",
                                url : "marketer_crud.php?what=registerUser",
                                success : function(response){
                                    if(!response.success)
                                    {
                                        if(response.email_error)
                                        {
                                            $.bootstrapGrowl("<div class='text-center' style='background-color:#FF3232;opacity:1;font-weight:bold'><h1>Error!</h1><p>"+response.message+"</p></div>",{
                                                delay : 2500,
                                                allow_dismiss : false,
                                                align : "center",
                                                width : 400,
                                            });

                                            $("#registerAnchor").click();
                                        }
                                        else
                                        {
                                            $.bootstrapGrowl("<div class='text-center' style='background-color:#FF3232;opacity:1;font-weight:bold'><h1>Error!</h1><p>"+response.message+"</p></div>",{
                                                delay : 2500,
                                                allow_dismiss : false,
                                                align : "center",
                                                width : 400,
                                            });
                                        }
                                    }
                                    else
                                    {
                                        $.bootstrapGrowl("<div class='text-center' style='background-color:#1eff1e;opacity:1;font-weight:bold'><h1>Success!</h1><p>"+response['message']+"</p></div>",{
                                            delay : 2500,
                                            allow_dismiss : false,
                                            width : 400,
                                            align : "center",
                                        });

                                        setTimeout(function(){
                                            window.location.reload();
                                        },2500);
                                    }   
                                }
                            })
                        }
                    }
                })

                $("#login").click(function(){
                    if($("#usrEmail").val() == "" || $("#usrEmail").val() == null)
                    {
                        $.bootstrapGrowl("<div class='text-center' style='background-color:#FF3232;opacity:1;font-weight:bold'><h1>Warning</h1><p>Please enter registered email id.</p></div>",{
                            // type : "warning",
                            delay : 2500,
                            allow_dismiss : false,
                            align : "center",
                            width : 400,
                        });

                        $("#usrEmail").focus();
                    }
                    else if($("#usrPas").val() == "" || $("#usrPas").val() == null)
                    {
                        $.bootstrapGrowl("<div class='text-center' style='background-color:#FF3232;opacity:1;font-weight:bold'><h1>Warning</h1><p>Please enter password.</p></div>",{
                            // type : "warning",
                            delay : 2500,
                            allow_dismiss : false,
                            align : "center",
                            width : 400,
                        });
                    }
                    else
                    {
                        var formData = $("#loginUser").serializeArray();

                        const json = {};
                        $.each(formData, function(){
                            json[this.name] = this.value;
                        })

                        $.ajax({
                            type : "POST",
                            method : "POST",
                            data : json,
                            dataType : "JSON",
                            url : "marketer_crud.php?what=userlogin",
                            success : function(response){
                                if(response.success)
                                {
                                    $.bootstrapGrowl("<div class='text-center' style='background-color:#1eff1e;opacity:1;font-weight:bold'><h1>Success!</h1><p>"+response['message']+"</p></div>",{
                                        delay : 2500,
                                        allow_dismiss : false,
                                        width : 400,
                                        align : "center",
                                    });

                                    setTimeout(function(){
                                        window.location.reload();
                                    },2500);
                                }
                                else
                                {
                                    $.bootstrapGrowl("<div class='text-center' style='background-color:#FF3232;opacity:1;font-weight:bold'><h1>Error!</h1><p>"+ response.message +"</p></div>",{
                                        // type : "warning",
                                        delay : 2500,
                                        allow_dismiss : false,
                                        align : "center",
                                        width : 400,
                                    });
                                }
                            }
                        })
                    }
                })
            </script>
        </body>
        </html>
    <?php
    }
?>