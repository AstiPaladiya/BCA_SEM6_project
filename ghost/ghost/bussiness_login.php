<?php
    session_start();
    include("connection.php");

    if(isset($_SESSION['user']) || isset($_SESSION['mark_id']))
    {
        header("Location:marketer/index.php");
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Ghost Marketer</title>

    <!-- Favicon -->
    <link rel="shortcut icon" href="image/logo.png" />

    <!-- page css -->

    <!-- Core css -->
    <link href="assets/css/app.min.css" rel="stylesheet">

    <script type="text/javascript" src="https://checkout.razorpay.com/v1/razorpay.js"></script>
    <style>
    .hdr {
        font-size: 200%;
        font-weight: bold;
    }

    .hdr-image {

        margin-left: 70%;
    }

    .tbl {
        width: 80%;
    }

    @media (max-width:768px) {

        .hdr-image {
            display: none;
        }

        .hdr-top-image {
            display: block;
        }

        .inpt-mobile {
            width: 100%;
        }

        .card {
            width: 100%;
            background-color: honeydew;
            box-shadow: 0 15px 25px rgba(143, 124, 236, 0.7);
            margin-bottom: 10%;
            height: 100%;
        }

    }

    @media(min-width:769px) {
        .hdr-top-image {
            display: none;
        }

        .card {
            width: 80%;
            background-color: honeydew;
            box-shadow: 0 15px 25px rgba(143, 124, 236, 0.7);
            margin-bottom: 3%;
            /* margin-top: 20%; */

        }
    }

    .input-icon i {
        position: absolute;
    }

    .icon {
        padding: 3%;
        padding-left: 2%;
        font-size: 150%;
        color: dimgrey;
    }

    .card-body {
        width: 70%;
        padding: 10%;
    }

    .input-feild {
        text-align: center;
        border-bottom: 1px solid black;
        border-radius: 0;
        width: 150%;
        border-width: 0;
        border-bottom-width: thin
    }

    .lbl {
        font-size: 120%;
    }

    .pwd {
        text-align: right;


    }

    .btn-grad {
        background-image: linear-gradient(to right, #16BFFD 0%, #CB3066 51%, #16BFFD 100%);
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
    }

    .btn-grad:hover {
        background-position: right center;
        /* change the direction of the change here */
        color: #fff;
        text-decoration: none;
    }

    .divider {
        height: 0;
        border-top: 1px double darkgray;
        /* text-align: center; */
        margin-top: 40px;
        margin-bottom: 40px;
        padding-left: 50%;
        padding-right: 0;
        width:330px;
    }

    .divider>span {
        color: #3498db;
        background: #FAFAFA;
        display: inline-block;
        position: relative;
        padding: 0 17px;
        top: -11px;
        font-size: 15px;
        margin-left:25px;
    }

    @media(max-width:499px)
    {
        .divider{
            width:230px;
        }

        .divider>span{
            margin-left:18px;
        }
    }
    </style>

</head>

<body>
    <div class="app">
        <div class="container-fluid">
            <div class="d-flex  p-v-20  justify-content-between">
                <div class="d-md-flex p-h-40">

                    <!-- Business Login Forget Password -->
                    <div class="modal fade" tabindex="-1" status="dialog" id="frg_pas">
                        <div class="modal-dialog modal-md">
                            <div class="modal-content justify-content-center">
                                <div class="modal-title">
                                    <div class="row">
                                        <div class="col-6">
                                            <h2 class="text-center">Forget Password</h2>
                                        </div>
                                        <div class="col-6 text-right"><button class="btn btn-default" data-toggle="modal"
                                                data-target="#frg_pas"><span style="font-size:large;">&times;</span></button></div>
                                    </div>
                                    <hr>
                                </div>
                                <div class="modal-body">
                                    <div class="form" id="sendmailforfrg" name="sendmailforfrg">
                                        <div class="form-group chckuname">
                                            <label class="form-label">Enter Email ID :
                                            </label>
                                            <input type="email" name="frg_uname" id="frg_uname" class="form-control" />
                                        </div>

                                        <div class="form-group otp">
                                            <label class="form-label">Enter OTP :
                                            </label>
                                            <input type="number" name="otp" id="otp" class="form-control" />
                                        </div>

                                        <div class="form-group newpas">
                                            <label class="form-label">Enter New Password :
                                            </label>
                                            <input type="password" name="newpas" id="newpas" class="form-control" />
                                        </div>

                                        <div class="form-group newpas">
                                            <label class="form-label">Confirm Password :
                                            </label>
                                            <input type="text" name="conpas" id="conpas" class="form-control" />
                                        </div>

                                        <div class="form-group text-right">
                                            <button id="sendotp" name="sendotp" class="btn btn-success">Send
                                                OTP</button>
                                            <button id="verifyotp" name="verifyotp" class="btn btn-success">Verify
                                                OTP</button>
                                            <button id="setnewpas" name="setnewpas" class="btn btn-success">Reset
                                                Password</button>
                                            <button class="btn btn-danger" data-toggle="modal"
                                                data-target="#frg_pas">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Marketer Forget Password -->
                    <div class="modal fade" tabindex="-1" status="dialog" id="agentFrgModel">
                        <div class="modal-dialog modal-md">
                            <div class="modal-content justify-content-center">
                                <div class="modal-title">
                                    <div class="row">
                                        <div class="col-6">
                                            <h2 class="text-center">Forget Password</h2>
                                        </div>
                                        <div class="col-6 text-right"><button class="btn btn-default" data-toggle="modal"
                                                data-target="#agentFrgModel"><span style="font-size:large;">&times;</span></button></div>
                                    </div>
                                    <hr>
                                </div>
                                <div class="modal-body">
                                    <div class="form" id="sendmailforfrg" name="sendmailforfrg">
                                        <div class="form-group chckuname">
                                            <label class="form-label">Enter Email ID :
                                            </label>
                                            <input type="email" name="mrk_email" id="mrk_email" class="form-control" />
                                        </div>

                                        <div class="form-group otp">
                                            <label class="form-label">Enter OTP :
                                            </label>
                                            <input type="number" name="mrk_otp" id="mrk_otp" class="form-control" />
                                        </div>

                                        <div class="form-group newpas">
                                            <label class="form-label">Enter New Password :
                                            </label>
                                            <input type="password" name="mrk_newpass" id="mrk_newpass" class="form-control" />
                                        </div>

                                        <div class="form-group newpas">
                                            <label class="form-label">Confirm Password :
                                            </label>
                                            <input type="text" name="mrk_conpass" id="mrk_conpass" class="form-control" />
                                        </div>

                                        <div class="form-group text-right">
                                            <button id="mrk_sned" class="btn btn-success">Send
                                                OTP</button>
                                            <button id="mrk_verify" class="btn btn-success">Verify
                                                OTP</button>
                                            <button id="mrk_setnew" class="btn btn-success">Reset
                                                Password</button>
                                            <button class="btn btn-danger" data-toggle="modal"
                                                data-target="#agentFrgModel">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- <div class="container">
                        </div> -->
                <div class="col-md-5">
                    <div class="card" style="border-width:0">
                        <div class="card-body">
                            <table>
                                <tr>
                                    <td class="tbl">
                                        <img src="image/ghost2.png" class="hdr-top-image" width="150%" />
                                    </td>
                                </tr>
                                <tr>
                                    <td class="hdr tbl">Business LogIn</td>
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
                                        <input type="email" id="txtMail" name="txtMail" class="form-control input-feild"
                                            placeholder="Email@gmail.com" />
                                    </div>
                                </div>
                                <div class="form-group mt-5">
                                    <label class="font-weight-semibold lbl" for="password">Password:</label>
                                    <div class="input-icon">
                                        <i class="fas fa-key icon"></i>
                                        <!-- <span class="input-group-append"> -->
                                        <input type="password" id="txtPwd" name="txtPwd"
                                            class="form-control input-feild" placeholder="Password" />
                                        <!-- <a id="btnEye"><i class="far fa-eye icon-eye input-group-text"></i></a> -->
                                        </span>
                                    </div>
                                    <div class="mt-3"><a href="#" id="anchorforget" style="color:red"
                                            data-target="#frg_pas" data-toggle="modal">Forget Password ?</a></div>
                                </div>
                                <div class="d-flex align-items-center justify-content-between p-t-8"
                                    style="width:150%;">
                                    <button type="submit" id="txtSubmit" name="txtSubmit"
                                        class="btn btn-lg btn-block btn-grad">Login In</button>
                                </div>
                                <div>
                                    <span>Don't have an account?<br /><a href="business_registration.php"
                                            style="border:0;border-bottom:1px solid blue;">Register now.<a></span>
                                </div>
                                <div class="divider">
                                    <span>OR</span>
                                </div>
                                <div class="d-flex align-items-center justify-content-between p-t-8"
                                    style="width:150%;">
                                    <button type="submit" id="txtSubmitMarketer" name="txtSubmitMarketer"
                                        class="btn btn-lg btn-block btn-grad">Agent Login In</button>
                                </div>
                                <div>
                                    <a style='color:red' id="marketerFrgPass" data-target="#agentFrgModel" data-toggle="modal" href="#">Forget Password ?<a>
                                </div>
                            </form>
                        </div>
                    </div>
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
    <script src="new_js/bussinesslogin.js"></script>
</body>

</html>