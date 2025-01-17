<?php
    session_start();
    include("connection.php");

    if(isset($_SESSION['front_user_id']))
    {
        header("Location:user/index.php");
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Ghost Marketer</title>

    <!-- Favicon -->
    <link rel="shortcut icon" href="image/logo.png"/>

    <!-- page css -->

    <!-- Core css -->
    <link href="assets/css/app.min.css" rel="stylesheet">

    <script type="text/javascript" src="https://checkout.razorpay.com/v1/razorpay.js"></script>
    <style>
         .hdr
        {
            font-size:200%;
            font-weight: bold;
            
        }
        .hdr-image
        {
            
            margin-left: 70%;
        }
        .tbl{
            width:80%;
        }
        .inpt_fog
        {
            border: none;
            border-bottom: 2px solid #0DB8DE;
            border-top: hidden;
            border-right: hidden;
            border-left: hidden;
            border-radius: 0px;
            padding-left: 0px;
            /* margin-bottom: 20px;  */
            font-size: 14px;
            
         }
         /* .inpt_fog:focus {
            border-color: inherit;
            -webkit-box-shadow: none;
            box-shadow: none;
            border-bottom:2px solid #0DB8DE;
            /* border-top:1px solid #0DB8DE;
            border-right:1px solid #0DB8DE;
            border-left:1px solid #0DB8DE; */
            /* outline: 0;
            background-color:aliceblue;
            color:black;

        } */ 
          @media (max-width:768px)
        {
                
              .hdr-image
              {
                 display:none;
              }  
              .hdr-top-image
              {
                  display: block;
              }  
              .inpt-mobile
              {
                    width:100%;
              }
              .card
              {
                 width:100%;
                 background-color:honeydew;
                box-shadow:0 15px 25px rgba(143,124,236,0.7);
                box-shadow:0 15px 25px rgba(143,124,236,0.7);
                margin-bottom: 10%;
              }
             
        }
        @media(min-width:769px)
        {
            .hdr-top-image
              {
                  display: none;
              }
              .card
              {
                    width:80%;
                    background-color:honeydew;
                    box-shadow:0 15px 25px rgba(143,124,236,0.7);
                    margin-bottom: 3%;
               }  
        }
        .input-icon i{
            position:absolute;
        }
        .icon{
            padding:3%;
             padding-left: 2%;
             font-size: 150%;
             color:dimgrey;
        }
        .card-body
        {
           width:70%;
           padding:10%; 
        }
        
        .input-feild{
            text-align: center;
            border-bottom: 1px solid black;
            border-radius: 0;
            width: 150%;
            border-width:0;
             border-bottom-width:thin
        }
        .lbl
        {
            font-size: 120%;
        }
        .pwd{
            text-align: right;
            

        }
         .icon-eye
        {
            text-align:right;
            padding:3.7%;
             padding-left: 27%;
             font-size: 100%;
             color:dimgrey;
             border-bottom: 1px solid black;
            border-radius: 0;
            border-width:0;
             border-bottom-width:thin;
             background-color:white;
        }
                
                  
               
              
        .btn-grad {
            background-image: linear-gradient(to right, #16BFFD 0%, #CB3066  51%, #16BFFD  100%);
            margin: 10px;
            padding: 15px 45px;
            text-align: center;
            text-transform: uppercase;
            transition: 0.5s;
            background-size: 200% auto;
            color: white;            
            box-shadow: 0 0 20px #eee;
            border-radius: 10px;
            display: block;
            /* width:65%; */
          }

          .btn-grad:hover {
            background-position: right center; /*change the direction of the change here*/
            color: #fff;
            text-decoration: none;
          }
        .close_btn
        {
            font-size:xx-large;
            border:0px;
        }
        .btn_styledange:hover{
            color:red;
            border:0px;
            font-weight:500;
            background-color: rgba(160,0,0,0.2); 
        }
        .btn_close:hover{
            background-color: rgba(197, 239, 247,1);
            color:rgba(68, 108, 240,1);
            font-weight:500;
            border:0px;

       }
    </style>

</head>

<body>
<div class="app">
        <div class="container-fluid">
            <div class="d-flex full-height p-v-20 flex-column justify-content-between">
                <div class="d-none d-md-flex p-h-40">
                    <div class="modal fade" tabindex="-1" status="dialog" id="frg_pas">
                        <div class="modal-dialog modal-md">
                            <div class="modal-content justify-content-center">
                            <div class="modal-title">
                                    <div class="modal-header">
                                        <h3 class="modal-title mt-2">Forget Password</h3>
                                        <button class="btn close_btn" data-toggle="modal" data-target="#frg_pas">&times;</button>
                                    </div>
                            </div>
                                <div class="modal-body">
                                    <div class="form" id="sendmailforfrg" name="sendmailforfrg">
                                        <div class="form-group chckuname">
                                            <label class="form-label">Enter your Email:
                                            </label>
                                            <input type="text" name="frg_uname" id="frg_uname" class="form-control inpt_fog" />
                                        </div>

                                        <div class="form-group otp">
                                            <label class="form-label">Enter OTP :
                                            </label>
                                            <input type="number" name="otp" id="otp" class="form-control  inpt_fog" />
                                        </div>

                                        <div class="form-group newpas">
                                            <label class="form-label">Enter New Password :
                                            </label>
                                            <input type="password" name="newpas" id="newpas" class="form-control  inpt_fog" />
                                        </div>

                                        <div class="form-group newpas">
                                            <label class="form-label">Confirm Password :
                                            </label>
                                            <input type="text" name="conpas" id="conpas" class="form-control  inpt_fog" />
                                        </div>
                                        <div class="modal-footer">
                                            <button id="sendotp" name="sendotp" class="btn btn-primary   btn_close">Send OTP</button>
                                            <button id="verifyotp" name="verifyotp" class="btn btn-primary btn_close">Verify OTP</button>
                                            <button id="setnewpas" name="setnewpas" class="btn btn-primary btn_close">Reset Password</button>
                                            <button class="btn btn-danger btn_styledange" data-toggle="modal" data-target="#frg_pas">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="container">
                </div>
                    <div class="m-l-auto col-md-5">
                        <div class="card" style="border-width:0">
                            <div class="card-body"> 
                                    <table>
                                        <tr>
                                            <td class="tbl">
                                                <img src="image/ghost2.png" class="hdr-top-image" width="150%" />  
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="hdr tbl">User LogIn</td>
                                            <td>
                                                <img src="image/ghost2.png" class="hdr-image" width="360%" />  
                                            </td>
                                        </tr>
                                    </table><br><br>
                                    <form method="post" id="frm">
                                        <div class="form-group">
                                            <label class="font-weight-semibold lbl" for="userName">E-mail:</label>
                                                <div class="input-icon">
                                                     <i class="fas fa-envelope icon"></i>
                                                    <input type="email" id="txtMail" name="txtMail" class="form-control input-feild"  placeholder="Email@gmail.com"  />
                                                </div>
                                            </div>
                                        <div class="form-group mt-5">
                                             <label class="font-weight-semibold lbl" for="password">Password:</label> 
                                                <div class="input-icon">
                                                    <i class="fas fa-key icon"></i>
                                                     <!-- <span class="input-group-append"> -->
                                                        <input type="password"  id="txtPwd" name="txtPwd" class="form-control input-feild" placeholder="Password"/>
                                                        <!-- <a id="btnEye"><i class="far fa-eye icon-eye input-group-text"></i></a> -->
                                                    </span>
                                                </div>  
                                                 <div class="mt-3"><a href="#" id="anchorforget" style="color:red" data-target="#frg_pas" data-toggle="modal">Forget Password ?</a></div>
                                        </div> 
                                            <div class="d-flex align-items-center justify-content-between p-t-8" style="width:150%;">
                                                <button type="button" id="txtSubmit" name="txtSubmit" class="btn btn-lg btn-block btn-grad" >Login In</button>
                                            </div>
                                            <div>
                                                <span>Don't have an account?<br/><a href="user_registration.php" style="border:0;border-bottom:1px solid blue;">Register now.<a></span>
                                            </div>
                                    </form>
                            </div>
                        </div>
                    </div> 
                </div>
            </div>
</div>
    <?php
        include("include.php");
    ?>
    <!-- User login js -->
        <script src="new_js/userlogin.js"></script>                                       
</body>

</html>