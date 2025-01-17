<?php
    include("../connection.php");
    session_start();

    if($_GET['what'] == "userlogin")
    {
        $query = mysqli_query($con, "select count(*) from user_master where email = '". $_POST['usrEmail'] ."' and role=2");
        $result = mysqli_fetch_array($query);

        if($result[0] > 0)
        {
            $query = mysqli_query($con, "select * from user_master where email = '". $_POST['usrEmail'] ."'");
            $result = mysqli_fetch_array($query);

            if(password_verify($_POST['usrPas'], $result['password']))
            {
                if($result['status'] == 'active')
                {
                    $response['success'] = true;
                    $response['message'] = "Login Successfully";

                    $_SESSION['front_user_id'] = $result['id'];
                    $_SESSION['front_user_email'] = $result['email'];
                    $_SESSION['front_user_address'] = $result['address'];
                    $_SESSION['front_user_name'] = $result['owner_name'];
                    $_SESSION['front_user_phno'] = $result['phone'];
                }
                else
                {
                    $response['success'] = false;
                    $response['message'] = "You are blocked by admin";
                }
            }
            else
            {
                $response['success'] = false;
                $response['message'] = "Password does not match";
            }
        }
        else
        {
            $response['success'] = false;
            $response['message'] = "Email ID is not registered";
        }

        echo json_encode($response);
    }

    if($_GET['what'] == "registerUser")
    {
        $query = mysqli_query($con, "select count(*) from user_master where email = '". $_POST['uEmail'] ."' and role=2");
        $result = mysqli_fetch_array($query);

        if($result[0] > 0)
        {
            $response['success'] = false;
            $response['message'] = "This email id is already registered. Please login.";
            $response['email_error'] = true;
        }
        else
        {
            $query = mysqli_query($con, "insert into user_master(owner_name, email, password, pincode, state, city, address, phone, gender, role, status) values('". $_POST['uName'] ."', '". $_POST['uEmail'] ."', '". password_hash($_POST['uPass'], PASSWORD_DEFAULT) ."', ". $_POST['pincode'] .", '". $_POST['state'] ."', '". $_POST['city'] ."', '". $_POST['uAddress'] ."', ". $_POST['uPhone'] .", '". $_POST['gender'] ."', 2, 'active')");

            if($query > 0)
            {
                $id = $con->insert_id;
                $response['success'] = true;
                $response['message'] = "User Registration Successfully Done. \nWelcome " . $_POST['uName'];
                $response['email_error'] = false;

                $_SESSION['front_user_id'] = $id;
                $_SESSION['front_user_email'] = $_POST['uEmail'];
                $_SESSION['front_user_address'] = $_POST['uAddress'];
                $_SESSION['front_user_name'] = $_POST['uName'];
                $_SESSION['front_user_phno'] = $_POST['uPhone'];
            }
            else
            {
                $response['success'] = false;
                $response['message'] = "Some error occurred. \nPlease try again";
                $response['email_error'] = false;
            }
        }
        echo json_encode($response);
    }

    if($_GET['what'] == "confirmQty")
    {
        $_SESSION['quantity'] = $_POST['quantity'];
        $_SESSION['total_amount'] = $_POST['total_amount'];

        $response['url'] = "order_confirmation.php";

        echo json_encode($response);
    }

    if($_GET['what'] == "updateOnOrder")
    {
        $query = mysqli_query($con, "update user_master set owner_name = '". $_POST['name'] ."', address = '". $_POST['address'] ."', phone = ". $_POST['phno'] .", pincode = ". $_POST['pincode'] .", state = '". $_POST['state'] ."', city = '". $_POST['city'] ."' where id = ". $_SESSION['front_user_id'] ."");

        if($query > 0)
        {
            $_SESSION['front_user_email'] = $_POST['email'];
            $_SESSION['front_user_address'] = $_POST['address'];
            $_SESSION['front_user_name'] = $_POST['name'];
            $_SESSION['front_user_phno'] = $_POST['phno'];

            $response['success'] = true;
            $response['message'] = "Profile updated successfully";
        }
        else
        {
            $response['success'] = false;
            $response['message'] = "Failed due to some reason.";
        }

        echo json_encode($response);
    }

    if($_GET['what'] == "placeOrder")
    {
        $commission = round(($_SESSION['total_amount'] * ($_SESSION['comm'] / 100)), 2);

        $query = mysqli_query($con, "insert into sold_master(product_id, marketer_id, marketer_commission, buyer_user_id, quantity, total_amount, payment_mode, selling_date) values(". $_SESSION['product_id'] .", ". $_SESSION['mark_id'] .", ". $commission .", ". $_SESSION['front_user_id'] .", ". $_SESSION['quantity'] .", ". $_SESSION['total_amount'] .", 'Cash on Delivery', '". date("Y-m-d") ."')");

        if($query > 0)
        {
            $soldId = $con->insert_id;

            $query = mysqli_query($con, "insert into order_tracking(sell_master_id, status, location) values(". $soldId .", 'Packing', 'Seller')");

            if($query > 0)
            {
                $productQuery = mysqli_query($con, "select * from listing_products where id = ". $_SESSION['product_id'] ."");
                $product = mysqli_fetch_array($productQuery);

                mail($_SESSION['front_user_email'], "Order Confirmed", "Dear " . $_SESSION['front_user_name'] . ",\nYour Order for " . $product['product_name'] . " is confirmed. The details are as below : \n\nOrder ID : " . $soldId . "\nProduct Name : " . $product['product_name'] . "\nQuantity : " . $_SESSION['quantity'] . "\nPrice : " . $product['price'] . "\nTotal Amount : " . $_SESSION['total_amount'] . "\nPayment Mode : Cash on Delivery \n\nYour Product will be delivered within 7 working days.\nFor order tracking and return order please visit our website on : \nwww.localhost:4000/ghost/user", "From:Ghost Marketer");
                $_SESSION['order_id'] = $soldId;
                $response['success'] = true;
            }
            else
            {
                $response['success'] = false;

                $query = mysqli_query($con, "delete from sold_master where id = ". $soldId ."");
            }
        }
        else
        {
            $response['success'] = false;
        }

        echo json_encode($response);
    }
?>