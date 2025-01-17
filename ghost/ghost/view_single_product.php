<?php
    session_start();
    include("connection.php");
    $marketer = 0;
    if(!isset($_GET['product_id']))
    {
        echo "<script>alert('Not a valid url !!');</script>";
    }
    else if(!isset($_GET['marketer_id']))
    {
        echo "<script>alert('Not a valid url !!');</script>";
    }
    else
    {
        $query = mysqli_query($con, "SELECT `product_status`, `sell_status` FROM `listing_products` WHERE `id` = ". $_GET['product_id'] ."");

        $result = mysqli_fetch_array($query);

        if($result[0] == "Active" && $result[1] == "Unsold")
        {
            $getMarketerQuery = mysqli_query($con, "SELECT `id` FROM `marketer`");
            while($loopMarketerQuery = mysqli_fetch_array($getMarketerQuery))
            {
                if(password_verify($loopMarketerQuery[0], $_GET['marketer_id']))
                {
                    $marketer = $loopMarketerQuery[0];
                    break;
                }
            }

            $chckQuery = mysqli_query($con, "SELECT `status`, `comission` FROM `assign_marketer` WHERE `marketer_id` = $marketer AND `product_id` = ". $_GET['product_id'] ."");
            $chckResult = mysqli_fetch_array($chckQuery);

            if($chckResult[0] == 'Active')
            {
                $_SESSION['mark_id'] = $marketer;
                $_SESSION['comm'] = $chckResult[1];
                $_SESSION['product_id'] = $_GET['product_id'];

                // var_dump($_SESSION);

                header("Location:agent_product_selling/index.php");
            }
            else
            {
                echo "<script>alert('Currently the marketer is inactive !');</script>";
            }
        }
        else
        {
            echo "<script>alert('Either the product is blocked or has been sold out!');</script>";
        }
    }
?>