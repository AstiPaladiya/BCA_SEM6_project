<?php
    include("connection.php");
    session_start();

    if($_GET['what'] == "addnewadmin")
    {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $phone = $_POST['phone'];

        $query = mysqli_query($con, "insert into admin_master(admin_name, admin_email, admin_password, admin_phno) values('". $name ."', '". $email ."', '". $password ."', ". $phone .")");

        if($query > 0)
        {
            $response["success"] = true;
            $response["message"] = "Admin Added Successfully";
        }
        else
        {
            $response["success"] = false;
            $response["message"] = "Adding of admin failed due to some reasons";
        }

        echo json_encode($response);
    }

    if($_GET['what']=="checkloginsuper")
    {
        //$response["hello"] = "world";
        $mail=$_POST['mail'];
        $pwd=$_POST['pas'];
        $response["mail"] = $mail;
        $response["pas"] = $pwd;
        $query=mysqli_query($con,"select count(*) from admin_master where admin_email='".$mail."'");
        $row=mysqli_fetch_array($query);
        if($row[0]>0)
        {
            $query=mysqli_query($con,"select admin_password from admin_master where admin_email='".$mail."'");
            $row=mysqli_fetch_array($query);

            $check=password_verify($pwd,$row['admin_password']);

            if($check==true)
            {
                // session_start();
                $response["success"]=true;
                $response["message"]="Login Successfully";
                $query=mysqli_query($con,"select * from admin_master where admin_email = '". $mail ."'");
                $row=mysqli_fetch_array($query);
                $_SESSION["admin"] = $row['admin_name'];

            }
            else
            {
                $response["success"]=false;
                $response["message"]="Password does not match";
            }
        }
        else
        {
            $response["success"]=false;
            $response["message"]="Email address does not match";
        }
        echo json_encode($response);
    }

    if($_GET['what'] == "checkemail")
    {
        $query = mysqli_query($con, "select count(*) from admin_master where admin_email = '". $_POST['email'] ."'");

        $result = mysqli_fetch_array($query);

        if($result[0] > 0)
        {
            $otp=rand(100000,999999);
            mail($_POST['email'], "OTP for password reset", "Your One Time Password for is $otp.\nUse it reseting your password.", "From:GhostMarketer");

            $response['otp'] = $otp;
            $response['success'] = true;
            $response['message'] = "OTP sent successfully";
        }
        else
        {
            $response['success'] = false;
            $response['message'] = "Email not found";
        }
        echo json_encode($response);
    }

    if($_GET['what'] == "changeadminpassword")
    {
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

        $query = mysqli_query($con, "update admin_master set admin_password = '". $password ."' where admin_email = '". $_POST['email'] ."'");

        if($query > 0)
        {
            $response['success'] = true;
            $response['message'] = "Password changes successfully";
        }
        else
        {
            $response['success'] = false;
            $response['message'] = "Password was not changed due to internal server error. \nPlease try again";
        }
        echo json_encode($response);
    }
    if($_GET['what']=="user_registration")
    {
        $name=$_POST['txtName'];
        $add = $_POST['txtAdd'];
        $mail = $_POST['txtMail'];
        $pass = password_hash($_POST['txtPwd'],PASSWORD_DEFAULT);
        $phone = $_POST['txtPhone'];
        $gender = $_POST['rdGender'];
        $pincode = $_POST['pincode'];
        $state = $_POST['state'];
        $city = $_POST['city'];

        $query = mysqli_query($con, "select count(*) from user_master where email = '". $mail ."'");
        $result = mysqli_fetch_array($query);   
        if($result[0] > 0)
        {
            $response["success"] = false;
            $response["message"] = "This Email ID is already registered";
        }
        else
        {
            $query = mysqli_query($con, "insert into user_master(owner_name, email, password, pincode, state, city, address, phone, gender, role, status) values('". $name ."', '". $mail ."', '". $pass ."', '". $pincode ."', '". $state ."', '". $city ."', '". $add ."', '". $phone ."', '". $gender ."', 2, 'active')");
            if($query > 0)
            {
                $response["success"] = true;
                $response["message"] = "Registration Successfully Done.\nPlease Login to Use your Account";
            }
            else
            {
                $response["success"] = false;
                $response["message"] = "Some error occurred. \nPlease try again.";
            }
        }
        
        echo json_encode($response);
    }
    //Select City code 
    if($_GET['what']=="selectCity")
    {
        $id = $_POST['state_id'];
        $query = mysqli_query($con, "select * from cities where state_id=" . $id . "");
        while($row=mysqli_fetch_array($query))
        {
            $response[$row['id']] = $row['city'];
        }
        echo json_encode($response);
    }

    if($_GET["what"] == "blockcustomer")
    {
        $query = mysqli_query($con, "select owner_name, email from user_master where id = ". $_POST['userid'] ."");
        $result = mysqli_fetch_array($query);

        $subject = "Account Blocked by Ghost Marketer";
        $message = "Dear " . $result[0] .", \n\nYour Account of Ghost Marketer has been blocked by the admin due to the following reason :- \n\n" . $_POST['message'] ."\n\nPlease contact us through email on ghostmarketer2125@gmail.com for further queries.";
        $to = $result[1];
        mail($to, $subject, $message, "From:GhostMarketer");

        $query = mysqli_query($con, "update user_master set status = '". $_POST['status'] ."' where id = ". $_POST['userid'] ."");

        if($query > 0)
        {
            $response["success"] = true;
            $response["message"] = "User Blocked Successfully";
        }
        else
        {
            $response["success"] = false;
            $response["message"] = "Some Error Occurred. \nPlease try again";
        }

        echo json_encode($response);
    }

    if($_GET['what'] == "unblockcustomer")
    {
        $query = mysqli_query($con, "select owner_name, email from user_master where id = ". $_POST['userid'] ."");
        $result = mysqli_fetch_array($query);

        $subject = "Account Retrieved by Ghost Marketer";
        $message = "Dear " . $result[0] .", \n\nYour Account of Ghost Marketer has been retrieved by the admin due to the following reason :- \n\n" . $_POST['message'] ."\n\nPlease contact us through email on ghostmarketer2125@gmail.com for further queries.";
        $to = $result[1];
        mail($to, $subject, $message, "From:GhostMarketer");
        
        $query = mysqli_query($con, "update user_master set status = '". $_POST['status'] ."' where id = ". $_POST['userid'] ."");

        if($query > 0)
        {
            $response["success"] = true;
            if($_POST['status'] == "block")
            {
                $response["message"] = "User Blocked Successfully";
            }
            else
            {
                $response["message"] = "User Active Successfully";
            }
        }
        else
        {
            $response["success"] = false;
            $response["message"] = "Some Error Occurred. \nPlease try again";
        }

        echo json_encode($response);
    }

    if($_GET['what'] == "getcategory")
    {
        $query = mysqli_query($con, "select * from category_master where id = " . $_POST['id'] . "");
        $response = mysqli_fetch_array($query);
        echo json_encode($response);
    }
    // Add Subscription Plan    
    if($_GET['what'] == "addSubscription")
    {
        $name = $_POST["name"];
        $des = $_POST["des"];
        $price=$_POST["price"];
        $time = $_POST["time"];
        $query=mysqli_query($con,"insert into  subscription_master (subscription_name,description,rate,time_perioud,status) values ('".$name."','".$des."',".$price.",".$time.",'Active')");
        if($query>0)
        {
                $response["success"] = true;
                $response["message"] = "Subscription Plan Added Successfully";
        }
        else
        {
                $response["success"] = false;
                $response["message"] = "Something went wrong.Please try again.";
        }
        echo json_encode($response);
    }
    // Active Plan  
    if($_GET['what'] == "activesubs")
    {
         $query=mysqli_query($con, "update subscription_master set status='" . $_POST['status'] . "' where id=" . $_POST['id'] . "");
         if($query>0)
         {
            $response["success"] = true;
            if($_POST['status'] == "Active")
            {
                $response["message"] = "Plan Active Successfully";
            }
            else
            {
                $response['message'] = "Plan Blocked Successfully";
            }
            
         }
         else
         {
            $response["success"] = false;
            $response["message"] = "Some Error Occurred. \nPlease try again";
         }
         echo json_encode($response);
    }
   
    // Check User Login
    if($_GET["what"] == "chkUser")
    {
        $mail=$_POST["mail"];
        $pass = $_POST["pass"];
        $query = mysqli_query($con,"select count(*) from user_master where email='" .$mail. "'");
        $row = mysqli_fetch_array($query);
        if($row[0] > 0)
        {
            $query = mysqli_query($con, "select * from user_master where email='".$mail."'");
            $row = mysqli_fetch_array($query);

             $checkPass = password_verify($pass, $row['password']);
             if($checkPass==true)
             {
                if($row['status']=='active')
                {
                    
                    $query = mysqli_query($con, "select role from user_master where email='" . $mail . "'");
                    $role = mysqli_fetch_array($query);
                    if($role['role']==2)
                    {
                        $query = mysqli_query($con, "select * from user_master where email='" . $mail . "' and role=2");
                        $row = mysqli_fetch_array($query);
                        if($row['subscrib_id']==NULL)
                        {
                            $_SESSION['front_user_gender'] = $row['gender'];
                            $_SESSION["front_name"] = $row['owner_name'];
                            $_SESSION["front_mail"] = $row['email'];
                            $_SESSION["front_role"] = $row['role'];
                            $_SESSION["front_user_id"] = $row['id'];
                            $_SESSION['front_user_premium'] = false;
                            $response["success"] = true;
                            $response["message"] = "Login Successfully as free user";
                        } 
                        else 
                        {
                            if($row['expiary_date'] == null || $row['expiary_date'] == "")
                            {
                                $_SESSION['front_user_gender'] = $row['gender'];
                                $_SESSION["front_name"] = $row['owner_name'];
                                $_SESSION["front_mail"] = $row['email'];
                                $_SESSION["front_role"] = $row['role'];
                                $_SESSION["front_user_id"] = $row['id'];
                                $_SESSION['front_user_premium'] = false;
                                $response["success"] = true;
                                $response["message"] = "Login Successfully as free user"; 
                            }
                            else
                            {
                                $query = mysqli_query($con, "select count(*) from user_master where email='" . $mail . "' and datediff('" . $row['expiary_date'] . "',CURRENT_DATE) > 0 and role=2");
                                $ans = mysqli_fetch_array($query);
                                if($ans[0]>0)
                                {
                                    $_SESSION['front_user_gender'] = $row['gender'];
                                    $_SESSION["front_name"] = $row['owner_name'];
                                    $_SESSION["front_mail"] = $row['email'];
                                    $_SESSION["front_role"] = $row['role'];
                                    $_SESSION["front_user_id"] = $row['id'];
                                    $_SESSION['front_user_premium'] = true;
                                    $response["success"] = true;
                                    $response["message"] = "Login Successfully as premium user";
                                }
                                else
                                {
                                    $_SESSION['front_user_gender'] = $row['gender'];
                                    $_SESSION["front_name"] = $row['owner_name'];
                                    $_SESSION["front_mail"] = $row['email'];
                                    $_SESSION["front_role"] = $row['role'];
                                    $_SESSION["front_user_id"] = $row['id'];
                                    $_SESSION['front_user_premium'] = false;
                                    $response["success"] = true;
                                    $response["message"] = "Login Successfully as free user";   
                                }
                            }
                        }
                    }
                    else
                    {
                        $response["success"] = false;
                        $response["message"] = "You are not a user";   
                    }
                }
                else
                {
                    $response["success"] = false;
                    $response["message"] = "You account has been blocked";     
                }
             }
             else
             {
                $response["success"] = false;
                $response["message"] = "Password does not match";
             }
        }
        else
        {
            $response["success"]=false;
            $response["message"]="Email does not match";   
        }
        echo json_encode($response);
    }
    // if($_GET["what"] == "chkUser")
    // {
    //     $_SESSION = [];
    //     $mail = $_POST['txtMail'];
    //     $pass = $_POST['txtPwd'];
    //     // $mail=$_POST["mail"];
    //     //  $pass = $_POST["pass"];
    //      $query = mysqli_query($con,"select count(*) from user_master where email='" .$mail. "' and status='active'");
    //     $row = mysqli_fetch_array($query);
    //     if($row[0] > 0)
    //     {
    //         $query = mysqli_query($con, "select password from user_master where email='".$mail."'");
    //         $row = mysqli_fetch_array($query);

    //          $checkPass = password_verify($pass, $row['password']);
    //          if($checkPass==true)
    //          {
    //             $query = mysqli_query($con, "select role from user_master where email='" . $mail . "'");
    //             $role = mysqli_fetch_array($query);
    //             if($role['role']==2)
    //             {
    //                  $query = mysqli_query($con, "select * from user_master where email='" . $mail . "' and role=2");
    //                 $row = mysqli_fetch_array($query);
    //                 if($row['subscrib_id']==NULL)
    //                 {
    //                     $_SESSION["front_name"] = $row['owner_name'];
    //                     $_SESSION["front_mail"] = $row['email'];
    //                     $_SESSION["front_role"] = $row['role'];
    //                     $_SESSION["front_user_id"] = $row['id'];
    //                     $response["success"] = true;
    //                     $response["message"] = "Login Successfully as free user";
    //                 } 
    //                 else 
    //                 {
    //                     $query = mysqli_query($con, "select count(*) from user_master where email='" . $mail . "' and datediff('" . $row['expiary_date'] . "',CURRENT_DATE) > 0 and role=2");
    //                     $ans = mysqli_fetch_array($query);
    //                     if($ans[0]>0)
    //                     {
    //                         $_SESSION["front_name"] = $row['owner_name'];
    //                         $_SESSION["front_mail"] = $row['email'];
    //                         $_SESSION["front_role"] = $row['role'];
    //                         $_SESSION["front_user_id"] = $row['id'];
    //                         $response["success"] = true;
    //                         $response["message"] = "Login Successfully as premium user";
    //                     }
    //                     else
    //                     {
    //                         $_SESSION["front_name"] = $row['owner_name'];
    //                         $_SESSION["front_mail"] = $row['email'];
    //                         $_SESSION["front_role"] = $row['role'];
    //                         $_SESSION["front_user_id"] = $row['id'];
    //                         $response["success"] = true;
    //                         $response["message"] = "Login Successfully as free user"; 
    //                     }
    //                 }
    //             }
    //             else
    //             {
    //                 $response["success"] = false;
    //                 $response["message"] = "You are not a user";   
    //             }
    //          }
    //          else
    //          {
    //             $response["success"] = false;
    //             $response["message"] = "Password does not match";
    //          }
    //     }
    //     else
    //     {
    //         $response["success"]=false;
    //         $response["message"]="Email does not match";   
    //     }
    //     echo json_encode($_SESSION);
    // }
    // Bussiness Registration
    if($_GET['what'] == "registernewbusiness")
    {
        $query = mysqli_query($con, "select count(*) from user_master where email = '". $_POST['txtMail'] ."' or gst_no = '". $_POST['gstin'] ."' and role = 1");
        $result = mysqli_fetch_array($query);
        if($result[0] == 0)
        {
            $query = mysqli_query($con, "insert into user_master(bussiness_name, owner_name, email, password, pincode, state, city, address, phone, gender, gst_no, role, status, subscrib_id, expiary_date) values('". $_POST['busName'] ."', '". $_POST['txtName'] ."', '". $_POST['txtMail'] ."', '". password_hash($_POST['txtPwd'], PASSWORD_DEFAULT) ."', ". $_POST['pincode'] .", '". $_POST['state'] ."', '". $_POST['city'] ."', '". $_POST['txtAdd'] ."', ". $_POST['txtPhone'] .", '". $_POST['rdGender'] ."', '". $_POST['gstin'] ."', 1, 'active', ". $_POST['planid'] .", '". date("Y-m-d", strtotime(date("Y-m-d"). " + " . $_POST['duration'] . " days")) ."')");
            if($query > 0)
            {
                $userid = $con->insert_id;
                $query = mysqli_query($con, "insert into subscription_selling(subscription_id, user_id, payment_mode, expiary_date) values(". $_POST['planid'] .", ". $userid .", 'Razorpay', '". date("Y-m-d", strtotime(date("Y-m-d"). " + " . $_POST['duration'] . " days")) ."')");
                if($query > 0)
                {
                    $response["success"] = true;
                    $response["message"] = "Congratulations.\nYour payment has been received and your business has been registered successfully";
                }
                else
                {
                    $response["success"] = true;
                    $response["message"] = "Your business has been registered.\nBut the payment has been pending. It will take upto 48 hrs for our verifcation";
                }
            }
            else
            {
                $response["success"] = false;
                $response["message"] = "Some error occurred.\nPlease try again.";
            }
        }
        else
        {
            $response["success"] = false;
            $response["message"] = "You are already registered. \nPlease login to access your account.";
        }
        echo json_encode($response);
    }

    if($_GET['what'] == "checkfornewbusiness")
    {
        $query = mysqli_query($con, "select count(*) from user_master where email = '". $_POST['txtMail'] ."' or gst_no = '". $_POST['gstin'] ."' and role = 1");
        $result = mysqli_fetch_array($query);
        if($result[0] > 0)
        {
            $response["success"] = false;
            $response["message"] = "You are already registered. \nPlease login.";
        }
        else
        {
            $response["success"] = true;
        }
        echo json_encode($response);
    }
        // Check Bussiness Login
        if($_GET["what"] == "chkBussinessUser")
        {
            $mail=$_POST["mail"];
             $pass = $_POST["pass"];
             $query = mysqli_query($con,"select count(*) from user_master where email='" .$mail. "' and status='active'");
            $row = mysqli_fetch_array($query);
            if($row[0] > 0)
            {
                $query = mysqli_query($con, "select password from user_master where email='".$mail."'");
                $row = mysqli_fetch_array($query);
    
                 $checkPass = password_verify($pass, $row['password']);
                 if($checkPass==true)
                 {
                    $query = mysqli_query($con, "select role from user_master where email='" . $mail . "'");
                    $role = mysqli_fetch_array($query);
                    if($role['role']==1)
                    {
                        $query = mysqli_query($con, "select * from user_master where email='" . $mail . "' and role=1");
                        $row = mysqli_fetch_array($query);
                        if($row['subscrib_id']==NULL)
                        {
                             $response["success"] = false;
                            $response["message"] = "Please select any of our premium plan first";
                        } 
                        else 
                        {
                            $query = mysqli_query($con, "select count(*) from user_master where email='" . $mail . "' and datediff('" . $row['expiary_date'] . "',CURRENT_DATE) > 0 and role=1");
                            $ans = mysqli_fetch_array($query);
                            if($ans[0]>0)
                            {
                                $_SESSION["name"] = $row['owner_name'];
                                $_SESSION["mail"] = $row['email'];
                                $_SESSION["role"] = $row['role'];
                                $_SESSION["user_id"] = $row['id'];
                                $_SESSION['plan_expired'] = false;
                                $response["success"] = true;
                                $response["message"] = "Login Successfully";
                            }
                            else
                            {
                                $_SESSION["name"] = $row['owner_name'];
                                $_SESSION["mail"] = $row['email'];
                                $_SESSION["role"] = $row['role'];
                                $_SESSION["user_id"] = $row['id'];
                                $_SESSION['plan_expired'] = true;
                                $response['plan'] = true;
                                $response["success"] = false;
                                $response["message"] = "Your Plan has been expired.Please renew";   
                            }
                        }
                    }
                    else
                    {
                        $response["success"] = false;
                        $response["message"] = "You are not a user";   
                    }
                 }
                 else
                 {
                    $response["success"] = false;
                    $response["message"] = "Password does not match";
                 }
            }
            else
            {
                $response["success"]=false;
                $response["message"]="Email does not match";   
            }
            echo json_encode($response);
        }
        //View  Visitor User
        if($_GET['what']=="visitoruser")
        {
            $year = $_POST['year'];
            
            //SELECT EXTRACT(MONTH FROM `created_at`) AS `mnth`, COUNT(*) AS `numb` FROM `visitor_master` WHERE EXTRACT(YEAR FROM `created_at`) = 2023 GROUP BY `mnth` 
            $query = mysqli_query($con,"SELECT MONTHNAME(DATE(created_at)) as mnth,count(*) FROM visitor_master WHERE EXTRACT(year from created_at ) = $year GROUP BY mnth");
       
            while($row = mysqli_fetch_array($query))
            {
                $response[$row[0]] = $row[1];
            }
            
             echo json_encode($response);
        }
        // View Subscription User
        if($_GET['what']=="viewSubscription")
        {
            $id = $_POST['id'];
            $query = mysqli_query($con, "select * from user_master where subscrib_id = $id");
            $response[0] = "";
            while($row = mysqli_fetch_array($query))
            {
                if ($row['role'] == 1) 
                {
                    $response[0] .= "<tr><td>" . $row['owner_name'] . "</td><td>" . $row['email'] . "</td><td>" . $row['phone'] . "</td><td>Business</td></tr>";
                }
                else
                {
                    
                    $response[0] .= "<tr><td>" . $row['owner_name'] . "</td><td>" . $row['email'] . "</td><td>" . $row['phone'] . "</td><td>User</td></tr>";
                }
            }
            if($response[0] == "")
            {
                $response[0] .= "<tr><td colspan='4'><b><center>No record available for this plan</center></b></td></tr>";
            }
        
          
            echo json_encode($response);
        }
        // Unsold Product
        if($_GET['what']=="UnsoldProduct")
        {
            $id = $_POST['id'];
            $query = mysqli_query($con, "update listing_products set sell_status='Sold' where id=" . $id . " ");
            
            if($query>0)
            {
                $query = mysqli_query($con, "DELETE FROM `cart` WHERE `product_id` = ". $id ."");
                $response["success"]=true;
                $response["message"] = "Product has been Sold Successfuly";
            }
            else
            {
                $response["success"] = False;
                $response["message"] = "Some Error Occurred. \nPlease try again";
            }
            echo json_encode($response);
        }
        if($_GET['what']=="SoldProduct")
        {
            $id = $_POST['id'];
            $query = mysqli_query($con, "update listing_products set sell_status='Unsold' where id=" . $id . "");
            
            if($query>0)
            {
                $response["success"] = true;
                $response["message"]="Product has been Unsold successfully";
            }
            else
            {
                $response["success"]=false;
                $response["message"]="Some Error Occurred. \nPlease try again";
            }
            echo json_encode($response);
        }
        // Block Bussiness Product
        if($_GET['what']=="blockProduct")
        {
            $id = $_POST['id'];
            $query = mysqli_query($con, "update listing_products set product_status='Block' where id=" . $id . "");
            
            if($query>0)
            {
                $response["success"] = true;
                $response["message"]="Product has been blocked successfully";
            }
            else
            {
                $response["success"] = false;
                $response["message"] = "Some Error Occurred. \nPlease try again";
            }
            echo json_encode($response);
        }
        // Active Bussiness Product
        if($_GET['what']=="activeProduct")
        {
            $id = $_POST['id'];

            $query = mysqli_query($con, "SELECT COUNT(*) FROM `listing_products` WHERE `id` = ". $id ." AND `Block_By` IS NULL;");
            $result = mysqli_fetch_array($query);

            if($result[0] == 0)
            {
                $response["success"] = false;
                $response["message"] = "Product is Blocked by Ghost Marketer. Please contact on our helpdesk email for unblocking the product";
            }
            else
            {
                $query = mysqli_query($con, "update listing_products set product_status='Active' where id=" . $id . "");
                if($query>0)
                {
                    $response["success"] = true;
                    $response["message"]="Product has been Active successfully";
                }
                else
                {
                    $response["success"]=false;
                    $response["message"] = "Some Error Occurred. \nPlease try again";
                }   
            }
            // $query = mysqli_query($con, "select * from listing_products where id = ". $id ."");
            // $result = mysqli_fetch_array($query);

            // if($result['Block_By'] == "Admin")
            // {
            //     $response["success"] = false;
            //     $response["message"] = "Product is Blocked by Ghost Marketer. Please contact on our helpdesk email for unblocking the product";
            // }
            // else
            // {
            //     $query = mysqli_query($con, "update listing_products set product_status='Active' where id=" . $id . "");
            //     if($query>0)
            //     {
            //         $response["success"] = true;
            //         $response["message"]="Product has been Active successfully";
            //     }
            //     else
            //     {
            //         $response["success"]=false;
            //         $response["message"] = "Some Error Occurred. \nPlease try again";
            //     }
            // }
            
            echo json_encode($response);
        }
        // View More Bussiness Product detail
        if($_GET['what']=="viewMoreProduct")
        {
            $id=$_POST['id'];
            $query = mysqli_query($con, "select * from listing_products where id=" . $id . "");
            $response[0]="";
            while($row=mysqli_fetch_array($query))
            {
                 $query_catagory = mysqli_query($con, "select name from category_master where id=" . $row['catagory_id'] . "");
                 $result = mysqli_fetch_array($query_catagory);

                $img2 = trim($row['img2']);
                $img3 = trim($row['img3']);
                $img4 = trim($row['img4']);

                // if($img2 == "" || $img2 == NULL)
                // {
                //     $img2 = "<span style='font-size:110%'>Image is Not Available</span>";
                // }
                // else
                // {
                //     $img2 = "<img src='../product_image/". $img2 ."' width='50%' class='rounded' />";
                // }

                // if($img3 == "" || $img3 == NULL)
                // {
                //     $img3 = "<span style='font-size:110%'>Image is Not Available</span>";
                // }
                // else
                // {
                //     $img3 = "<img src='../product_image/". $img3 ."' width='50%' class='rounded' />";
                // }

                // if($img4 == "" || $img4 == NULL)
                // {
                //     $img4 = "<span style='font-size:110%'>Image is not Available</span>";
                // }
                // else
                // {
                //     $img4 = "<img src='../product_image/". $img4 ."' width='50%' class='rounded' />";
                // }

                if (($img2 == "" || $img2 == NULL) && ($img3 == "" || $img3 == NULL) && ($img4 == "" || $img4 == NULL)) 
                {
                    $img2 = "<span style='font-size:110%'>Image is not Available</span>";
                    $img3 = "<span style='font-size:110%'>Image is not Available</span>";
                    $img4 = "<span style='font-size:110%'>Image is not Available</span>";
                }
                else if(($img3 == "" || $img3 == NULL) && ($img4 == "" || $img4 == NULL))
                {
                    $img2 = "<img src='../product_image/". $img2 ."' width='50%' class='rounded' />";
                    $img3 = "<span style='font-size:110%'>Image is not Available</span>";
                    $img4 = "<span style='font-size:110%'>Image is not Available</span>";
                    
                }
                else if ($img4 == "" || $img4 == NULL) 
                {
                    $img2 = "<img src='../product_image/". $img2 ."' width='50%' class='rounded' />";
                    $img3 = "<img src='../product_image/". $img3 ."' width='50%' class='rounded' />";
                    $img4 = "<span style='font-size:110%'>Image is not Available</span>";
                }
                else
                {   
                    $img2 = "<img src='../product_image/". $img2 ."' width='50%' class='rounded' />";
                    $img3 = "<img src='../product_image/". $img3 ."' width='50%' class='rounded' />";
                    $img4 = "<img src='../product_image/". $img4 ."' width='50%' class='rounded' />";
                }
                $response[0] .= "<div class='row'><ul><div class='col-12' style='font-size:130%;font-weight:bold;'><li>Catagory Name:</li></div></ul></div><div class='row'><div class='col-12' style='font-size:110%;'>" . $result['name'] . "</div></div><br/><div class='row'><div class='col-12' style='font-size:130%;font-weight:bold;'><ul><li>Product Name :</li></ul></div></div><div class='row'><div class='col-12' style='font-size:110%;'>" . $row['product_name'] . "</div></div><br/><div class='row'><div class='col-12' style='font-size:130%;font-weight:bold;'><ul><li>Description :</div></div><div class='row'><div class='col-12' style='font-size:110%;'>".$row['product_description']."</div></div><br/><div class='row'><div class='col-12' style='font-size:130%;font-weight:bold;'><ul><li>Price :</div></div><div class='row'><div class='col-12' style='font-size:110%;'>".$row['price']."</div></div><br/><div class='row'><div class='col-12' style='font-size:130%;font-weight:bold;'><ul><li>Image1 :</div></div><div class='row'><div class='col-12'><img src='../product_image/".$row['img1']."' width='50%' class='rounded'/></div></div><br/><div class='row'><div class='col-12' style='font-size:130%;font-weight:bold;'><ul><li>Image2 :</li></ul></div></div><div class='row'><div class='col-12'>$img2</div></div><br/><div class='row'><div class='col-12' style='font-size:130%;font-weight:bold;'><ul><li>Image3 :</li></ul></div></div><div class='row'><div class='col-12'>$img3</div></div><br/><div class='row'><div class='col-12' style='font-size:130%;font-weight:bold;'><ul><li>Image4 :</li></ul></div></div><div class='row'><div class='col-12'>$img4</div></div>";

                
            }
            echo json_encode($response);
        }
        // Update Bussiness Product Detail
        if($_GET['what']=="editProduct")
        {
            $id = $_POST['id'];
            $query = mysqli_query($con, "select * from listing_products where id=" . $id . "");
            $response[0]="";
            while($row=mysqli_fetch_array($query))
            {
                $query_catagory = mysqli_query($con, "select name from category_master where id=" . $row['catagory_id'] . "");
                $result = mysqli_fetch_array($query_catagory);
                $img1 = trim($row['img1']);
                $img2 = trim($row['img2']);
                $img3 = trim($row['img3']);
                $img4 = trim($row['img4']);
                $img1_disabled = "";
                $img2_disabled = "";
                $img2_chkbox = false;
                $img3_disabled = "";
                $img3_chkbox = false;
                $img4_disabled = "";
                $img4_chkbox = false;
                if($img2 != "" && $img2 != null)
                {
                    $img2_disabled = "";
                    $img2_chkbox = true;
                    $img3_disabled = "";
                    $img4_disabled = "disabled";
                }
                else
                {
                    $img2_disabled = "";
                    $img3_disabled = "disabled";
                    $img4_disabled = "disabled";
                }
                if($img3 != "" && $img3 != null)
                {
                    $img2_disabled = "";
                    $img2_chkbox = true;
                    $img3_disabled = "";
                    $img3_chkbox = true;
                    $img4_disabled = "";
                }
                if($img4 != "" && $img4 != null)
                {
                    $img2_disabled = "";
                    $img2_chkbox = true;
                    $img3_disabled = "";
                    $img3_chkbox = true;
                    $img4_disabled = "";
                    $img4_chkbox = true;
                }
        $response[0] .= " <div class='form-group'>
                                    <label style='font-size:15px;font-weight:500'>Category Name:</label>
                                    <input type='text' id='txtCatName' name='txtCatame' class='form-control ' style=' border:1px solid lightgrey;' placeholder='Name' readonly value='" . $result['name'] . "'/>
                                  </div>
                                  <div class='form-group' hidden>
                                    <input type='text' name='pid' id='pid' value='" . $row['id'] . "' />
                                  </div>
                                <div class='form-group'>
                                    <label style='font-size:15px;font-weight:500'>Name:</label>
                                    <input type='text' id='txtName' name='txtName' class='form-control' readonly style=' border:1px solid lightgrey;' value='" . $row['product_name'] . "' placeholder='Name'/>
                                </div>
                                <div class='form-group'>
                                    <label style='font-size:15px;font-weight:500'>Description:</label>
                                    <textarea type='text' id='txtDesUpd' name='txtDesUpd' class='form-control' style=' border:1px solid lightgrey;' placeholder='Description'>" . $row['product_description'] . "</textarea>
                                </div>
                                <div class='form-group'>
                                    <label style='font-size:15px;font-weight:500'>Price:</label>
                                    <input type='number' id='txtPriceUpd' name='txtPriceUpd' class='form-control' style=' border:1px solid lightgrey;' value='" . $row['price'] . "' placeholder='Price'/>
                                </div>
                                <div class='form-group'>
                                    <label class='form-label'>Image1:</label>
                                    <input type='file' class='form-control' accept='image/*' id='img1Upd' style=' border:1px solid lightgrey;' name='img1Upd' />
                                </div>";
                $response[0] .= "<div class='form-group'>
                                    <label class='form-label'>Image2:</label>
                                    <input type='file' class='form-control' accept='image/*' style=' border:1px solid lightgrey;' $img2_disabled id='img2Upd' name='img2Upd' />
                                </div>";
                if($img2_chkbox)
                {
                    $response[0] .= "<div class='form-group'>Check If you want to delete Image 2 <span style='font-size:small;color:red;'>(removing image2 will remove successive images also)</span> : <input type='checkbox' name='delete_img2' id='delete_img2' class='' /></div>";
                }
                $response[0] .= "<div class='form-group'>
                                    <label class='form-label'>Image3:</label>
                                    <input type='file' class='form-control' style=' border:1px solid lightgrey;' accept='image/*' $img3_disabled id='img3Upd' name='img3Upd' />
                                </div>";
                if($img3_chkbox)
                {
                    $response[0] .= "<div class='form-group'>Check If you want to delete Image 3 <span style='font-size:small;color:red;'>(removing image3 will remove successive images also)</span> : <input type='checkbox' name='delete_img3' id='delete_img3' class='' /></div>";
                }
                $response[0] .= "<div class='form-group'>
                                    <label class='form-label'>Image4:</label>
                                    <input type='file' class='form-control' style=' border:1px solid lightgrey;' accept='image/*' $img4_disabled id='img4Upd' name='img4Upd' />
                                </div>";
                if($img4_chkbox)
                {
                    $response[0] .= "<div class='form-group'>Check If you want to delete Image 4 <span style='font-size:small;color:red;'>(removing image4 will remove successive images also)</span> : <input type='checkbox' name='delete_img4' id='delete_img4' class='' /></div>";
                }
                }
            echo json_encode($response);
        }
    //Admin Product Block Unblock
    if($_GET['what'] == "blunblproduct")
    {
        if($_POST['do'] == "Active")
        {
            $query = mysqli_query($con, "update listing_products set product_status = '" . $_POST['do'] . "', Block_By = Null where id = " . $_POST['id'] . "");
        }
        else
        {
            $query = mysqli_query($con, "update listing_products set product_status = '" . $_POST['do'] . "', Block_By = 'Admin' where id = " . $_POST['id'] . "");
        }
        if($query != 0)
        {
            $query = mysqli_query($con, "SELECT `user_master`.`email`, `user_master`.`owner_name`, `listing_products`.`product_name`, `listing_products`.`product_description`, `listing_products`.`price` FROM `listing_products` JOIN `user_master` ON `user_master`.`id` = `listing_products`.`user_id` WHERE `listing_products`.`id` = ". $_POST['id'] .";");
            $getmail = mysqli_fetch_array($query);

            $message = "Dear " . $getmail[1] . ", \nYour Product has been " . $_POST['do'] . " by Admin due to the following reason :- " . $_POST['reason'] . "\n\n\nThe product details are as below : \nProduct Name : " . $getmail[2] . "\nProduct Description : " . $getmail[3] . "\nProduct Price : " . $getmail[4];
            mail($getmail[0], "Product ". $_POST['do'] ." by Admin", $message, "From:GhostMarketer");
            $response['success'] = true;
            $response['message'] = "Product ". $_POST['do'] ." Successfully";
        }
        else
        {
            $response['success'] = false;
            $response['message'] = "Some Error Occurred";
        }
        echo json_encode($response);
    }
    // Admin Product View More Detail
    if($_GET['what']=="viewMoreAdminProduct")
    {
        $id=$_POST['id'];
        $query = mysqli_query($con, "select * from listing_products where id=" . $id . "");
        $response[0]="";
        while($row=mysqli_fetch_array($query))
        {
            $query_catagory = mysqli_query($con, "select name from category_master where id=" . $row['catagory_id'] . "");
            $result = mysqli_fetch_array($query_catagory);
            $query_user = mysqli_query($con, "select owner_name from user_master where id=" . $row['user_id'] . "");
            $ans = mysqli_fetch_array($query_user);

            $img2 = trim($row['img2']);
            $img3 = trim($row['img3']);
            $img4 = trim($row['img4']);

            if (($img2 == "" || $img2 == NULL) && ($img3 == "" || $img3 == NULL) && ($img4 == "" || $img4 == NULL)) 
            {
                $img2 = "<span style='font-size:110%'>Image is not Available</span>";
                $img3 = "<span style='font-size:110%'>Image is not Available</span>";
                $img4 = "<span style='font-size:110%'>Image is not Available</span>";
            }
            else if(($img3 == "" || $img3 == NULL) && ($img4 == "" || $img4 == NULL))
            {
                $img2 = "<img src='../product_image/". $img2 ."' width='50%' class='rounded' />";
                $img3 = "<span style='font-size:110%'>Image is not Available</span>";
                $img4 = "<span style='font-size:110%'>Image is not Available</span>";
                
            }
            else if ($img4 == "" || $img4 == NULL) 
            {
                $img2 = "<img src='../product_image/". $img2 ."' width='50%' class='rounded' />";
                $img3 = "<img src='../product_image/". $img3 ."' width='50%' class='rounded' />";
                $img4 = "<span style='font-size:110%'>Image is not Available</span>";
            }
            else
            {   
                $img2 = "<img src='../product_image/". $img2 ."' width='50%' class='rounded' />";
                $img3 = "<img src='../product_image/". $img3 ."' width='50%' class='rounded' />";
                $img4 = "<img src='../product_image/". $img4 ."' width='50%' class='rounded' />";
            }
            $response[0] .= "<div class='row'><ul><div class='col-12' style='font-size:130%;font-weight:bold;'><li>Owner Name:</li></div></ul></div><div class='row'><div class='col-12' style='font-size:110%;'>" . $ans['owner_name'] . "</div></div><br/><div class='row'><ul><div class='col-12' style='font-size:130%;font-weight:bold;'><li>Catagory Name:</li></div></ul></div><div class='row'><div class='col-12' style='font-size:110%;'>" . $result['name'] . "</div></div><br/><div class='row'><div class='col-12' style='font-size:130%;font-weight:bold;'><ul><li>Product Name :</li></ul></div></div><div class='row'><div class='col-12' style='font-size:110%;'>" . $row['product_name'] . "</div></div><br/><div class='row'><div class='col-12' style='font-size:130%;font-weight:bold;'><ul><li>Description :</div></div><div class='row'><div class='col-12' style='font-size:110%;'>".$row['product_description']."</div></div><br/><div class='row'><div class='col-12' style='font-size:130%;font-weight:bold;'><ul><li>Price :</div></div><div class='row'><div class='col-12' style='font-size:110%;'>".$row['price']."</div></div><br/><div class='row'><div class='col-12' style='font-size:130%;font-weight:bold;'><ul><li>Image1 :</div></div><div class='row'><div class='col-12'><img src='../product_image/".$row['img1']."' width='50%' class='rounded'/></div></div><br/><div class='row'><div class='col-12' style='font-size:130%;font-weight:bold;'><ul><li>Image2 :</li></ul></div></div><div class='row'><div class='col-12'>$img2</div></div><br/><div class='row'><div class='col-12' style='font-size:130%;font-weight:bold;'><ul><li>Image3 :</li></ul></div></div><div class='row'><div class='col-12'>$img3</div></div><br/><div class='row'><div class='col-12' style='font-size:130%;font-weight:bold;'><ul><li>Image4 :</li></ul></div></div><div class='row'><div class='col-12'>$img4</div></div>";

            
        }
        echo json_encode($response);
    }
    if($_GET['what'] == "getuserbifurcation")
        {
            $response['xvalues'] = "";
            $response['yvalues'] = "";
            $response['colors'] = "";
            $query = mysqli_query($con, "SELECT COUNT(*), `owner_name`, `role` FROM `user_master` GROUP BY `role`");
            while($row = mysqli_fetch_array($query))
            {
                if($row['role'] == 1)
                {
                    $response['xvalues'] .= "Business,";
                    $response['yvalues'] .= $row[0] . ",";
                    $response['colors'] .= "#0000D1,";
                }
                else
                {
                    $response['xvalues'] .= "Registered User,";
                    $response['yvalues'] .= $row[0] . ",";
                    $response['colors'] .= "#00D100,";
                }
            }
            $query = mysqli_query($con, "select count(*) from visitor_master");
            $row = mysqli_fetch_array($query);
            $response['xvalues'] .= "Visitor";
            $response['yvalues'] .= $row[0];
            $response['colors'] .= "#D10000";
            echo json_encode($response);
        }
        if($_GET['what'] == "getplansbifurcation")
        {
            $response['xvalues'] = "";
            $response['yvalues'] = "";
            $response['colors'] = "";
            $query = mysqli_query($con, "SELECT COUNT(`subscription_selling`.`subscription_id`) AS `Count_User`, `subscription_master`.`subscription_name`, (COUNT(`subscription_selling`.`subscription_id`) * `subscription_master`.`rate`) AS `Total_Revenue`  FROM `subscription_selling` JOIN `subscription_master` ON `subscription_master`.`id` = `subscription_selling`.`subscription_id` GROUP BY `subscription_id`");
            while($row = mysqli_fetch_array($query))
            {
                $response['xvalues'] .= $row['subscription_name'] . ",";
                $response['yvalues'] .= $row['Total_Revenue'] . ",";
                if($row['subscription_name'] == "Silver Plan")
                {
                    $response['colors'] .= "#0000D1,";
                }
                else if($row['subscription_name'] == "Golden Plan")
                {
                    $response['colors'] .= "#00D100,";
                }
                else if($row['subscription_name'] == "Platinum Plan")
                {
                    $response['colors'] .= "#D10000,";
                }
                else
                {
                    $response['colors'] .= "#D10001,";
                }
            }
            echo json_encode($response);
        }

        if($_GET['what'] == "getsoldunsoldbifur")
        {
            $response['xvalues'] = "";
            $response['yvalues'] = "";
            $response['colors'] = "";
            $query = mysqli_query($con, "select count(*) from listing_products where sell_status = 'Unsold' and user_id = ". $_SESSION['user_id'] ."");
            $result1 = mysqli_fetch_array($query);
            $query = mysqli_query($con, "select count(*) from listing_products where sell_status = 'Sold' and user_id = ". $_SESSION['user_id'] ."");
            $result2 = mysqli_fetch_array($query);
            $response['xvalues'] = "Unsold, Sold";
            $response['yvalues'] = $result1[0] . "," . $result2[0];
            $response['colors'] = "#0000D1,#D10000";
            echo json_encode($response);
        }
        if($_GET['what'] == "getdelundelbifur")
        {
            $query = mysqli_query($con, "SELECT COUNT(*) FROM `order_tracking` LEFT JOIN `sold_master` ON `sold_master`.`id` = `order_tracking`.`sell_master_id` LEFT JOIN `listing_products` ON `listing_products`.`id` = `sold_master`.`product_id` WHERE `listing_products`.`user_id` = " . $_SESSION['user_id'] . " AND `order_tracking`.`status` = 'Delivered';");
            $row1 = mysqli_fetch_array($query);
            $query = mysqli_query($con, "SELECT COUNT(*) FROM `order_tracking` LEFT JOIN `sold_master` ON `sold_master`.`id` = `order_tracking`.`sell_master_id` LEFT JOIN `listing_products` ON `listing_products`.`id` = `sold_master`.`product_id` WHERE `listing_products`.`user_id` = " . $_SESSION['user_id'] . " AND `order_tracking`.`status` != 'Delivered';");
            $row2 = mysqli_fetch_array($query);
            $response['xvalues'] = "Delivered, Undelivered";
            $response['yvalues'] = $row1[0] . "," . $row2[0];
            $response['colors'] = "#0000D1,#D10000";
            echo json_encode($response);
        }
        if($_GET['what'] == "getvisitinuserlinechart")
        {
            $response['xvalues'] = "";
            $response['yvalues'] = "";
            $query = mysqli_query($con, "SELECT COUNT(*), YEAR(`created_at`) FROM `visitor_master` GROUP BY YEAR(`created_at`); ");
            $counter = 0;
            while($row = mysqli_fetch_array($query))
            {
                $counter = $counter + $row[0];
                $response['xvalues'] .= $row[1] . ",";
                $response['yvalues'] .= $row[0] . ",";
            }
            $response['counter'] = $counter;
            echo json_encode($response);
        }
        if($_GET['what'] == "getvisitinuserlinechart_month")
        {
            $response['xvalues'] = "";
            $response['yvalues'] = "";
            $query = mysqli_query($con, "SELECT COUNT(*), MONTHNAME(`created_at`) FROM `visitor_master` WHERE YEAR(`created_at`) = ". date("Y") ." GROUP BY MONTH(`created_at`);");
            $counter = 0;
            while($row = mysqli_fetch_array($query))
            {
                $counter = $counter + $row[0];
                $response['xvalues'] .= $row[1] . ",";
                $response['yvalues'] .= $row[0] . ",";
            }
            $response['year'] = date("Y");
            $response['counter'] = $counter;
            echo json_encode($response);
        }
        if($_GET['what'] == "getvisitinuserlinechart_month_sel_year")
        {
            $response['xvalues'] = "";
            $response['yvalues'] = "";
            $query = mysqli_query($con, "SELECT COUNT(*), MONTHNAME(`created_at`) FROM `visitor_master` WHERE YEAR(`created_at`) = ". $_POST['year'] ." GROUP BY MONTH(`created_at`);");
            $counter = 0;
            while($row = mysqli_fetch_array($query))
            {
                $counter = $counter + $row[0];
                $response['xvalues'] .= $row[1] . ",";
                $response['yvalues'] .= $row[0] . ",";
            }
            $response['year'] = $_POST['year'];
            $response['counter'] = $counter;
            echo json_encode($response);
        }
        if($_GET['what'] == "getreguser_year")
        {
            $response['xvalues'] = "";
            $response['yvalues'] = "";
            $query = mysqli_query($con, "SELECT COUNT(*), YEAR(`created_at`) FROM `user_master` WHERE `role` = 2 GROUP BY YEAR(`created_at`)");
            $counter = 0;
            while($row = mysqli_fetch_array($query))
            {
                $counter = $counter + $row[0];
                $response['xvalues'] .= $row[1] . ",";
                $response['yvalues'] .= $row[0] . ",";
            }
            $response['counter'] = $counter;
            echo json_encode($response);
        }
        if($_GET['what'] == "getreguser_month")
        {
            $response['xvalues'] = "";
            $response['yvalues'] = "";
            $query = mysqli_query($con, "SELECT COUNT(*), MONTHNAME(`created_at`) FROM `user_master` WHERE YEAR(`created_at`) = ". date("Y") ." AND `role` = 2 GROUP BY MONTH(`created_at`);");
            $counter = 0;
            while($row = mysqli_fetch_array($query))
            {
                $counter = $counter + $row[0];
                $response['xvalues'] .= $row[1] . ",";
                $response['yvalues'] .= $row[0] . ",";
            }
            $response['year'] = date("Y");
            $response['counter'] = $counter;
            echo json_encode($response);
        }
        if($_GET['what'] == "user_page_chart_bifur")
        {
            $response['xvalues'] = "";
            $response['yvalues'] = "";
            $response['colors'] = "";
            $query = mysqli_query($con, "SELECT COUNT(*) FROM `user_master` WHERE `role` = 2 AND `id` IN (SELECT `id` FROM `user_master` WHERE `expiary_date` IS NOT NULL AND DATEDIFF(`expiary_date`, CURDATE()) > 0);");
            $result = mysqli_fetch_array($query);
            $response["xvalues"] = "Premium User, Normal User";
            $response['yvalues'] = $result[0] . ",";
            $response['colors'] = "#0000D1";
            $query = mysqli_query($con, "SELECT COUNT(*) FROM `user_master` WHERE `role` = 2 AND `id` IN (SELECT `id` FROM `user_master` WHERE `expiary_date` IS NULL OR DATEDIFF(`expiary_date`, CURDATE()) < 0);");
            $result = mysqli_fetch_array($query);
            $response['yvalues'] .= $result[0];
            $response['colors'] .= ",#D10000";
            echo json_encode($response);
        }
        if($_GET['what'] == "getreguserlinechart_month_sel_year")
        {
            $response['xvalues'] = "";
            $response['yvalues'] = "";
            $query = mysqli_query($con, "SELECT COUNT(*), MONTHNAME(`created_at`) FROM `user_master` WHERE YEAR(`created_at`) = ". $_POST['year'] ." GROUP BY MONTH(`created_at`);");
            $counter = 0;
            while($row = mysqli_fetch_array($query))
            {
                $counter = $counter + $row[0];
                $response['xvalues'] .= $row[1] . ",";
                $response['yvalues'] .= $row[0] . ",";
            }
            $response['year'] = $_POST['year'];
            $response['counter'] = $counter;
            echo json_encode($response);
        }
        if($_GET['what'] == "bus_page_chart_bifur")
        {
            $response['xvalues'] = "";
            $response['yvalues'] = "";
            $response['colors'] = "";
            $query = mysqli_query($con, "SELECT COUNT(*) FROM `user_master` WHERE `role` = 1 AND `id` IN (SELECT `id` FROM `user_master` WHERE `expiary_date` IS NOT NULL AND DATEDIFF(`expiary_date`, CURDATE()) > 0);");
            $result = mysqli_fetch_array($query);
            $response["xvalues"] = "Premium Business, Expired Business";
            $response['yvalues'] = $result[0] . ",";
            $response['colors'] = "#0000D1";
            $query = mysqli_query($con, "SELECT COUNT(*) FROM `user_master` WHERE `role` = 1 AND `id` IN (SELECT `id` FROM `user_master` WHERE `expiary_date` IS NULL OR DATEDIFF(`expiary_date`, CURDATE()) < 0);");
            $result = mysqli_fetch_array($query);
            $response['yvalues'] .= $result[0];
            $response['colors'] .= ",#D10000";
            echo json_encode($response);
        }
        if($_GET['what'] == "getregbus_year")
        {
            $response['xvalues'] = "";
            $response['yvalues'] = "";
            $query = mysqli_query($con, "SELECT COUNT(*), YEAR(`created_at`) FROM `user_master` WHERE `role` = 1 GROUP BY YEAR(`created_at`)");
            $counter = 0;
            while($row = mysqli_fetch_array($query))
            {
                $counter = $counter + $row[0];
                $response['xvalues'] .= $row[1] . ",";
                $response['yvalues'] .= $row[0] . ",";
            }
            $response['counter'] = $counter;
            echo json_encode($response);
        }
        if($_GET['what'] == "getregbus_month")
        {
            $response['xvalues'] = "";
            $response['yvalues'] = "";
            $query = mysqli_query($con, "SELECT COUNT(*), MONTHNAME(`created_at`) FROM `user_master` WHERE YEAR(`created_at`) = ". date("Y") ." AND `role` = 1 GROUP BY MONTH(`created_at`);");
            $counter = 0;
            while($row = mysqli_fetch_array($query))
            {
                $counter = $counter + $row[0];
                $response['xvalues'] .= $row[1] . ",";
                $response['yvalues'] .= $row[0] . ",";
            }
            $response['year'] = date("Y");
            $response['counter'] = $counter;
            echo json_encode($response);
        }
        if($_GET['what'] == "getregbuslinechart_month_sel_year")
        {
            $response['xvalues'] = "";
            $response['yvalues'] = "";
            $query = mysqli_query($con, "SELECT COUNT(*), MONTHNAME(`created_at`) FROM `user_master` WHERE YEAR(`created_at`) = ". $_POST['year'] ." GROUP BY MONTH(`created_at`);");
            $counter = 0;
            while($row = mysqli_fetch_array($query))
            {
                $counter = $counter + $row[0];
                $response['xvalues'] .= $row[1] . ",";
                $response['yvalues'] .= $row[0] . ",";
            }
            $response['year'] = $_POST['year'];
            $response['counter'] = $counter;
            echo json_encode($response);
        }

        if($_GET['what'] == "listing_product_chart_actblock")
        {
            $response['xvalues'] = "Active, Block";
            $response['yvalues'] = "";
            $response['colors'] = "#0000D1, #D10000";

            $query = mysqli_query($con, "select count(*) from listing_products where product_status = 'Active' and sell_status = 'Unsold'");
            $temp = mysqli_fetch_array($query);

            $response['yvalues'] .= $temp[0] . ",";

            $query = mysqli_query($con, "select count(*) from listing_products where product_status = 'Block' and sell_status = 'Unsold'");
            $temp = mysqli_fetch_array($query);

            $response['yvalues'] .= $temp[0];

            echo json_encode($response);
        }

        if($_GET['what'] == "listing_product_chart_soldunsold")
        {
            $response['xvalues'] = "Sold, Unsold";
            $response['yvalues'] = "";
            $response['colors'] = "#0000D1, #D10000";

            $query = mysqli_query($con, "select count(*) from listing_products where sell_status = 'Sold'");
            $temp = mysqli_fetch_array($query);

            $response['yvalues'] .= $temp[0] . ",";

            $query = mysqli_query($con, "select count(*) from listing_products where sell_status = 'Unsold'");
            $temp = mysqli_fetch_array($query);

            $response['yvalues'] .= $temp[0];

            echo json_encode($response);
        }

        if($_GET['what'] == "listing_products_tot_year")
        {
            $response['xvalues'] = "";
            $response['yvalues'] = "";
            $query = mysqli_query($con, "SELECT COUNT(*), YEAR(`created_at`) FROM `listing_products` WHERE `sell_status` = 'Unsold' GROUP BY YEAR(`created_at`)");
            $counter = 0;
            while($row = mysqli_fetch_array($query))
            {
                $counter = $counter + $row[0];
                $response['xvalues'] .= $row[1] . ",";
                $response['yvalues'] .= $row[0] . ",";
            }
            $response['counter'] = $counter;
            echo json_encode($response);
        }

        if($_GET['what'] == "listing_products_tot_months")
        {
            $response['xvalues'] = "";
            $response['yvalues'] = "";
            $query = mysqli_query($con, "SELECT COUNT(*), MONTHNAME(`created_at`) FROM `listing_products` WHERE `sell_status` = 'Unsold' AND YEAR(CURRENT_DATE) GROUP BY MONTHNAME(`created_at`);");
            $counter = 0;
            while($row = mysqli_fetch_array($query))
            {
                $counter = $counter + $row[0];
                $response['xvalues'] .= $row[1] . ",";
                $response['yvalues'] .= $row[0] . ",";
            }
            $response['counter'] = $counter;
            echo json_encode($response);
        }

        if($_GET['what'] == "sold_product_chart_actblock")
        {
            $response['xvalues'] = "Active, Block";
            $response['yvalues'] = "";
            $response['colors'] = "#0000D1, #D10000";

            $query = mysqli_query($con, "select count(*) from listing_products where product_status = 'Active' and sell_status='Sold'");
            $temp = mysqli_fetch_array($query);

            $response['yvalues'] .= $temp[0] . ",";

            $query = mysqli_query($con, "select count(*) from listing_products where product_status = 'Block' and sell_status='Sold'");
            $temp = mysqli_fetch_array($query);

            $response['yvalues'] .= $temp[0];

            echo json_encode($response);
        }

        if($_GET['what'] == "sold_products_tot_year")
        {
            $response['xvalues'] = "";
            $response['yvalues'] = "";
            $query = mysqli_query($con, "SELECT COUNT(*), YEAR(`created_at`) FROM `listing_products` WHERE `sell_status` = 'Sold' GROUP BY YEAR(`created_at`)");
            $counter = 0;
            while($row = mysqli_fetch_array($query))
            {
                $counter = $counter + $row[0];
                $response['xvalues'] .= $row[1] . ",";
                $response['yvalues'] .= $row[0] . ",";
            }
            $response['counter'] = $counter;
            echo json_encode($response);
        }

        if($_GET['what'] == "sold_products_tot_months")
        {
            $response['xvalues'] = "";
            $response['yvalues'] = "";
            $query = mysqli_query($con, "SELECT COUNT(*), MONTHNAME(`created_at`) FROM `listing_products` WHERE `sell_status` = 'Sold' AND YEAR(CURRENT_DATE) GROUP BY MONTHNAME(`created_at`);");
            $counter = 0;
            while($row = mysqli_fetch_array($query))
            {
                $counter = $counter + $row[0];
                $response['xvalues'] .= $row[1] . ",";
                $response['yvalues'] .= $row[0] . ",";
            }
            $response['counter'] = $counter;
            echo json_encode($response);
        }

        if($_GET['what'] == "revenue_tot_year")
        {
            $response['xvalues'] = "";
            $response['yvalues'] = "";
            $query = mysqli_query($con, "SELECT DISTINCT YEAR(`created_at`) FROM `subscription_selling`;");
            while($row = mysqli_fetch_array($query))
            {
                $response['xvalues'] .= $row[0] . ",";
                $query1 = mysqli_query($con, "SELECT SUM(`subscription_master`.`rate`) FROM `subscription_selling` JOIN `subscription_master` ON `subscription_selling`.`subscription_id` = `subscription_master`.`id` WHERE YEAR(`subscription_selling`.`created_at`) = " . $row[0] . ";");
                $counter = mysqli_fetch_array($query1);
                $response['yvalues'] = $counter[0] . ",";
            }

            echo json_encode($response);   
        }

        if($_GET['what'] == "revenue_tot_months")
        {
            $response['xvalues'] = "";
            $response['yvalues'] = "";
            $query = mysqli_query($con, "SELECT DISTINCT MONTHNAME(`created_at`) FROM `subscription_selling` WHERE YEAR(`created_at`) = YEAR(CURRENT_DATE);");
            while($row = mysqli_fetch_array($query))
            {
                $response['xvalues'] .= $row[0] . ",";
                $query1 = mysqli_query($con, "SELECT SUM(`subscription_master`.`rate`) FROM `subscription_selling` JOIN `subscription_master` ON `subscription_selling`.`subscription_id` = `subscription_master`.`id` WHERE YEAR(`subscription_selling`.`created_at`) = YEAR(CURRENT_DATE) AND MONTHNAME(`subscription_selling`.`created_at`) = '". $row[0] ."';");
                $counter = mysqli_fetch_array($query1);
                $response['yvalues'] .= $counter[0] . ",";
            }

            echo json_encode($response);   
        }

        if($_GET['what'] == "sendbusotp")
        {
            $query = mysqli_query($con, "select count(*) from user_master where email = '" . $_POST['email'] . "' and role = 1");
            $result = mysqli_fetch_array($query);

            if($result[0] != 0)
            {
                $otp = rand(100000, 999999);
                mail($_POST['email'], "OTP for password reset", "Dear User " . $_POST['email'] . ",\n\nYour OTP for reseting your password is $otp", "From:GhostMarketer");
                $response['success'] = true;
                $response['message'] = "OTP Send Successfully";
                $response['otp'] = $otp;
            }
            else
            {
                $response['success'] = false;
                $response['message'] = "Email ID not found. \nPlease try again";
            }

            echo json_encode($response);
        }

        if($_GET['what'] == "frgbuspas")
        {
            $query = mysqli_query($con, "update user_master set password = '". password_hash($_POST['newpas'], PASSWORD_DEFAULT) ."' where email = '". $_POST['email'] ."' and role = 1");

            if($query > 0)
            {
                $response['success'] = true;
                $response['message'] = "Password updated successfully";
            }
            else
            {
                $response['success'] = false;
                $response['message'] = "Some Error Occurred. \nPlease try again.";
            }
            echo json_encode($response);
        }

        if($_GET['what'] == "sendusrotp")
        {
            $query = mysqli_query($con, "select count(*) from user_master where email = '" . $_POST['email'] . "' and role = 2");
            $result = mysqli_fetch_array($query);

            if($result[0] != 0)
            {
                $otp = rand(100000, 999999);
                mail($_POST['email'], "OTP for password reset", "Dear User " . $_POST['email'] . ",\n\nYour OTP for reseting your password is $otp", "From:GhostMarketer");
                $response['success'] = true;
                $response['message'] = "OTP Send Successfully";
                $response['otp'] = $otp;
            }
            else
            {
                $response['success'] = false;
                $response['message'] = "Email ID not found. \nPlease try again";
            }

            echo json_encode($response);
        }

        if($_GET['what'] == "frgusrpas")
        {
            $query = mysqli_query($con, "update user_master set password = '". password_hash($_POST['newpas'], PASSWORD_DEFAULT) ."' where email = '". $_POST['email'] ."' and role = 2");

            if($query > 0)
            {
                $response['success'] = true;
                $response['message'] = "Password updated successfully";
            }
            else
            {
                $response['success'] = false;
                $response['message'] = "Some Error Occurred. \nPlease try again.";
            }
            echo json_encode($response);
        }

        if($_GET['what'] == "getcurrloc")
        {
            $query = mysqli_query($con, "select location from order_tracking where id = ". $_POST['id'] ."");
            $response = mysqli_fetch_array($query);

            echo json_encode($response);
        }

        if($_GET['what'] == "chngNewLoc")
        {
            if($_POST['status'] == "Packing")
            {
                if($_POST['location'] != "Seller")
                {
                    $query = mysqli_query($con, "update order_tracking set location = '". $_POST['location'] ."', status = 'In Transit' where id = ". $_POST['id'] ."");
                }
            }
            else
            {
                $query = mysqli_query($con, "update order_tracking set location = '". $_POST['location'] ."' where id = ". $_POST['id'] ."");
            }

            if($query > 0)
            {
                $response['success'] = true;
                $response['message'] = "Location changed successfully";
            }
            else
            {
                $response['success'] = false;
                $response['message'] = "Some error occurred. \nPlease try again";
            }

            echo json_encode($response);
        }

        if($_GET['what'] == "markasDel")
        {
            $query = mysqli_query($con, "SELECT `user_master`.`email`, `user_master`.`owner_name`, `listing_products`.`product_name`, `sold_master`.`quantity`, `sold_master`.`total_amount`, `sold_master`.`payment_mode` FROM `order_tracking` JOIN `sold_master` ON `order_tracking`.`sell_master_id` = `sold_master`.`id` JOIN `user_master` ON `user_master`.`id` = `sold_master`.`buyer_user_id` JOIN `listing_products` ON `listing_products`.`id` = `sold_master`.`product_id` WHERE `order_tracking`.`id` = ". $_POST['id'] ."");
            $email = mysqli_fetch_array($query);

            mail($email[0], "Order Delivered", "Dear " . $email[1] . ", Your Order has been delivered successfully. Order details are as below : \n\n\nProduct Name : " . $email['product_name'] . "\nQuantity : " . $email['quantity'] . "\nTotal Amount : " . $email['total_amount'] . "\nPayment Mode : " . $email['payment_mode'], "From:GhostMarketer");

            $query = mysqli_query($con, "update order_tracking set location = 'Buyer', status = 'Delivered' where id = ". $_POST['id'] ."");

            if($query > 0)
            {
                $response['success'] = true;
                $response['message'] = "Product has been marked as delivered and mail sent to customer.";
            }
            else
            {
                $response['success'] = false;
                $response['message'] = "Some error occurred.\nPlease try again.";
            }

            echo json_encode($response);
        }

        if($_GET['what'] == "returnRequestAppRej")
        {
            if($_POST['do'] == "Accepted")
            {
                $query = mysqli_query($con, "update return_order set status = '". $_POST['do'] ."' where id = ". $_POST['id'] ."");
                if($query > 0)
                {
                    $query = mysqli_query($con, "SELECT `return_order`.`id`, `listing_products`.`product_name`, `sold_master`.`id`, `user_master`.`owner_name`, `user_master`.`email` FROM `return_order` JOIN `sold_master` ON `sold_master`.`id` = `return_order`.`sell_master_id` JOIN `listing_products` ON `listing_products`.`id` = `sold_master`.`product_id` JOIN `user_master` ON `user_master`.`id` = `sold_master`.`buyer_user_id` WHERE `return_order`.`id` = ". $_POST['id'] ."");
                    $details = mysqli_fetch_array($query);

                    mail($details[4], "Return Request Accepted", "Dear " . $details[3] . ",\n\nYour request for product return, having return order id " . $details[0] . " has been Accepted by seller.\n\nYour Order ID : " .$details[2] . "\nProduct Name : " . $details[1] . "\nReturn Order ID : " . $details[0], "From:GhostMarketer");

                    $response['success'] = true;
                    $response['message'] = "Return Request Accepted Successfully";
                }
                else
                {
                    $response['success'] = false;
                    $response['message'] = "Some Error Occurred. \/Please try again.";
                }
            }
            else if($_POST['do'] == "Rejected")
            {
                $query = mysqli_query($con, "update return_order set status = '". $_POST['do'] ."' where id = ". $_POST['id'] ."");
                if($query > 0)
                {
                    $query = mysqli_query($con, "SELECT `return_order`.`id`, `listing_products`.`product_name`, `sold_master`.`id`, `user_master`.`owner_name`, `user_master`.`email` FROM `return_order` JOIN `sold_master` ON `sold_master`.`id` = `return_order`.`sell_master_id` JOIN `listing_products` ON `listing_products`.`id` = `sold_master`.`product_id` JOIN `user_master` ON `user_master`.`id` = `sold_master`.`buyer_user_id` WHERE `return_order`.`id` = ". $_POST['id'] ."");
                    $details = mysqli_fetch_array($query);

                    mail($details[4], "Return Request Rejected", "Dear " . $details[3] . ",\n\nYour request for product return, having return order id " . $details[0] . " has been Rejected by seller.\n\nYour Order ID : " .$details[2] . "\nProduct Name : " . $details[1] . "\nReturn Order ID : " . $details[0], "From:GhostMarketer");

                    $response['success'] = true;
                    $response['message'] = "Return Request Rejected Successfully";
                }
                else
                {
                    $response['success'] = false;
                    $response['message'] = "Some Error Occurred. \/Please try again.";
                }
            }

            echo json_encode($response);
        }

        if($_GET['what'] == "changeReturnOrderStatus")
        {
            $query = mysqli_query($con, "update return_order set status = '". $_POST['do'] ."' where id = ". $_POST['id'] ."");
            if($query > 0)
            {
                if($_POST['do'] == "Picked Up" || $_POST['do'] == "Completed" || $_POST['do'] == "Accepted")
                {
                    $query = mysqli_query($con, "SELECT `user_master`.`owner_name`, `user_master`.`email`, `sold_master`.`total_amount` FROM `return_order` JOIN `sold_master` ON `sold_master`.`id` = `return_order`.`sell_master_id` JOIN `user_master` ON `user_master`.`id` = `sold_master`.`buyer_user_id` WHERE `return_order`.`id` = ". $_POST['id'] ."");

                    $result = mysqli_fetch_array($query);

                    if($_POST['do'] == "Picked Up")
                    {
                        $subject = "Return Order Picked Up";
                        $message = "Dear " . $result[0] . ", \n\nYour return order having return order id " . $_POST['id'] . " has been picked up successfully by our delivery agent.\n\nYour refund of amount ". $result[2] ." will be transfered into your account within 24 hours after we receive the parcel. \n\nThank You.";
                    }
                    else if($_POST['do'] == "Accepted")
                    {
                        $subject = "Return Request Accepted";
                        $message = "Dear " . $result[0] . ", \n\nYour return order having return order id " . $_POST['id'] . " which earlier rejected, is now accepted by the vendor. \n\nYour parcel will be picked up by our delivery agent within 48 hours. \nWe are sorry for the inconvienece caused and thank you for your co operation.";
                    }
                    else
                    {
                        $subject = "Refund for Return Done";
                        $message = "Dear " . $result[0] . ", \n\nYour refund for the return order having return order id " . $_POST['id'] . " of amount ". $result[2] ." has been transfered to your bank account.\n\nWe are sorry for the inconvienece caused and thank you for your co operation.";
                    }

                    mail($result[1], $subject, $message, "From:GhostMarketer");
                }
                $response['success'] = true;
                $response['message'] = "Status Updated Successfully";
            }
            else
            {
                $response['success'] = false;
                $response['message'] = "Some Error Occurred.\nPlease try again.";
            }

            echo json_encode($response);
        }

        if($_GET['what'] == "particularBusinessCurrentYearMonthWise")
        {
            $query = mysqli_query($con, "SELECT COUNT(`sold_master`.`id`), MONTHNAME(`order_tracking`.`created_at`) FROM `sold_master` JOIN `order_tracking` ON `order_tracking`.`sell_master_id` = `sold_master`.`id` JOIN `listing_products` ON `listing_products`.`id` = `sold_master`.`product_id` JOIN `user_master` ON `user_master`.`id` = `listing_products`.`user_id` WHERE `sold_master`.`id` NOT IN (SELECT `id` FROM `return_order`) AND `order_tracking`.`status` = 'Delivered' AND `user_master`.`id` = ". $_SESSION['user_id'] ." AND YEAR(`order_tracking`.`created_at`) = YEAR(NOW()) GROUP BY MONTHNAME(`order_tracking`.`created_at`);");

            $response['xvalues'] = "";
            $response['yvalues'] = "";
            $counter = 0;
            while($row = mysqli_fetch_array($query))
            {
                $counter = $counter + $row[0];
                $response['xvalues'] .= $row[1] . ",";
                $response['yvalues'] .= $row[0] . ",";
            }
            $response['counter'] = $counter;
            echo json_encode($response);
        }

        if($_GET['what'] == "particularBusinessSelectedYearMonthWise")
        {
            $query = mysqli_query($con, "SELECT COUNT(`sold_master`.`id`), MONTHNAME(`order_tracking`.`created_at`) FROM `sold_master` JOIN `order_tracking` ON `order_tracking`.`sell_master_id` = `sold_master`.`id` JOIN `listing_products` ON `listing_products`.`id` = `sold_master`.`product_id` JOIN `user_master` ON `user_master`.`id` = `listing_products`.`user_id` WHERE `sold_master`.`id` NOT IN (SELECT `id` FROM `return_order`) AND `order_tracking`.`status` = 'Delivered' AND `user_master`.`id` = ". $_SESSION['user_id'] ." AND YEAR(`order_tracking`.`created_at`) = ". $_POST['year'] ." GROUP BY MONTHNAME(`order_tracking`.`created_at`);");

            $response['xvalues'] = "";
            $response['yvalues'] = "";
            $counter = 0;
            while($row = mysqli_fetch_array($query))
            {
                $counter = $counter + $row[0];
                $response['xvalues'] .= $row[1] . ",";
                $response['yvalues'] .= $row[0] . ",";
            }
            $response['counter'] = $counter;
            echo json_encode($response);
        }

        if($_GET['what'] == "particularBusinessCurrentYearMonthWiseReturnOrder")
        {
            $query = mysqli_query($con, "SELECT COUNT(`sold_master`.`id`), MONTHNAME(`order_tracking`.`created_at`) FROM `sold_master` JOIN `order_tracking` ON `order_tracking`.`sell_master_id` = `sold_master`.`id` JOIN `listing_products` ON `listing_products`.`id` = `sold_master`.`product_id` JOIN `user_master` ON `user_master`.`id` = `listing_products`.`user_id` WHERE `sold_master`.`id` IN (SELECT `id` FROM `return_order`) AND `order_tracking`.`status` = 'Delivered' AND `user_master`.`id` = ". $_SESSION['user_id'] ." AND YEAR(`order_tracking`.`created_at`) = YEAR(NOW()) GROUP BY MONTHNAME(`order_tracking`.`created_at`);");

            $response['xvalues'] = "";
            $response['yvalues'] = "";
            $counter = 0;
            while($row = mysqli_fetch_array($query))
            {
                $counter = $counter + $row[0];
                $response['xvalues'] .= $row[1] . ",";
                $response['yvalues'] .= $row[0] . ",";
            }
            $response['counter'] = $counter;
            echo json_encode($response);
        }

        if($_GET['what'] == "particularBusinessCurrentYearProductWiseReturnOrder")
        {
            $query = mysqli_query($con, "SELECT COUNT(*), `listing_products`.`product_name` FROM `return_order` JOIN `sold_master` ON `sold_master`.`id` = `return_order`.`sell_master_id` JOIN `listing_products` ON `listing_products`.`id` = `sold_master`.`product_id` JOIN `user_master` ON `user_master`.`id` = `listing_products`.`user_id` WHERE `user_master`.`id` = ". $_SESSION['user_id'] ." AND `return_order`.`status` = 'Completed' AND YEAR(`return_order`.`created_at`) = YEAR(NOW()) GROUP BY `listing_products`.`product_name`;");

            $response['xvalues'] = "";
            $response['yvalues'] = "";
            $counter = 0;
            while($row = mysqli_fetch_array($query))
            {
                $counter = $counter + $row[0];
                $response['xvalues'] .= $row[1] . ",";
                $response['yvalues'] .= $row[0] . ",";
            }
            $response['counter'] = $counter;
            echo json_encode($response);
        }


            // insert marketer
    if($_GET['what']=="insertMarketer")
    {
        $name=$_POST['txtName'];
        $mail = $_POST['txtMail'];
        $pass = password_hash($_POST['txtPwd'], PASSWORD_DEFAULT);
        // $product=$_POST['drpPrd'];
        // $commision = $_POST['txtCom'];

        $query = mysqli_query($con, "select count(*) from marketer where email = '" . $mail . "'");
        $result = mysqli_fetch_array($query);
        if($result[0] != 0)
        {
            $response['success'] = false;
            $response['message'] = "This mail id already exists.";
        }
        else
        {
            $query = mysqli_query($con, "insert into marketer (user_id,marketer_name,email,password,status) values (" . $_SESSION['user_id'] . ",'" . $name . "','" . $mail . "','" . $pass . "','Active')");
            if($query != 0)
            {
                $query = mysqli_query($con, "select * from user_master where id = ". $_SESSION['user_id'] ."");
                $result = mysqli_fetch_array($query);
                $subject = "Assigned as Marketer";
                $message = "Dear $name, \n\nYou are assigned as marketer for the following business - \n\n\nBusiness Name : " . $result['bussiness_name'] . "\nOwner Name : " . $result['owner_name'] . "\n\n\nYour Login Credentials are mentioned below : \n\nEmail : " . $mail . "\nPassword : " . $_POST['txtPwd'] . "\n\nUse this to login in your account and view your assigned products and all the best for your marketing journey. \n\n\n\nTeam :- Ghost Marketer";
                mail($mail, $subject, $message, "From:GhostMarketer");
                $response['success'] = true;
                $response['message'] = "Marketer added successfully";
                // $marketer_id = $con->insert_id;
                // $link = "localhost:4000/ghost/view_single_product.php?product_id=".$product."&marketer_id=" . password_hash($marketer_id, PASSWORD_DEFAULT);
                // $query = mysqli_query($con, "insert into assign_marketer (marketer_id,product_id,comission,status, link) values (" . $marketer_id . "," . $product . "," . $commision . ",'Active', '". $link ."')");
                // if($query != 0)
                // {
                //     $response['success'] = true;
                //     $response['message'] = "Marketer added successfully";
                // }
                // else
                // {
                //     $response['success'] = false;
                //     $response['message'] = "Some Error Occurred";
                // }
            }
            else
            {
                $response['success'] = false;
                $response['message'] = "Some Error Occurred";
            }
        }


        echo json_encode($response);
    }

    if($_GET['what']=="assignProduct")
    {
        $marketerId = $_POST['drpMark'];
        $commission = $_POST['txtCom'];
        $productId = $_POST['drpPrd'];

        $query = mysqli_query($con, "select count(*) from assign_marketer where marketer_id = " . $marketerId . " and product_id = " . $productId . "");
        $result = mysqli_fetch_array($query);

        if($result[0] == 0)
        {
            $link = "localhost:4000/ghost/view_single_product.php?product_id=".$productId."&marketer_id=" . password_hash($marketerId, PASSWORD_DEFAULT);
            $query = mysqli_query($con, "insert into assign_marketer (marketer_id,product_id,comission,status,link) values (" . $marketerId . "," . $productId . "," . $commission . ",'Active', '". $link ."')");
            if($query != 0)
            {
                $query = mysqli_query($con, "select * from marketer where id = ". $marketerId ."");
                $result = mysqli_fetch_array($query);

                $query2 = mysqli_query($con, "select * from listing_products where id = ". $productId ."");
                $result2 = mysqli_fetch_array($query2);

                $subject = "Product Assigned";
                $message = "Dear " . $result['marketer_name'] . ",\n\nYou have been assigned a product. Assigned product details are as below :- \n\n\nProduct Name : " . $result2['product_name'] . "\nProduct Description : " . $result2['product_description'] . "\nProduct Price : " . $result2['price'] . "\nYour Commission : " . $commission . "%\n\n\nTo sell product through you, you are given a link, please find it in your account by loging in.";

                mail($result['email'], $subject, $message, "From:GhostMarketer");
                $response['success'] = true;
                $response['message'] = "Product assigned successfully";
            }
            else
            {
                $response['success'] = false;
                $response['message'] = "Some Error Occurred";
            }
        }
        else
        {
            $response['success'] = false;
            $response['message'] = "This product is already assinged to this marketer";
        }

        echo json_encode($response);
    }
    //Block assign Marketer
    if($_GET['what']=="blockMarketerProduct")
    {
        $id = $_POST['id'];
        $query = mysqli_query($con, "update assign_marketer set status='Block' where id=" . $id . "");
        
        if($query>0)
        {
            $query = mysqli_query($con, "SELECT `marketer`.`marketer_name`, `marketer`.`email`, `listing_products`.`product_name` FROM `assign_marketer` JOIN `marketer` ON `marketer`.`id` = `assign_marketer`.`marketer_id` JOIN `listing_products` ON `listing_products`.`id` = `assign_marketer`.`product_id` JOIN `user_master` ON `user_master`.`id` = `marketer`.`user_id` WHERE `user_master`.`id` = ". $_SESSION['user_id'] .";");
            $result = mysqli_fetch_array($query);

            $to = $result[1];
            $subject = "Product Assigned Has been Blocked";
            $message = "Dear " . $result[0] . ",\n\nThe Product " . $result[2] . " has been blocked by business admin.\n\nNow your link given for it will be disabled. So now, no order can be placed through it.";
            mail($to, $subject, $message, "From:GhostMarketer");
            $response["success"] = true;
            $response["message"]="Marketer assign Product has been blocked successfully";
        }
        else
        {
            $response["success"] = false;
            $response["message"] = "Some Error Occurred. \nPlease try again";
        }
        echo json_encode($response);
    }
    //Active Assign Markter
    if($_GET['what']=="ActiveMarketerProduct")
    {
        $id = $_POST['id'];
        $query = mysqli_query($con, "update assign_marketer set status='Active' where id=" . $id . "");
        
        if($query>0)
        {
            $query = mysqli_query($con, "SELECT `marketer`.`marketer_name`, `marketer`.`email`, `listing_products`.`product_name` FROM `assign_marketer` JOIN `marketer` ON `marketer`.`id` = `assign_marketer`.`marketer_id` JOIN `listing_products` ON `listing_products`.`id` = `assign_marketer`.`product_id` JOIN `user_master` ON `user_master`.`id` = `marketer`.`user_id` WHERE `user_master`.`id` = ". $_SESSION['user_id'] .";");
            $result = mysqli_fetch_array($query);

            $to = $result[1];
            $subject = "Product Assigned Has been Activated";
            $message = "Dear " . $result[0] . ",\n\nThe Product " . $result[2] . " has been activated by business admin.\n\nNow your link given for it will be active. So now order can be placed through it.";
            mail($to, $subject, $message, "From:GhostMarketer");

            $response["success"] = true;
            $response["message"]="Marketer assign Product has been Active successfully";
        }
        else
        {
            $response["success"] = false;
            $response["message"] = "Some Error Occurred. \nPlease try again";
        }
        echo json_encode($response);
    }
     //Block Marketer
     if($_GET['what']=="blockMarketer")
     {
         $id = $_POST['id'];
         $query = mysqli_query($con, "update marketer set status='Block' where id=" . $id . "");
         
         if($query>0)
         {
             $response["success"] = true;
             $response["message"]="Marketer has been blocked successfully";
         }
         else
         {
             $response["success"] = false;
             $response["message"] = "Some Error Occurred. \nPlease try again";
         }
         echo json_encode($response);
     }
     //Active Marketer
     if($_GET['what']=="activeMarketer")
     {
         $id = $_POST['id'];
         $query = mysqli_query($con, "update marketer set status='Active' where id=" . $id . "");
         
         if($query>0)
         {
             $response["success"] = true;
             $response["message"]="Marketer  has been active successfully";
         }
         else
         {
             $response["success"] = false;
             $response["message"] = "Some Error Occurred. \nPlease try again";
         }
         echo json_encode($response);
     }
    //  edit retrive Value
     if($_GET['what']=="edit")
     {
        $id = $_POST['id'];
        $query = mysqli_query($con, "select * from assign_marketer where id=" . $id . "");
        
        
        $response[0]="";
        while($row=mysqli_fetch_array($query))
        {
            $query_marketer = mysqli_query($con,"select marketer_name from marketer where id=".$row['marketer_id']."");
            $row_marketer = mysqli_fetch_array($query_marketer);
            $query_product = mysqli_query($con,"select * from listing_products where  id=".$row['product_id']."");
            $row_product = mysqli_fetch_array($query_product);
            $response[0] .= "
                            <div class='form-group' hidden>
                                <input type='number' name='txtEditId' id='txtEditId' class='form-control' style=' border:1px solid lightgrey;' value='" . $row['id'] . "'>
                            </div>
                            <div class='form-group'>
                                <label style='font-size:15px;font-weight:500'>Marketer:</label>
                                <input type='text' name='txtEditMark' id='txtEditMark' class='form-control' style=' border:1px solid lightgrey;' readonly value='" . $row_marketer['marketer_name'] . "'>
                            </div>
                            <div class='form-group'>
                                <label style='font-size:15px;font-weight:500'>Product:</label>
                                <input type='text' name='txtEditProd' id='txtEditProd' class='form-control' style=' border:1px solid lightgrey;' readonly value='" . $row_product['product_name'] . "'>
                            </div
                            <div class='form-group'>
                                <label style='font-size:15px;font-weight:500'>Commission:</label>
                                <input type='number' name='txtEditCom' id='txtEditCom' class='form-control' style=' border:1px solid lightgrey;'  value='" . $row['comission'] . "'>
                                <span class='text-danger' style='font-size:small'>*Please enter Comission value only on percentage bases without percentage symbol*</span>
                                <span id='errorMsg'></span>
                            </div>";
        }
        echo json_encode($response);
    }
    // edit table
    if($_GET['what']=="editTable")
    {
        $id=$_POST['id'];
        $com=$_POST['com'];
        $query = mysqli_query($con, "update assign_marketer set comission=" . $com . " where id=" . $id . "");
        
        if($query>0)
        {
            $response['success'] = true;
            $response['message'] = "Commission updated successfully";
        }
        else
        {
            $response['success'] = false;
            $response['message'] = "Some Error Occurred. \nPlease try again";
        }
        echo json_encode($response);
    }

    // Check marketer login
    if($_GET['what']=="chkMarketerUser")
    {
        $mail=$_POST['mail'];
        $pass=$_POST['password'];
        $query_mail=mysqli_query($con,"select count(*) from marketer where email='".$mail."'");
        $ans_mail=mysqli_fetch_array($query_mail);
        if($ans_mail[0]>0)
        {
            $query_pass=mysqli_query($con,"select password from marketer where email='".$mail."'");
            $ans_pass=mysqli_fetch_array($query_pass);
            $result_pass=password_verify($pass,$ans_pass['password']);
            if($result_pass==true)
            {
                    $query_status=mysqli_query($con,"select status from marketer where email='".$mail."'");
                    $ans_status=mysqli_fetch_array($query_status);

                    if($ans_status['status']=='Active')
                    {
                        $query_buss=mysqli_query($con,"select * from marketer where email='".$mail."'");
                        $ans_buss=mysqli_fetch_array($query_buss);
                        $query_buss_status=mysqli_query($con,"select status,expiary_date from user_master where id=".$ans_buss['user_id']."");
                        $ans_buss_status=mysqli_fetch_array($query_buss_status);
                        if($ans_buss_status['status']=='active')
                        {
                            $query_buss_date=mysqli_query($con,"select count(*) from user_master where id=".$ans_buss['user_id']." and datediff('".$ans_buss_status['expiary_date'] ."',CURRENT_DATE) > 0");
                            $ans_buss_date=mysqli_fetch_array($query_buss_date);
                            if($ans_buss_date[0]>0)
                            {
                                $_SESSION['mark_id']=$ans_buss['id'];
                                $_SESSION['mark_name']=$ans_buss['marketer_name'];
                                $_SESSION['mark_mail']=$ans_buss['email'];
                                $_SESSION['mark_Buss_id']=$ans_buss['user_id'];
                                $response['success']=true;
                                $response['message']="Login Successfully";

                        }
                        else
                        {
                            $response['success']=false;
                            $response['message']="Your Main Bussiness plan has been expiare";
                        }
                    }
                    else
                    {
                        $response['success']=false;
                        $response['message']="Your Main bussiness account has been block";   
                    }
                }
                else
                {
                  $response['success']=false;
                  $response['message']="Your account has been block";
                }
             
        }
        else
        {
                $response['success']=false;
                $response['message']="Password does not match";  
        }
    }
    else
    {
        $response['success'] = false;
        $response['message'] = "Email does not match";
    }
    echo json_encode($response);
    }

    //Marketer Page Product Page View Modal
    if($_GET['what'] == "getSpecificMarketerDataForProduct")
    {
        $query = mysqli_query($con, "SELECT MONTHNAME(`created_at`), COUNT(*) FROM `sold_master` WHERE `product_id` = ". $_POST['id'] ." AND `marketer_id` = ". $_SESSION['mark_id'] ." AND YEAR(`created_at`) = YEAR(NOW()) GROUP BY MONTHNAME(`created_at`)");

        $response[0] = "";
        while($row = mysqli_fetch_array($query))
        {
            $response[0] .= "<tr>";
            $response[0] .= "<td>". $row[0] ."</td>";
            $response[0] .= "<td>". $row[1] ."</td>";
            $response[0] .= "</tr>";
        }
        if($response[0]=="")
        {
            $response[0] .= "<tr>";
            $response[0] .= "<td colspan='2'><b><center>No record available</center></b></td>";
           $response[0] .= "<tr>"; 
        }

        echo json_encode($response[0]);
    }

    if($_GET['what'] == "current_year_month_wise_revenue_for_marketer")
    {
        $response['xvalues'] = "";
        $response['yvalues'] = "";
        $counter = 0;
        $query = mysqli_query($con, "SELECT MONTHNAME(`created_at`), SUM(`marketer_commission`) FROM `sold_master` WHERE YEAR(`created_at`) = YEAR(NOW()) AND `marketer_id` = ". $_SESSION['mark_id'] ." AND `sold_master`.`id` NOT IN (SELECT `return_order`.`sell_master_id` FROM `return_order`) GROUP BY MONTHNAME(`created_at`);");
        while($row = mysqli_fetch_array($query))
        {
            $response['xvalues'] .= $row[0] . ",";
            $response['yvalues'] .= $row[1] . ",";
            $counter = $counter + $row[1];
        }

        echo json_encode($response); 
    }

    if($_GET['what'] == "current_year_product_wise_revenue_for_marketer")
    {
        $response['xvalues'] = "";
        $response['yvalues'] = "";
        $counter = 0;
        $query = mysqli_query($con, "SELECT `listing_products`.`product_name`, SUM(`quantity`), `sold_master`.`created_at` FROM `sold_master` JOIN `listing_products` ON `listing_products`.`id` = `sold_master`.`product_id` WHERE `sold_master`.`marketer_id` = ". $_SESSION['mark_id'] ." AND YEAR(`sold_master`.`created_at`) = YEAR(NOW()) AND `sold_master`.`id` NOT IN (SELECT `return_order`.`sell_master_id` FROM `return_order`) GROUP BY `product_id`;");
        while($row = mysqli_fetch_array($query))
        {
            $response['xvalues'] .= $row[0] . ",";
            $response['yvalues'] .= $row[1] . ",";
            $counter = $counter + $row[1];
        }

        echo json_encode($response); 
    }

    if($_GET['what'] == "custom_report_revenue_for_marketer")
    {
        if($_POST['report'] == "selected_year_month_wise")
        {
            $query = mysqli_query($con, "SELECT MONTHNAME(`created_at`), SUM(`marketer_commission`) FROM `sold_master` WHERE YEAR(`created_at`) = ". $_POST['year'] ." AND `marketer_id` = ". $_SESSION['mark_id'] ." AND `sold_master`.`id` NOT IN (SELECT `return_order`.`sell_master_id` FROM `return_order`) GROUP BY MONTHNAME(`created_at`);");
        }
        else
        {
            $query = mysqli_query($con, "SELECT `listing_products`.`product_name`, SUM(`quantity`), `sold_master`.`created_at` FROM `sold_master` JOIN `listing_products` ON `listing_products`.`id` = `sold_master`.`product_id` WHERE `sold_master`.`marketer_id` = ". $_SESSION['mark_id'] ." AND YEAR(`sold_master`.`created_at`) = ". $_POST['year'] ." AND `sold_master`.`id` NOT IN (SELECT `return_order`.`sell_master_id` FROM `return_order`) GROUP BY `product_id`;");
        }
        
        $response['xvalues'] = "";
        $response['yvalues'] = "";
        $counter = 0;
        while($row = mysqli_fetch_array($query))
        {
            $response['xvalues'] .= $row[0] . ",";
            $response['yvalues'] .= $row[1] . ",";
            $counter = $counter + $row[1];
        }

        echo json_encode($response); 
    }

    if($_GET['what'] == "active_to_block")
    {
        $query = mysqli_query($con, "SELECT COUNT(*) FROM `listing_products` WHERE `product_status` = 'Active' AND `user_id` = ". $_SESSION['user_id'] ."");

        $response['xvalues'] = "";
        $response['yvalues'] = "";
        $response['colors'] = "";

        $result = mysqli_fetch_array($query);

        $response['xvalues'] = "Active,Block";
        $response['yvalues'] = $result[0] . ",";
        $response['colors'] = "#0000D1,";

        $query = mysqli_query($con, "SELECT COUNT(*) FROM `listing_products` WHERE `product_status` = 'Block' AND `user_id` = ". $_SESSION['user_id'] ."");
        $result = mysqli_fetch_array($query);

        $response['yvalues'] .= $result[0];
        $response['colors'] .= "#00D100";

        echo json_encode($response);
    }

    if($_GET['what'] == "product_wise_business_selling_pie_chart")
    {
        $query = mysqli_query($con, "SELECT `listing_products`.`product_name`, SUM(`sold_master`.`quantity`) FROM `sold_master` JOIN `listing_products` ON `listing_products`.`id` = `sold_master`.`product_id` WHERE `listing_products`.`user_id` = ". $_SESSION['user_id'] ." GROUP BY `listing_products`.`product_name`");

        $response['xvalues'] = "";
        $response['yvalues'] = "";
        $response['colors'] = "";
        while($row = mysqli_fetch_array($query))
        {
            $response['xvalues'] .= $row[0] . ",";
            $response['yvalues'] .= $row[1] . ",";
            $response['colors'] .= "#" . str_pad(dechex(rand(0x000000, 0xFFFFFF)), 6, 0, STR_PAD_LEFT) . ",";
        }

        echo json_encode($response);
    }

    if($_GET['what'] == "GetSpecificProductImagesForAgentSellingPage")
    {
        $query = mysqli_query($con, "SELECT `img1`, `img2`, `img3`,`img4` FROM `listing_products` WHERE `id` = ".$_SESSION['product_id']."");

        $row = mysqli_fetch_array($query);

        $counter = 1;
        $response['img1'] = $row['img1'];

        $response['img2'] = $row['img2'];
        if($row['img2'] != "" && $row['img2'] != null)
        {
            $counter += 1;
        }

        $response['img3'] = $row['img3'];
        if($row['img3'] != "" && $row['img3'] != null)
        {
            $counter += 1;
        }

        $response['img4'] = $row['img4'];
        if($row['img4'] != "" && $row['img4'] != null)
        {
            $counter += 1;
        }

        $response['counter'] = $counter;

        echo json_encode($response);
    }

    // add in wishlist
    if($_GET['what'] == "wishlistAUserItem")
    {
        if(!isset($_SESSION['front_user_id']) || $_SESSION['front_user_id'] == "" || $_SESSION['front_user_id'] == null)
        {
            $response['success'] = false;
            $response['url'] = "../user_login.php";
        }
        else
        {
            //add in wishlist

        $query = mysqli_query($con, "insert into wishlist_master(user_id, product_id) values(". $_SESSION['front_user_id'] .", ". $_POST['product_id'] .")");
        if($query > 0)
        {
            $response['success'] = true;
            $response['message'] = "Item addedd to wishlist";
        }

    }

    echo json_encode($response);
    }
    //remove whishlist
    if($_GET['what']=="removeWishList")
    {
    $pid=$_POST['pid'];
    $query=mysqli_query($con,"delete from wishlist_master where product_id=".$pid." and user_id=".$_SESSION['front_user_id']."");
    if($query>0)
    {
        $response['success']=true;
        $response['message']="Wishlist remove successfully";
    }
    else
    {
        $response['success']=false;
        $response['message']="Some Error Occurred.\nPlease try again";
    }
    echo json_encode($response);
    }
    if($_GET['what']=="checkAddToCart")
    {
    $prodid=$_POST['pid'];
    if(!isset($_SESSION['front_user_id']) || $_SESSION['front_user_id']=="" || $_SESSION['front_user_id']==null)
    {
        $response['success']=false;
        $response['url']="../user_login.php";
    }
    else
    {
        $query=mysqli_query($con,"insert into cart (user_id,product_id) values (".$_SESSION['front_user_id'].",".$prodid.")");
        if($query>0)
        {
            $response['success']=true;
            $response['message']="Product added successfully";
        }
        else
        {
            $response['success']=false;
            $response['message']="Some Error Occurred.\nPlease try again";
        }
    }
    echo json_encode($response);
    }
    // remove product from cart
    if($_GET['what']=="removeCartList")
    {
    $pid=$_POST['pid'];
    $query=mysqli_query($con,"delete from cart where product_id=".$pid." and user_id=".$_SESSION['front_user_id']."");
    if($query>0)
    {
        $response['success']=true;
        $response['message']="Product remove sucessfully";
    }
    else
    {
        $response['success']=false;
        $response['message']="Some Error Occurred.\nPlease try again";
    }
    echo json_encode($response);
    }
    // Check login on view more
    if($_GET['what']=="checkViewMore")
    {
    $id=$_POST['id'];
    // if(!isset($_SESSION['front_user_id']) || $_SESSION['front_user_id']=="" || $_SESSION['front_user_id']==null)
    // {
    //     $response['success']=true;
    //     $response['url']="../user_login.php";
    // }
    // if(true)
    // {
        $query=mysqli_query($con,"select * from listing_products where id=".$id."");
        while($row=mysqli_fetch_array($query))
        {
            $query_user=mysqli_query($con,"select * from user_master where id=".$row['user_id']."");
            while($row_user=mysqli_fetch_array($query_user))
            {
                if($row_user['role']=='1')
                {
                    $response['success']=false;
                    $response['url']="buss_view_more.php?id=".$id."";
                }
                else
                {
                    $response['success']=false;
                    $response['url']="user_view_more.php?id=".$id."";
                }
            }
        }
    // }
        echo json_encode($response);
    }

    if($_GET['what'] == "getMaxPriceProduct")
    {
        $query = mysqli_query($con, "select max(price) from listing_products");
        $result = mysqli_fetch_array($query);

        $response[0] = round($result[0]);

        echo json_encode($response);
    }

    if($_GET['what'] == "EmptyWishlist")
    {
        $query = mysqli_query($con, "DELETE FROM `wishlist_master` WHERE `user_id` = ". $_SESSION['front_user_id'] ."");

        if($query > 0)
        {
            $response['success'] = true;
        }
        else
        {
            $response['success'] = false;
            $response['message'] = "Some Error occurred. \nPlease try again.";
        }

        echo json_encode($response);
    }

    if($_GET['what'] == "removeFromCartFromUserChekout")
    {
        $query = mysqli_query($con, "DELETE FROM `cart` WHERE `id` = ". $_POST['cid'] ."");

        if($query > 0)
        {
            $response['success'] = true;
        }
        else
        {
            $response['success'] = false;
            $response['message'] = "Some error occurred. \nPlease try again later";
        }

        echo json_encode($response);
    }

    if($_GET['what'] == "updateUserCart")
    {
        $cids = $_POST['cid'];
        $qtys = $_POST['qty'];

        $cid = explode(",", $cids);
        $qty = explode(",", $qtys);

        array_pop($qty);
        array_pop($cid);

        for($i = 0; $i < count($cid); $i++)
        {
            $query = mysqli_query($con, "update cart set quantity = ". $qty[$i] ." where id = ". $cid[$i] ."");
        }

        if($query > 0)
        {
            $response['success'] = true;
        }
        else
        {
            $response['success'] = false;
            $response['message'] = "Some error occurred. \nPlease try again.";
        }

        echo json_encode($response);
    }

    if($_GET['what'] == "fromCartToCheckoutProcess")
    {
        $pid = explode(",", $_POST['pid']);
        array_pop($pid);

        $qty = explode(",", $_POST['qty']);
        array_pop($qty);

        $_SESSION['pids'] = [];
        $_SESSION['pnames'] = [];
        $_SESSION['qtys'] = [];
        $_SESSION['prices'] = [];

        $_SESSION['total'] = 0;
        $_SESSION['total_qty'] = 0;
        for($i = 0; $i < count($pid); $i++)
        {
            $query = mysqli_query($con, "SELECT * FROM `listing_products` WHERE `id` = ". $pid[$i] ."");
            $result = mysqli_fetch_array($query);

            array_push($_SESSION['qtys'], trim($qty[$i]));
            array_push($_SESSION['pids'], trim($pid[$i]));
            array_push($_SESSION['pnames'], $result['product_name']);
            array_push($_SESSION['prices'], $result['price']);       
            
            $_SESSION["total"] += round(($result['price'] * $qty[$i]), 2);
            $_SESSION['total_qty'] += $qty[$i];
        }

        $response['url'] = "checkout.php";

        echo json_encode($response);
    }

    if($_GET['what'] == "checkoutUserRemoveCart")
    {
        $response['oids'] = [];
        $_SESSION['oids'] = [];
        for($i = 0; $i < count($_SESSION['qtys']); $i++)
        {
            $query = mysqli_query($con, "insert into sold_master(product_id, buyer_user_id, quantity, total_amount, payment_mode, selling_date) values(". $_SESSION['pids'][$i] .", ". $_SESSION['front_user_id'] .", ". $_SESSION['qtys'][$i] .", ". round(($_SESSION['qtys'][$i] * $_SESSION['prices'][$i]), 2) .", 'Cash on Delivery', '". date("Y-m-d") ."');");

            if($query > 0)
            {
                $sid = $con->insert_id;
                $query = mysqli_query($con, "insert into order_tracking(sell_master_id, status, location) values(". $sid .", 'Packing', 'Buyer')");

                if($query > 0)
                {
                    array_push($response['oids'], $con->insert_id);
                    array_push($_SESSION['oids'], $con->insert_id);
                }
            }
        }

        $query = mysqli_query($con, "DELETE FROM `cart` WHERE `user_id` = ". $_SESSION['front_user_id'] ."");

        if($query > 0)
        {
            $response['success'] = true;
            $to = $_SESSION['front_mail'];
            $subject = "Order Placed Successfully";
            $message = "Dear " . $_SESSION['front_name'] . ",\nYour Order has been successfully placed for : \n";

            for($i = 0; $i < count($_SESSION['qtys']); $i++)
            {
                $message .= "\n" . $_SESSION['pnames'][$i] . " x " . $_SESSION['qtys'][$i];
            }

            $message .= "\nYour Total Billing Amount is " . $_SESSION['total'] . "\nYou can check your order status through order page link given below :- \nwww.localhost:4000/ghost/user/order.php";

            mail($to, $subject, $message, "From:GhostMarketer");
        }
        else
        {
            $response['success'] = false;
        }


        echo json_encode($response);
    }

    if($_GET['what'] == "addParticularProductToCart")
    {
        if(!isset($_SESSION['front_user_id']))
        {
            $response['login'] = false;
            $response['url'] = "../user_login.php";
        }
        else
        {
            $query = mysqli_query($con, "SELECT COUNT(*) FROM `cart` WHERE `user_id` = ". $_SESSION['front_user_id'] ." AND `product_id` = ". $_POST['pid'] ."");
            $result = mysqli_fetch_array($query);
    
            if($result[0] > 0)
            {
                $query = mysqli_query($con, "UPDATE `cart` SET `quantity` = `quantity` + ". $_POST['qty'] ." WHERE `user_id` = ". $_SESSION['front_user_id'] ." AND `product_id` = ". $_POST['pid'] ."");
    
                if($query > 0)
                {
                    $response['success'] = true;
                }
                else
                {
                    $response['success'] = false;
                }
            }
            else
            {
                $query = mysqli_query($con, "INSERT INTO `cart`(`user_id`, `product_id`, `quantity`) VALUES(". $_SESSION['front_user_id'] .", ". $_POST['pid'] .", ". $_POST['qty'] .")");
    
                if($query > 0)
                {
                    $response['success'] = true;
                }
                else
                {
                    $response['success'] = false;
                }
            }
        }

        echo json_encode($response);
    }

    if($_GET['what'] == "buyNowDirectlyFromViewMore")
    {
        $_SESSION['pids'] = [];
        $_SESSION['pnames'] = [];
        $_SESSION['qtys'] = [];
        $_SESSION['prices'] = [];

        $_SESSION['total'] = 0;
        $_SESSION['total_qty'] = 0;

        array_push($_SESSION['pids'], $_POST['pid']);
        array_push($_SESSION['qtys'], $_POST['qty']);

        $query = mysqli_query($con, "select * from listing_products where id = ". $_POST['pid'] ."");
        $result = mysqli_fetch_array($query);

        if($result['sell_status'] == "Unsold" && $result['product_status'] == "Active")
        {
            array_push($_SESSION['pnames'], $result['product_name']);
            array_push($_SESSION['prices'], $result['price']);
    
            $_SESSION['total_qty'] = $_POST['qty'];
            $_SESSION['total'] = round(($_POST['qty'] * $result['price']), 2);
    
            $response['url'] = "checkout.php";
            $response['success'] = true;
        }
        else
        {
            $response['success'] = false;
            $response['message'] = "The product has been blocked or sold out.";
        }

        echo json_encode($response);

    }

    if($_GET['what'] == "sendFeedBack")
    {
        $query = mysqli_query($con, "insert into feedback(user_email, message, status) values('". $_POST['emailId'] ."', '". $_POST['feedBackTxt'] ."', 'Unseen')");

        if($query > 0)
        {
            $response['success'] = true;
            $response['message'] = "Feedback sent successfully";
        }
        else
        {
            $response['success'] = false;
            $response['message'] = "Some error occured. \nPlease try again.";
        }
        echo json_encode($response);
    }

    if($_GET['what'] == "getCurrentUserDetailsForUserToPremium")
    {
        $query = mysqli_query($con, "SELECT * FROM `user_master` WHERE `id` = ". $_SESSION['front_user_id'] ."");
        $result = mysqli_fetch_array($query);

        $response['name'] = $result['owner_name'];
        $response['email'] = $result['email'];
        $response['phone'] = $result['phone'];

        echo json_encode($response);
    }

    if($_GET['what'] == "userUpgradeToPremium")
    {
        $query = mysqli_query($con, "SELECT `time_perioud` FROM `subscription_master` WHERE `id` = ". $_POST['pid'] ."");
        $result = mysqli_fetch_array($query);

        $expiry_date = date('Y-m-d', strtotime(date("Y-m-d"). ' + '. $result[0] .' days'));

        $query = mysqli_query($con, "insert into subscription_selling(subscription_id, user_id, payment_mode, expiary_date) values(". $_POST['pid'] .", ". $_SESSION['front_user_id'] .", 'Razorpay', '". $expiry_date ."')");

        $query = mysqli_query($con, "update user_master set subscrib_id = ". $_POST['pid'] .", expiary_date = '". $expiry_date ."' where id = ". $_SESSION['front_user_id'] ."");

        $_SESSION['front_user_premium'] = true;

        if($query > 0)
        {
            $response['success'] = true;
            $response['message'] = "Account Upgraded Successfully";
        }
        else
        {
            $response['success'] = false;
            $response['message'] = "Something went wrong.\nPlease try again after some time.";
        }

        echo json_encode($response);
    }

    if($_GET['what'] == "sendUpgradationMail")
    {
        $to = $_SESSION['front_mail'];
        $subject = "Congratulations on becoming a premium user";

        $message = "Dear " . $_SESSION['front_name'] . ",\nYour account with Ghost Marketer has been upgraded to a premium account.Enjoy more libral and more facilities on your account.";

        mail($to, $subject, $message, 'From:GhostMarketer');
    }

    // Update User Product Detail
    if($_GET['what']=="editUserProduct")
    {
        $id = $_POST['id'];
        $query = mysqli_query($con, "select * from listing_products where id=" . $id . "");
        $response[0]="";
        while($row=mysqli_fetch_array($query))
        {
            $query_catagory = mysqli_query($con, "select name from category_master where id=" . $row['catagory_id'] . "");
            $result = mysqli_fetch_array($query_catagory);
            $img1 = trim($row['img1']);
            $img2 = trim($row['img2']);
            $img3 = trim($row['img3']);
            $img4 = trim($row['img4']);
            $img1_disabled = "";
            $img2_disabled = "";
            $img2_chkbox = false;
            $img3_disabled = "";
            $img3_chkbox = false;
            $img4_disabled = "";
            $img4_chkbox = false;
            if($img2 != "" && $img2 != null)
            {
                $img2_disabled = "";
                $img2_chkbox = true;
                $img3_disabled = "";
                $img4_disabled = "disabled";
            }
            else
            {
                $img2_disabled = "";
                $img3_disabled = "disabled";
                $img4_disabled = "disabled";
            }
            if($img3 != "" && $img3 != null)
            {
                $img2_disabled = "";
                $img2_chkbox = true;
                $img3_disabled = "";
                $img3_chkbox = true;
                $img4_disabled = "";
            }
            if($img4 != "" && $img4 != null)
            {
                $img2_disabled = "";
                $img2_chkbox = true;
                $img3_disabled = "";
                $img3_chkbox = true;
                $img4_disabled = "";
                $img4_chkbox = true;
            }
    $response[0] .= " <div class='form-group'>
                                <label style='font-size:15px;font-weight:500'>Category Name:</label>
                                <input type='text' id='txtCatName' name='txtCatame' class='form-control' placeholder='Name' readonly value='" . $result['name'] . "'/>
                              </div>
                              <div class='form-group' hidden>
                                <input type='text' name='pid' id='pid' value='" . $row['id'] . "' />
                              </div>
                            <div class='form-group'>
                                <label style='font-size:15px;font-weight:500'>Name:</label>
                                <input type='text' id='txtName' name='txtName' class='form-control' readonly value='" . $row['product_name'] . "' placeholder='Name'/>
                            </div>
                            <div class='form-group'>
                                <label style='font-size:15px;font-weight:500'>Description:</label>
                                <textarea type='text' id='txtDesUpd' name='txtDesUpd' class='form-control' placeholder='Description'>" . $row['product_description'] . "</textarea>
                            </div>
                            <div class='form-group'>
                                <label style='font-size:15px;font-weight:500'>Price:</label>
                                <input type='number' id='txtPriceUpd' name='txtPriceUpd' class='form-control' value='" . $row['price'] . "' placeholder='Price'/>
                            </div>
                            <div class='form-group'>
                                <label class='form-label'>Image1:</label>
                                <input type='file' class='form-control' accept='image/*' id='img1Upd' name='img1Upd' />
                            </div>";
            $response[0] .= "<div class='form-group'>
                                <label class='form-label'>Image2:</label>
                                <input type='file' class='form-control' accept='image/*' $img2_disabled id='img2Upd' name='img2Upd' />
                            </div>";
            if($img2_chkbox)
            {
                $response[0] .= "<div class='form-group'>Check If you want to delete Image 2 <span style='font-size:small;color:red;'>(removing image2 will remove successive images also)</span> : <input type='checkbox' name='delete_img2' id='delete_img2' class='' /></div>";
            }
            $response[0] .= "<div class='form-group'>
                                <label class='form-label'>Image3:</label>
                                <input type='file' class='form-control' accept='image/*' $img3_disabled id='img3Upd' name='img3Upd' />
                            </div>";
            if($img3_chkbox)
            {
                $response[0] .= "<div class='form-group'>Check If you want to delete Image 3 <span style='font-size:small;color:red;'>(removing image3 will remove successive images also)</span> : <input type='checkbox' name='delete_img3' id='delete_img3' class='' /></div>";
            }
            $response[0] .= "<div class='form-group'>
                                <label class='form-label'>Image4:</label>
                                <input type='file' class='form-control' accept='image/*' $img4_disabled id='img4Upd' name='img4Upd' />
                            </div>";
            if($img4_chkbox)
            {
                $response[0] .= "<div class='form-group'>Check If you want to delete Image 4 <span style='font-size:small;color:red;'>(removing image4 will remove successive images also)</span> : <input type='checkbox' name='delete_img4' id='delete_img4' class='' /></div>";
            }
            }
        echo json_encode($response);
    }

    // Unsold User Product
    if($_GET['what']=="UnsoldUserProduct")
    {
        $id = $_POST['id'];
        $query = mysqli_query($con, "update listing_products set sell_status='Sold' where id=" . $id . " ");
        if($query>0)
        {
            $response["success"]=true;
            $response["message"] = "Product has been Sold Successfuly";
        }
        else
        {
            $response["success"] = False;
            $response["message"] = "Some Error Occurred. \nPlease try again";
        }
        echo json_encode($response);
    }
  //   Sold User Product
    if($_GET['what']=="SoldUserProduct")
    {
        $id = $_POST['id'];
        $query = mysqli_query($con, "update listing_products set sell_status='Unsold' where id=" . $id . "");
        if($query>0)
        {
            $response["success"] = true;
            $response["message"]="Product has been Unsold successfully";
        }
        else
        {
            $response["success"]=false;
            $response["message"]="Some Error Occurred. \nPlease try again";
        }
        echo json_encode($response);
    }
    // Block User Product
    if($_GET['what']=="blockUserProduct")
    {
        $id = $_POST['id'];
        $query = mysqli_query($con, "update listing_products set product_status='Block' where id=" . $id . "");
        if($query>0)
        {
            $query = mysqli_query($con, "delete from cart where product_id = ". $id ."");
            $response["success"] = true;
            $response["message"]="Product has been blocked successfully";
        }
        else
        {
            $response["success"] = false;
            $response["message"] = "Some Error Occurred. \nPlease try again";
        }
        echo json_encode($response);
    }
    // Active user Product
    if($_GET['what']=="activeUserProduct")
    {
        $id = $_POST['id'];
        $query = mysqli_query($con, "SELECT COUNT(*) FROM `listing_products` WHERE `id` = ". $id ." AND `Block_By` IS NULL;");
        $result = mysqli_fetch_array($query);
        if($result[0] == 0)
        {
            $response["success"] = false;
            $response["message"] = "Product is Blocked by Ghost Marketer. Please contact on our helpdesk email for unblocking the product";
        }
        else
        {
            $query = mysqli_query($con, "update listing_products set product_status='Active' where id=" . $id . "");
            if($query>0)
            {
                $response["success"] = true;
                $response["message"]="Product has been Active successfully";
            }
            else
            {
                $response["success"]=false;
                $response["message"] = "Some Error Occurred. \nPlease try again";
            }
        }
        // $query = mysqli_query($con, "select * from listing_products where id = ". $id ."");
        // $result = mysqli_fetch_array($query);
        // if($result['Block_By'] == "Admin")
        // {
        //     $response["success"] = false;
        //     $response["message"] = "Product is Blocked by Ghost Marketer. Please contact on our helpdesk email for unblocking the product";
        // }
        // else
        // {
        //     $query = mysqli_query($con, "update listing_products set product_status='Active' where id=" . $id . "");
        //     if($query>0)
        //     {
        //         $response["success"] = true;
        //         $response["message"]="Product has been Active successfully";
        //     }
        //     else
        //     {
        //         $response["success"]=false;
        //         $response["message"] = "Some Error Occurred. \nPlease try again";
        //     }
        // }
        echo json_encode($response);
    }

    // View More User Product detail
    if($_GET['what']=="viewMoreUserProduct")
    {
        $id=$_POST['id'];
        $query = mysqli_query($con, "select * from listing_products where id=" . $id . "");
        $response[0]="";
        while($row=mysqli_fetch_array($query))
        {
            $query_catagory = mysqli_query($con, "select name from category_master where id=" . $row['catagory_id'] . "");
            $result = mysqli_fetch_array($query_catagory);
            $img2 = trim($row['img2']);
            $img3 = trim($row['img3']);
            $img4 = trim($row['img4']);
            // if($img2 == "" || $img2 == NULL)
            // {
            //     $img2 = "<span style='font-size:110%'>Image is Not Available</span>";
            // }
            // else
            // {
            //     $img2 = "<img src='../product_image/". $img2 ."' width='50%' class='rounded' />";
            // }
            // if($img3 == "" || $img3 == NULL)
            // {
            //     $img3 = "<span style='font-size:110%'>Image is Not Available</span>";
            // }
            // else
            // {
            //     $img3 = "<img src='../product_image/". $img3 ."' width='50%' class='rounded' />";
            // }
            // if($img4 == "" || $img4 == NULL)
            // {
            //     $img4 = "<span style='font-size:110%'>Image is not Available</span>";
            // }
            // else
            // {
            //     $img4 = "<img src='../product_image/". $img4 ."' width='50%' class='rounded' />";
            // }
            if (($img2 == "" || $img2 == NULL) && ($img3 == "" || $img3 == NULL) && ($img4 == "" || $img4 == NULL))
            {
                $img2 = "<span style='font-size:110%'>Image is not Available</span>";
                $img3 = "<span style='font-size:110%'>Image is not Available</span>";
                $img4 = "<span style='font-size:110%'>Image is not Available</span>";
            }
            else if(($img3 == "" || $img3 == NULL) && ($img4 == "" || $img4 == NULL))
            {
                $img2 = "<img src='../product_image/". $img2 ."' width='50%' class='rounded' />";
                $img3 = "<span style='font-size:110%'>Image is not Available</span>";
                $img4 = "<span style='font-size:110%'>Image is not Available</span>";
            }
            else if ($img4 == "" || $img4 == NULL)
            {
                $img2 = "<img src='../product_image/". $img2 ."' width='50%' class='rounded' />";
                $img3 = "<img src='../product_image/". $img3 ."' width='50%' class='rounded' />";
                $img4 = "<span style='font-size:110%'>Image is not Available</span>";
            }
            else
            {
                $img2 = "<img src='../product_image/". $img2 ."' width='50%' class='rounded' />";
                $img3 = "<img src='../product_image/". $img3 ."' width='50%' class='rounded' />";
                $img4 = "<img src='../product_image/". $img4 ."' width='50%' class='rounded' />";
            }
            $response[0] .= "<div class='row'><ul><div class='col-12' style='font-size:130%;font-weight:bold;'><li>Catagory Name:</li></div></ul></div><div class='row'><div class='col-12' style='font-size:110%;'>" . $result['name'] . "</div></div><br/><div class='row'><div class='col-12' style='font-size:130%;font-weight:bold;'><ul><li>Product Name :</li></ul></div></div><div class='row'><div class='col-12' style='font-size:110%;'>" . $row['product_name'] . "</div></div><br/><div class='row'><div class='col-12' style='font-size:130%;font-weight:bold;'><ul><li>Description :</div></div><div class='row'><div class='col-12' style='font-size:110%;'>".$row['product_description']."</div></div><br/><div class='row'><div class='col-12' style='font-size:130%;font-weight:bold;'><ul><li>Price :</div></div><div class='row'><div class='col-12' style='font-size:110%;'>".$row['price']."</div></div><br/><div class='row'><div class='col-12' style='font-size:130%;font-weight:bold;'><ul><li>Image1 :</div></div><div class='row'><div class='col-12'><img src='../product_image/".$row['img1']."' width='50%' class='rounded'/></div></div><br/><div class='row'><div class='col-12' style='font-size:130%;font-weight:bold;'><ul><li>Image2 :</li></ul></div></div><div class='row'><div class='col-12'>$img2</div></div><br/><div class='row'><div class='col-12' style='font-size:130%;font-weight:bold;'><ul><li>Image3 :</li></ul></div></div><div class='row'><div class='col-12'>$img3</div></div><br/><div class='row'><div class='col-12' style='font-size:130%;font-weight:bold;'><ul><li>Image4 :</li></ul></div></div><div class='row'><div class='col-12'>$img4</div></div>";
        }
        echo json_encode($response);
    }

        //change user profile image
        if($_GET['what'] == "changeUserProfile")
        {
            $query=mysqli_query($con,"select * from user_master where id=".$_SESSION['front_user_id']."");
            $row=mysqli_fetch_array($query);
            if($row['profile_img']!=null && $row['profile_img']!="" && file_exists("user_profile/".$row['profile_img']))
            {
                unlink('user_profile/'.$row['profile_img']);
            }

            move_uploaded_file($_FILES['file']['tmp_name'], "user_profile/".$_FILES['file']['name']);
            // $query=mysqli_query($con,"update user_master set profile_img='".$_FILES['file']['name']."' where id=".$_SESSION['front_user_id']."");
            if($query = mysqli_query($con,"update user_master set profile_img='".$_FILES['file']['name']."' where id=".$_SESSION['front_user_id'].""))
            {
                $response['success']=true;
            }
            else
            {
                $response['success']=false;
                $response['message']="Some error occured.\n Please try again";
            }
            echo json_encode($response);
        }
    //    update detail
    if($_GET['what']=="updateDetail")
    {
        $name=$_POST['txtName'];
        $phone=$_POST['txtPhone'];
        $add=$_POST['txtAdd'];
        $gen=$_POST['rdGender'];
        $pin=$_POST['pincode'];
        $state=$_POST['txtState'];
        $city=$_POST['txtCity'];
        $pass=password_hash($_POST['txtPwd'],PASSWORD_DEFAULT);
        $query=mysqli_query($con,"update user_master set owner_name='".$name."',password='".$pass."',pincode=".$pin.",state='".$state."',city='".$city."',address='".$add."',phone=".$phone.",gender='".$gen."' where id=".$_SESSION['front_user_id']."");
        if($query>0)
        {
            $response['success']=true;
            $response['message']="Profile Updated successfully";
        }
        else
        {
            $response['success']=false;
            $response['message']="Some error occured \n Please try again.";
        }
        echo json_encode($response);
    }
    // Order view more
    if($_GET['what']=="ViewMore")
    {
        $id=$_POST['id'];
        $query=mysqli_query($con,"SELECT `sold_master`.`id`,`sold_master`.`quantity`,`sold_master`.`total_amount`,`sold_master`.`selling_date`,`listing_products`.`product_name`,`listing_products`.`img1`,`listing_products`.`price`,
        `order_tracking`.`status`,`order_tracking`.`location` FROM `sold_master`
        JOIN `listing_products` ON  `sold_master`.`product_id`=`listing_products`.`id`
        JOIN `order_tracking` ON `sold_master`.`id`=`order_tracking`.`sell_master_id` WHERE `sold_master`.`buyer_user_id`= ".$_SESSION['front_user_id']." AND `sold_master`.`id`=".$id."");
        $result=mysqli_fetch_array($query);
    
        $query_request=mysqli_query($con,"select count(*),created_at,updated_at,status from return_order where sell_master_id=".$id."");
        $row_request=mysqli_fetch_array($query_request);
        $response[0]="";
        if($row_request[0]>0)
        {
                
            $response[0] .= "<div class='row'><ul><div class='col-12' style='font-size:130%;font-weight:bold;'><li>Order Id:</li></div></ul></div><div class='row'><div class='col-12' style='font-size:110%;'>" . $result['id'] . "</div></div><br/><div class='row'><ul><div class='col-12' style='font-size:130%;font-weight:bold;'><li>Order date:</li></div></ul></div><div class='row'><div class='col-12' style='font-size:110%;'>" . $result['selling_date'] . "</div></div><br/><div class='row'><ul><div class='col-12' style='font-size:130%;font-weight:bold;'><li>Return Order Updated date:</li></div></ul></div><div class='row'><div class='col-12' style='font-size:110%;'>" ;
            if($row_request['updated_at']==null || $row_request['updated_at']=='' )
            {
                $create_date=date('Y-m-d',strtotime($row_request['created_at']));
                $response[0].=$create_date;
            }
            else
            {
                $updated_date=date('Y-m-d',strtotime($row_request['updated_at']));
                $response[0].=$updated_date;
            }      
            $response[0].= "</div></div><br/><div class='row'><ul><div class='col-12' style='font-size:130%;font-weight:bold;'><li>Return Order Status:</li></div></ul></div><div class='row'><div class='col-12' style='font-size:110%;'>".$row_request['status']."</div></div><br/><div class='row'><div class='col-12' style='font-size:130%;font-weight:bold;'><ul><li>Product Name :</li></ul></div></div><div class='row'><div class='col-12' style='font-size:110%;'>" . $result['product_name'] . "</div></div><br/><div class='row'><div class='col-12' style='font-size:130%;font-weight:bold;'><ul><li>Price :</div></div><div class='row'><div class='col-12' style='font-size:110%;'>".$result['price']."</div></div><br/><div class='row'><div class='col-12' style='font-size:130%;font-weight:bold;'><ul><li>Quantity:</li></ul></div></div><div class='row'><div class='col-12' style='font-size:110%;'>" . $result['quantity'] . "</div></div><br/><div class='row'><div class='col-12' style='font-size:130%;font-weight:bold;'><ul><li>Total Amount :</li></ul></div></div><div class='row'><div class='col-12' style='font-size:110%;'>" . $result['total_amount'] . "</div></div><br/><div class='row'><div class='col-12' style='font-size:130%;font-weight:bold;'><ul><li>Image1 :</div></div><div class='row'><div class='col-12'><img src='../product_image/".$result['img1']."' width='50%' class='rounded'/></div></div><br/>";
        }
        else
        {
            $response[0] .= "<div class='row'><ul><div class='col-12' style='font-size:130%;font-weight:bold;'><li>Order Id:</li></div></ul></div><div class='row'><div class='col-12' style='font-size:110%;'>" . $result['id'] . "</div></div><br/><div class='row'><ul><div class='col-12' style='font-size:130%;font-weight:bold;'><li>Order date:</li></div></ul></div><div class='row'><div class='col-12' style='font-size:110%;'>" . $result['selling_date'] . "</div></div><br/><div class='row'><ul><div class='col-12' style='font-size:130%;font-weight:bold;'><li>Order Status:</li></div></ul></div><div class='row'><div class='col-12' style='font-size:110%;'>".$result['status']."</div></div><br/><div class='row'><ul><div class='col-12' style='font-size:130%;font-weight:bold;'><li>Order Location:</li></div></ul></div><div class='row'><div class='col-12' style='font-size:110%;'>" . $result['location'] . "</div></div><br/><div class='row'><div class='col-12' style='font-size:130%;font-weight:bold;'><ul><li>Product Name :</li></ul></div></div><div class='row'><div class='col-12' style='font-size:110%;'>" . $result['product_name'] . "</div></div><br/><div class='row'><div class='col-12' style='font-size:130%;font-weight:bold;'><ul><li>Price :</div></div><div class='row'><div class='col-12' style='font-size:110%;'>".$result['price']."</div></div><br/><div class='row'><div class='col-12' style='font-size:130%;font-weight:bold;'><ul><li>Quantity:</li></ul></div></div><div class='row'><div class='col-12' style='font-size:110%;'>" . $result['quantity'] . "</div></div><br/><div class='row'><div class='col-12' style='font-size:130%;font-weight:bold;'><ul><li>Total Amount :</li></ul></div></div><div class='row'><div class='col-12' style='font-size:110%;'>" . $result['total_amount'] . "</div></div><br/><div class='row'><div class='col-12' style='font-size:130%;font-weight:bold;'><ul><li>Image1 :</div></div><div class='row'><div class='col-12'><img src='../product_image/".$result['img1']."' width='50%' class='rounded'/></div></div><br/>";

        }    

        echo json_encode($response);
    }
    // return Order
    if($_GET['what']=="returnRequest")
    {
        // $id = $_POST['id'];
        // $message = $_POST['mes'];
        $id=$_POST['id'];
        $message=$_POST['mes'];
        // $image=$_POST['img'];
        move_uploaded_file($_FILES['file']['tmp_name'], "return_images/".$_FILES['file']['name']);
        $query=mysqli_query($con,"insert into return_order (sell_master_id,order_problem,return_img,status) values (".$id.",'".$message."','". $_FILES['file']['name']."','Request')");
        
        if($query>0)
        {
            $response['success']=true;
            $response['message']="Your Return order request successfully"; 
        }
        else
        {
            $response['success']=false;
            $response['message']="Some error occured \n Please try again.";
        }
        echo json_encode($response);

    }
    // cancle return order request
    if($_GET['what']=="cancleReq")
    {
        $id=$_POST['id'];
        $query=mysqli_query($con,"delete from return_order where sell_master_id=".$id."");
        if($query>0)
        {
            $response['success']=true;
        }
        else
        {
            $response['success']=false;
        }
        echo json_encode($response);
    }

    if($_GET['what'] == "sendComplaintForUser_Product")
    {
        $query = mysqli_query($con, "SELECT `user_master`.`id` FROM `user_master` JOIN `listing_products` ON `listing_products`.`user_id` = `user_master`.`id` WHERE `listing_products`.`id` = ". $_POST['pid'] ."");
        $result = mysqli_fetch_array($query);

        $queryStr = "";
        if($_POST['select_complaint'] == "business")
        {
            $queryStr = "insert into complaint_user(complainer_user_id, complainee_user_id, message) values(". $_SESSION['front_user_id'] .", ". $result[0] .", '". $_POST['complaint'] ."')";
        }
        else
        {
            $queryStr = "insert into complaint_product(complainer_user_id, product_id, message) values(". $_SESSION['front_user_id'] .", ". $_POST['pid'] .", '". $_POST['complaint'] ."')";
        }

        $query = mysqli_query($con, $queryStr);

        if($query > 0)
        {
            $response['success'] = true;
            $response['message'] = "Your Complaint Have been registered with us. We will look after it thouroughly.";
        }
        else
        {
            $response['success'] = false;
            $response['message'] = "Some error occurred.\nPlease try again.";
        }

        echo json_encode($response);
    }

    if($_GET['what'] == "setToSession")
    {
        $query = mysqli_query($con, "SELECT `id`, `user_id` FROM `listing_products` WHERE `id` = ". $_POST['pid'] ."");
        $result = mysqli_fetch_array($query);

        $_SESSION['receiver_user_id'] = $result['user_id'];
        $_SESSION['product_chat_id'] = $result['id'];

        // $chckQuery = mysqli_query($con, "SELECT COUNT(*) FROM `chat_master` WHERE `product_id` = ". $_POST['pid'] ." AND `sender_user_id` IN (". $result['user_id'] .", ". $_SESSION['front_user_id'] .") AND receiver_user_id IN (". $result['user_id'] .", ". $_SESSION['front_user_id'] .")");
        // $chckResult = mysqli_fetch_array($chckQuery);

        $flag1 = false;
        $flag2 = false;
        $chckQuery = mysqli_query($con, "SELECT COUNT(*) FROM `chat_first` WHERE `product_id` = ". $_POST['pid'] ." AND `user_first` = ". $_SESSION['front_user_id'] ." AND `user_second` = ". $_SESSION['receiver_user_id'] ."");
        $chckResult = mysqli_fetch_array($chckQuery);

        if($chckResult[0] == 0)
        {
            $chckQuery = mysqli_query($con, "SELECT COUNT(*) FROM `chat_first` WHERE `product_id` = ". $_POST['pid'] ." AND `user_second` = ". $_SESSION['front_user_id'] ." AND `user_first` = ". $_SESSION['receiver_user_id'] ."");
            $chckResult2 = mysqli_fetch_array($chckQuery);

            if($chckResult2[0] != 0)
            {
                $flag2 = true;
            }
        }
        else
        {
            $flag1 = true;
        }

        if($flag1 == false && $flag2 == false)
        {
            //insert query

            $query = mysqli_query($con, "INSERT INTO `chat_first`(`user_first`, `user_second`, `product_id`) VALUES(". $_SESSION['front_user_id'] .", ". $_SESSION['receiver_user_id'] .", ". $_SESSION['product_chat_id'] .")");

            $query = mysqli_query($con, "INSERT INTO `chat_master`(`product_id`, `sender_user_id`, `receiver_user_id`, `message`) VALUES(". $_POST['pid'] .", ". $_SESSION['front_user_id'] .", ". $result['user_id'] .", '". base64_encode('Hello. I am interested in buying your product. Can we talk and discuss some details about the product ?') ."')");
        }

        // if($chckResult[0] == 0)
        // {
        //     $query = mysqli_query($con, "INSERT INTO `chat_master`(`product_id`, `sender_user_id`, `receiver_user_id`, `message`) VALUES(". $_POST['pid'] .", ". $_SESSION['front_user_id'] .", ". $result['user_id'] .", 'Hello. I am interested in buying your product. Can we talk and discuss some details about the product ?')");
        // }

        $query = mysqli_query($con, "SELECT `owner_name` FROM `user_master` WHERE `id` = ". $_SESSION['receiver_user_id'] ."");
        $result = mysqli_fetch_array($query);

        $_SESSION['receiver_name'] = $result['owner_name'];

        $query = mysqli_query($con, "SELECT `product_name` FROM `listing_products` WHERE `id` = ". $_SESSION['product_chat_id'] ."");
        $result = mysqli_fetch_array($query);

        $_SESSION['product_name'] = $result['product_name'];

        $response['url'] = "chatMaster.php";

        echo json_encode($response);
    }

    if($_GET['what'] == "changeUserChat")
    {
        $_SESSION['receiver_user_id'] = $_POST['uid'];
        $_SESSION['product_chat_id'] = $_POST['pid'];

        $query = mysqli_query($con, "SELECT `owner_name` FROM `user_master` WHERE `id` = ". $_SESSION['receiver_user_id'] ."");
        $result = mysqli_fetch_array($query);

        $_SESSION['receiver_name'] = $result['owner_name'];

        $query = mysqli_query($con, "SELECT `product_name` FROM `listing_products` WHERE `id` = ". $_SESSION['product_chat_id'] ."");
        $result = mysqli_fetch_array($query);

        $_SESSION['product_name'] = $result['product_name'];

        $response['product_name'] = $_SESSION['product_name'];
        $response['receiver_name'] = $_SESSION['receiver_name'];

        $response['new_chat'] = "";

        $query = mysqli_query($con, "SELECT * FROM `chat_master` WHERE `product_id` = ". $_SESSION['product_chat_id'] ." AND `sender_user_id` IN(". $_SESSION['front_user_id'] .", ". $_SESSION['receiver_user_id'] .") AND `receiver_user_id` IN(". $_SESSION['front_user_id'] .", ". $_SESSION['receiver_user_id'] .")");
        while($row = mysqli_fetch_array($query))
        {
            if($row['receiver_user_id'] == $_SESSION['front_user_id'])
            {
                $response['new_chat'] .= '<div class="msg msg-recipient">
                    <div class="m-r-10">
                        <div class="avatar avatar-image">
                            <img src="../image/logo.png" alt="">
                        </div>
                    </div>
                    <div class="bubble">
                        <div class="bubble-wrapper" style="background-color:lightseagreen;color:white;border:1px solid lightgrey;">
                            <span>'. base64_decode($row['message']) .'</span>
                            <br>
                        </div>
                        <div class="text-left">
                            <span style="color:black;font-size:x-small;">'. $row["created_at"] .'</span>
                        </div>
                    </div>
                </div>';
            }
            else
            {
                $response['new_chat'] .= '<div class="msg msg-sent">
                    <div class="bubble">
                        <div class="bubble-wrapper" style="background-color:white;color:black;border:1px solid lightgrey;">
                            <span>'. base64_decode($row["message"]) .'</span><br/>
                        </div>
                        <div class="text-right">
                            <span style="color:black;font-size:x-small;">'. $row["created_at"] .'</span>
                        </div>
                    </div>
                </div>';
            }

            $_SESSION['last_id'] = $row['id'];
        }


        echo json_encode($response);
    }

    if($_GET['what'] == "sendMessageFromChat")
    {
        $query = mysqli_query($con, "insert into chat_master(product_id, sender_user_id, receiver_user_id, message) values(". $_SESSION['product_chat_id'] .", ". $_SESSION['front_user_id'] .", ". $_SESSION['receiver_user_id'] .", '". base64_encode($_POST['message']) ."')");

        if($query > 0)
        {
            $id = $con->insert_id;
            $_SESSION['last_id'] = $id;

            $response['success'] = true;
        }
        else
        {
            $response['success'] = false;
        }

        echo json_encode($response);
    }

    if($_GET['what'] == "getNewChatsForUser")
    {
        $query = mysqli_query($con, "SELECT COUNT(*) FROM `chat_master` WHERE `product_id` = ". $_SESSION['product_chat_id'] ." AND `sender_user_id` IN(". $_SESSION['front_user_id'] .", ". $_SESSION['receiver_user_id'] .") AND `receiver_user_id` IN(". $_SESSION['front_user_id'] .", ". $_SESSION['receiver_user_id'] .") AND `id` > ". $_SESSION['last_id'] ."");
        $result = mysqli_fetch_array($query);
        
        if($result[0] == 0)
        {
            $response['success'] = false;
        }
        else
        {
            $response['new_chat'] = "";
            $query = mysqli_query($con, "SELECT * FROM `chat_master` WHERE `product_id` = ". $_SESSION['product_chat_id'] ." AND `sender_user_id` IN(". $_SESSION['front_user_id'] .", ". $_SESSION['receiver_user_id'] .") AND `receiver_user_id` IN(". $_SESSION['front_user_id'] .", ". $_SESSION['receiver_user_id'] .") AND `id` > ". $_SESSION['last_id'] ."");

            while($row = mysqli_fetch_array($query))
            {
                if($row['receiver_user_id'] == $_SESSION['front_user_id'])
                {
                    $response['new_chat'] .= '<div class="msg msg-recipient">
                        <div class="m-r-10">
                            <div class="avatar avatar-image">
                                <img src="../image/logo.png" alt="">
                            </div>
                        </div>
                        <div class="bubble">
                            <div class="bubble-wrapper style_recivemsg"  style="background-color:lightseagreen;color:white;border:1px solid lightgrey;">
                                <span>'. base64_decode($row['message']) .'</span>
                                <br>
                            </div>
                            <div class="text-left">
                                <span style="color:black;font-size:x-small;">'. $row["created_at"] .'</span>
                            </div>
                        </div>
                    </div>';
                }
                else
                {
                    $response['new_chat'] .= '<div class="msg msg-sent">
                        <div class="bubble">
                            <div class="bubble-wrapper" style="background-color:white;color:black;border:1px solid lightgrey;">
                                <span>'. base64_decode($row["message"]) .'</span><br/>
                            </div>
                            <div class="text-right">
                                <span style="color:black;font-size:x-small;">'. $row["created_at"] .'</span>
                            </div>
                        </div>
                    </div>';
                }

                $_SESSION['last_id'] = $row['id'];
            }

            $response['success'] = true;
        }

        echo json_encode($response);
    }
    if($_GET['what']=="contact")
    {
        $query=mysqli_query($con,"insert into feedback (user_email,name,phone_no,message) values ('".$_POST['txtMail']."' , '".$_POST['txtName']."' , ".$_POST['txtNum']." , '".$_POST['txtMsg']."')");
        if($query>0)
        {
            $response['success']=true;
            $response['message']="Send your feedback successfuly";
        }
        else
        {
            $response['success']=false;
            $response['message']="Some error occurred.\nPlease try again.";
        }
        echo json_encode($response);
    }
     //change bussiness profile image
     if($_GET['what'] == "changeBusProfile")
     {
         $query=mysqli_query($con,"select * from user_master where id=".$_SESSION['user_id']."");
         $row=mysqli_fetch_array($query);
         if($row['profile_img']!=null && $row['profile_img']!="" && file_exists("user_profile/".$row['profile_img']))
         {
             unlink('user_profile/'.$row['profile_img']);
         }

         move_uploaded_file($_FILES['file']['tmp_name'], "user_profile/".$_FILES['file']['name']);
         // $query=mysqli_query($con,"update user_master set profile_img='".$_FILES['file']['name']."' where id=".$_SESSION['front_user_id']."");
         if($query = mysqli_query($con,"update user_master set profile_img='".$_FILES['file']['name']."' where id=".$_SESSION['user_id'].""))
         {
             $response['success']=true;
         }
         else
         {
             $response['success']=false;
             $response['message']="Some error occured.\n Please try again";
         }
         echo json_encode($response);
     }
    //    update bussiness detail
    if($_GET['what']=="busUpdateDetail")
    {
        $name=$_POST['txtName'];
        $phone=$_POST['txtPhone'];
        $add=$_POST['txtAdd'];
        $gen=$_POST['rdGender'];
        $pin=$_POST['pincode'];
        $state=$_POST['txtState'];
        $city=$_POST['txtCity'];
        $busname=$_POST['txtBus'];
        $gst=$_POST['txtGst'];
        $pass=password_hash($_POST['txtPwd'],PASSWORD_DEFAULT);

        $query=mysqli_query($con,"update user_master set bussiness_name='".$busname."',owner_name='".$name."',password='".$pass."',pincode=".$pin.",state='".$state."',city='".$city."',address='".$add."',phone=".$phone.",gender='".$gen."',gst_no='".$gst."' where id=".$_SESSION['user_id']."");
        if($query>0)
        {
            $response['success']=true;
            $response['message']="Profile Updated successfully";
        }
        else
        {
            $response['success']=false;
            $response['message']="Some error occured \n Please try again.";
        }
        echo json_encode($response);
    }

    if($_GET['what'] == "markAsSeenProduct")
    {
        $query = mysqli_query($con, "SELECT `listing_products`.`id` FROM `complaint_product` JOIN `listing_products` ON `listing_products`.`id` = `complaint_product`.`product_id` JOIN `user_master` ON `user_master`.`id` = `listing_products`.`user_id` WHERE `user_master`.`id` = ". $_SESSION['user_id'] .";");
        $ids = "";

        while($row = mysqli_fetch_array($query))
        {
            $ids .= $row[0] . ",";
        }

        $ids = substr($ids, 0, -1);

        $query = mysqli_query($con, "update complaint_product set status = 'Seen' WHERE product_id in ($ids)");
    }

    if($_GET['what'] == "markAsSeenUser")
    {
        $query = mysqli_query($con, "update complaint_user set status = 'Seen' where complainee_user_id = ". $_SESSION['user_id'] ."");
    }

    if($_GET['what'] == "getMarketerPieChart")
    {
        $query = mysqli_query($con, "SELECT `marketer`.`marketer_name`, SUM(`quantity`) FROM `sold_master` JOIN `listing_products` ON `listing_products`.`id` = `sold_master`.`product_id` JOIN `user_master` ON `user_master`.`id` = `listing_products`.`user_id` JOIN `marketer` ON `marketer`.`id` = `sold_master`.`marketer_id` WHERE `user_master`.`id` = ". $_SESSION['user_id'] ." AND `sold_master`.`marketer_id` IS NOT NULL AND `sold_master`.`id` NOT IN(SELECT `return_order`.`sell_master_id` FROM `return_order`) GROUP BY `sold_master`.`marketer_id`;");

        $response['xvalues'] = "";
        $response['yvalues'] = "";
        $response['colors'] = "";
        while($row = mysqli_fetch_array($query))
        {
            $response['xvalues'] .= $row[0] . ",";
            $response['yvalues'] .= $row[1] . ",";
            $response['colors'] .= "#" . str_pad(dechex(rand(0x000000, 0xFFFFFF)), 6, 0, STR_PAD_LEFT) . ",";
        }

        echo json_encode($response);
    }

    if($_GET['what'] == "getMarketerPieChartForIndividual")
    {
        $query = mysqli_query($con, "SELECT `listing_products`.`product_name`, SUM(`sold_master`.`quantity`) FROM `sold_master` JOIN `listing_products` ON `listing_products`.`id` = `sold_master`.`product_id` WHERE `sold_master`.`marketer_id` = ". $_POST['mid'] ." AND `sold_master`.`id` NOT IN(SELECT `return_order`.`sell_master_id` FROM `return_order`) GROUP BY `listing_products`.`id`;");

        $response['xvalues'] = "";
        $response['yvalues'] = "";
        $response['colors'] = "";
        while($row = mysqli_fetch_array($query))
        {
            $response['xvalues'] .= $row[0] . ",";
            $response['yvalues'] .= $row[1] . ",";
            $response['colors'] .= "#" . str_pad(dechex(rand(0x000000, 0xFFFFFF)), 6, 0, STR_PAD_LEFT) . ",";
        }

        echo json_encode($response);
    }

    if($_GET['what'] == "currentYearMonthWiseBifurReve")
    {
        $query = mysqli_query($con, "SELECT MONTHNAME(`sold_master`.`selling_date`), SUM(`sold_master`.`total_amount`) FROM `sold_master` JOIN `listing_products` ON `listing_products`.`id` = `sold_master`.`product_id` JOIN `user_master` ON `user_master`.`id` = `listing_products`.`user_id` WHERE `listing_products`.`user_id` = ". $_SESSION['user_id'] ." AND YEAR(`sold_master`.`selling_date`) = YEAR(NOW()) GROUP BY MONTHNAME(`sold_master`.`selling_date`);");

        $response['xvalues'] = "";
        $response['yvalues'] = "";
        $response['colors'] = "";
        while($row = mysqli_fetch_array($query))
        {
            $response['xvalues'] .= $row[0] . ",";
            $response['yvalues'] .= $row[1] . ",";
            $response['colors'] .= "#" . str_pad(dechex(rand(0x000000, 0xFFFFFF)), 6, 0, STR_PAD_LEFT) . ",";
        }

        echo json_encode($response);
    }

    if($_GET['what'] == "currentYearYearWiseBifurReve")
    {
        $query = mysqli_query($con, "SELECT YEAR(`sold_master`.`selling_date`), SUM(`sold_master`.`total_amount`) FROM `sold_master` JOIN `listing_products` ON `listing_products`.`id` = `sold_master`.`product_id` JOIN `user_master` ON `user_master`.`id` = `listing_products`.`user_id` WHERE `listing_products`.`user_id` = ". $_SESSION['user_id'] ." GROUP BY YEAR(`sold_master`.`selling_date`);");

        $response['xvalues'] = "";
        $response['yvalues'] = "";
        $response['colors'] = "";
        while($row = mysqli_fetch_array($query))
        {
            $response['xvalues'] .= $row[0] . ",";
            $response['yvalues'] .= $row[1] . ",";
            $response['colors'] .= "#" . str_pad(dechex(rand(0x000000, 0xFFFFFF)), 6, 0, STR_PAD_LEFT) . ",";
        }

        echo json_encode($response);
    }

    if($_GET['what'] == "getBusinessDetailsForPlanRenew")
    {
        $query = mysqli_query($con, "select * from user_master where id = ". $_SESSION['user_id'] ."");
        $result = mysqli_fetch_array($query);

        echo json_encode($result);
    }

    if($_GET['what'] == "renewExistingBusinessPlan")
    {
        // echo json_encode($_POST);
        $expiry_date = date("Y-m-d", strtotime(date("Y-m-d"). ' + '. $_POST['days'] .' days'));

        $query = mysqli_query($con, "insert into subscription_selling(subscription_id, user_id, payment_mode, expiary_date) values(". $_POST['pid'] .", ". $_POST['userId'] .", 'Razorpay', '". $expiry_date ."')");

        if($query > 0)
        {
            $id = $con->insert_id;
            $query = mysqli_query($con, "update user_master set subscrib_id = ". $_POST['pid'] .", expiary_date = '". $expiry_date ."' where id = ". $_POST['userId'] ."");

            if($query > 0)
            {
                $response['success'] = true;
                $response['message'] = "Payment Received by us. Please re login to access all the features.";
            }
            else
            {
                $query = mysqli_query($con, "delete from subscription_selling where id = ". $id ."");

                $response['success'] = false;
                $response['message'] = "Some error occurred. You will get your payment return in 2-3 working days if it was deducted from your account.";
            }
        }
        else
        {
            $response['success'] = false;
            $response['message'] = "Some error occurred. You will get your payment return in 2-3 working days if it was deducted from your account.";
        }

        session_destroy();
        echo json_encode($response);
    }
    // Marketer update profile
    if($_GET['what']=="markUpdateDetail")
    {
        $name=$_POST['txtName'];
        $pass=password_hash($_POST['txtPwd'],PASSWORD_DEFAULT);

        $query=mysqli_query($con,"update marketer set marketer_name='".$name."',password='".$pass."' where id=".$_SESSION['mark_id']."");
        if($query>0)
        {
            $response['success']=true;
            $response['message']="Profile Updated successfully";
        }
        else
        {
            $response['success']=false;
            $response['message']="Some error occured \n Please try again.";
        }
        echo json_encode($response);
    }
    if($_GET['what'] == "getMarketerAssignedProductId")
    {
        $query = mysqli_query($con, "select product_id from assign_marketer where marketer_id = ". $_POST['mrkId'] ."");

        $response = [];

        while($result = mysqli_fetch_array($query))
        {
            array_push($response, $result['product_id']);
        }

        echo json_encode($response);
    }

    //Marketer OTP Sending code
    if($_GET['what'] == "markOtp")
    {
        $query = mysqli_query($con, "select count(*) from marketer where email = '" . $_POST['email'] . "' and status = 'Active'");
        $result = mysqli_fetch_array($query);

        if($result[0] != 0)
        {
            $otp = rand(100000, 999999);
            mail($_POST['email'], "OTP for password reset", "Dear User " . $_POST['email'] . ",\n\nYour OTP for reseting your password is $otp", "From:GhostMarketer");
            $response['success'] = true;
            $response['message'] = "OTP Send Successfully";
            $response['otp'] = $otp;
        }
        else
        {
            $response['success'] = false;
            $response['message'] = "Email ID not found. \nPlease try again";
        }

        echo json_encode($response);
    }

    if($_GET['what'] == "resetPassMark")
    {
        $query = mysqli_query($con, "update marketer set password = '". password_hash($_POST['newpas'], PASSWORD_DEFAULT) ."' where email = '". $_POST['email'] ."'");

        if($query > 0)
        {
            $response['success'] = true;
            $response['message'] = "Password updated successfully";
        }
        else
        {
            $response['success'] = false;
            $response['message'] = "Some Error Occurred. \nPlease try again.";
        }
        echo json_encode($response);
    }
?>