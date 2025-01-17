<?php
    include("../connection.php");
    session_start();
?>
<html>
    <?php
        include("links_include.php");
    ?>
    <body>
        <div class="container-fluid mt-3">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-8 text-left">
                            <h1>Order Confirmation</h1>
                        </div>
                        <div class="col-4 text-right">
                            <h3>Total Order Amount : <?php
                                echo $_SESSION['total_amount'];
                            ?></h3>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-8">
                            <h4 class="card-title">User Details : </h4>
                        </div>
                        <div class="col-4">
                            <div class="text-right">
                                <button id="editButton" title="Edit Profile Details"><img src="images/editIcon.webp" class="rounded-circle" width="25px"/></button>
                            </div>
                        </div>
                    </div>

                    <br/>
                    <div class="row">
                        <div class="col-6">Name of Customer : </div>
                        <div class="col-6">
                            <input type="text" name="nameCust" id="nameCust" class="form-control" value="<?php
                                echo $_SESSION['front_user_name'];
                            ?>" disabled>
                        </div>
                    </div>

                    <br/>
                    <div class="row">
                        <div class="col-6">Name of Email : </div>
                        <div class="col-6">
                            <input type="text" name="emailCust" id="emailCust" class="form-control" value="<?php
                                echo $_SESSION['front_user_email'];
                            ?>" disabled>
                        </div>
                    </div>

                    <br/>
                    <div class="row">
                        <div class="col-6">Phone Number : </div>
                        <div class="col-6">
                            <input type="number" name="phnoCust" id="phnoCust" class="form-control" value="<?php
                                echo $_SESSION['front_user_phno'];
                            ?>" disabled>
                        </div>
                    </div>

                    <br/>
                    <div class="row">
                        <div class="col-6">Delivery Address : </div>
                        <div class="col-6">
                            <textarea name="custAddress" id="custAddress" cols="10" rows="3" class="form-control" disabled><?php
                                echo $_SESSION['front_user_address'];
                            ?></textarea>
                        </div>
                    </div>

                    <br/>
                    <div class="row">
                        <div class="col-6">Pincode : </div>
                        <div class="col-6">
                            <input type="number" name="pincode" id="pincode" class="form-control" value="<?php
                                $tempQuery = mysqli_query($con, "select * from user_master where id = ". $_SESSION['front_user_id'] ."");
                                $tempResult = mysqli_fetch_array($tempQuery);
                                echo $tempResult['pincode'];
                            ?>" disabled>
                            <br/>
                            <div class="form-row">
                                <div class="col">
                                    <input type="text" name="state" id="state" class="form-control" value="<?php
                                        echo $tempResult['state'];
                                    ?>" disabled>
                                </div>
                                <div class="col">
                                    <input type="text" name="city" id="city" class="form-control" value="<?php
                                        echo $tempResult['city'];
                                    ?>" disabled>
                                </div>
                            </div>
                        </div>
                    </div>

                    <button class="btn btn-info" id="updateProfile" name="updateProfile" disabled>Update</button>
                </div>
                <div class="card-footer">
                    <h4>Product Details : </h4>
                    <table class="table-hover table table-responsive">
                        <thead>
                            <tr>
                                <th>Product Name</th>
                                <th>Description</th>
                                <th>Image</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Amount</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <?php
                                    $query = mysqli_query($con, "select * from listing_products where id = ". $_SESSION['product_id'] ."");
                                    $result = mysqli_fetch_array($query);
                                ?>
                                <td><?php echo $result['product_name'] ?></td>
                                <td><?php echo $result['product_description'] ?></td>
                                <td><img src="../product_image/<?php echo $result['img1'] ?>" width="75px" /></td>
                                <td><?php echo $result['price'] ?></td>
                                <td><?php echo $_SESSION['quantity'] ?></td>
                                <td><?php echo $_SESSION['total_amount'] ?></td>
                            </tr>
                            <!-- <tr>
                                <td colspan="6">
                                    <button class="btn btn-success" id="place_order">Place Order</button>
                                </td>
                            </tr> -->
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Payment Mode :</h4>

                    <div class="row">
                        <div class="col-12">
                            <div class="form-check">
                                <input type="radio" name="paymentMode" id="cashMode" checked class="form-check-input ml-1">
                                <label for="cashMode" class="form-check-label">Cash on Delivery</label>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-check">
                                <input type="radio" name="paymentMode" id="upi" disabled class="form-check-input ml-1">
                                <label for="upi" class="form-check-label">UPI</label><small class="font-italic text-danger">Currently not available</small>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-check">
                                <input type="radio" name="paymentMode" id="netBanking" disabled class="form-check-input ml-1">
                                <label for="netBanking" class="form-check-label">Net Banking</label><small class="font-italic text-danger">Currently not available</small>
                            </div>
                        </div>
                        <div class="col-12">
                            <button class="btn btn-success" id="place_order">Place Order</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php
            include("scripts_include.php");
        ?>
        <script>
            $("#pincode").blur(function(){
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
            });
            phonePat = /^[0-9]{10}$/;
            pincodePat = /^[0-9]{6}$/;

            $("#editButton").click(function(){
                $("input, textarea, button").removeAttr("disabled");
                $("#place_order").attr("disabled", "disabled");
                $("#state, #city").attr("disabled", "disabled");
                $("#emailCust").attr("disabled", "disabled");
            });

            $("#updateProfile").click(function(){
                var name = $("#nameCust").val();
                var email = $("#emailCust").val();
                var phno = $("#phnoCust").val();
                var address = $("#custAddress").val();
                var pincode = $("#pincode").val();
                var state = $("#state").val();
                var city = $("#city").val();

                if(name == "" || email == "" || phno == "" || address == "" || pincode == "" || state == "" || city == "")
                {
                    $.bootstrapGrowl("<div class='text-center'><h3>Please fill out all the details first !</h3></div>",{
                        type : "warning",
                        delay : 2000,
                        allow_dismiss : false,
                        width : 400,
                        align : "center",
                    });
                }
                else if(phonePat.test(phno) == false)
                {
                    $.bootstrapGrowl("<div class='text-center'><h3>Phone number should be of 10 digits only!</h3></div>",{
                        type : "warning",
                        delay : 2000,
                        allow_dismiss : false,
                        width : 400,
                        align : "center",
                    });
                    $("#phnoCust").focus();
                }
                else if(pincodePat.test(pincode) == false)
                {
                    $.bootstrapGrowl("<div class='text-center'><h3>Pincode should be of 6 digits!</h3></div>",{
                        type : "warning",
                        delay : 2000,
                        allow_dismiss : false,
                        width : 400,
                        align : "center",
                    });
                    $("#pincode").focus();
                }
                else
                {
                    const json = {"name" : name, "email" : email, "phno" : phno, "address" : address, "pincode" : pincode, "state" : state, "city" : city};

                    console.log(json);
                    
                    $.ajax({
                        type : "POST",
                        method : "POST",
                        data : json,
                        dataType : "JSON",
                        url : "marketer_crud.php?what=updateOnOrder",
                        success : function(response){
                            if(response.success)
                            {
                                $.bootstrapGrowl("<div class='text-center'><h3>"+ response.message +"</h3></div>",{
                                    type : "success",
                                    delay : 2000,
                                    width : 400,
                                    allow_dismiss : false,
                                    align : "center",
                                });

                                $("input, textarea, #updateProfile").attr("disabled", "disabled");
                                $("#place_order").removeAttr("disabled");  

                                $("#cashMode").removeAttr("disabled");
                            }
                            else
                            {
                                $.bootstrapGrowl("<div class='text-center'><h3>"+ response.message +"</h3></div>",{
                                    type : "warning",
                                    delay : 2000,
                                    width : 400,
                                    allow_dismiss : false,
                                    align : "center",
                                });
                            }
                        }
                    })
                }
            });

            $("#place_order").click(function(){
                $.ajax({
                    type : "POST",
                    method : "POST",
                    dataType : "JSON",
                    url : "marketer_crud.php?what=placeOrder",
                    success : function(response){
                        if(response.success)
                        {
                            window.location.replace('orderConfirmed.php');
                        }
                        else
                        {
                            $.bootstrapGrowl("<div class='text-center' style='background-color:#FF3232;opacity:1;font-weight:bold'><h1>Error !</h1><p>Something went wrong</p></div>",
                            {
                                delay : 2000,
                                width : 400,
                                offset : {"from" : "top", "amount" : 20},
                                allow_dismiss : false,
                                align : "center",
                            }); 
                        }   
                    }
                })
            })
        </script>
    </body>
</html>