<?php
    session_start();
    include("../connection.php");
?>
<html>
    <?php
        include("links_include.php");
    ?>
    <body>
        <div class="container-fluid">
            <div class="row align-items-center h-100">
                <div class="col-6 mx-auto">
                    <div class="card">
                        <div class="card-header">
                            <h1 class="card-title text-center">Order Confirmed</h1>
                            <img src="images/check.gif" width="15%" class="mx-auto d-block" />
                        </div>
                        <div class="card-body">
                            <span class="h5">Order Number : <?php
                                echo $_SESSION['order_id'];
                            ?></span>
                            <br/>

                            <div class="row mt-5 h-6">
                                <div class="col-6">Product Name : </div>
                                <div class="col-6"><?php
                                    $query = mysqli_query($con, "select * from listing_products where id = ". $_SESSION['product_id'] ."");
                                    $result = mysqli_fetch_array($query);

                                    echo $result['product_name'];
                                ?></div>

                                <div class="col-6">Order Quantity : </div>
                                <div class="col-6"><?php
                                    echo $_SESSION['quantity'];
                                ?></div>

                                <div class="col-6">Order Amount : </div>
                                <div class="col-6"><?php
                                    echo $_SESSION['total_amount'];
                                ?></div>

                                <div class="col-6">Payment Mode : </div>
                                <div class="col-6"><?php
                                    echo "Cash on Delivery";
                                ?></div>

                                <div class="col-6">Delivery Address : </div>
                                <div class="col-6"><?php
                                    echo $_SESSION['front_user_address'];
                                ?></div>

                                <br/></br>
                                <div class="col-12 text-center">
                                    Your order will be delivered within 7 days working days.
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button class="btn btn-success printInvoice">Print Invoice</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php
            include("scripts_include.php");
        ?>

        <script>
            $(".printInvoice").click(function(){
                window.print();
            })
        </script>
    </body>
</html>