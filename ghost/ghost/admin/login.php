<?php 
    include("../connection.php");
     session_start();
    if(isset($_SESSION["admin"]))
    {
        header("Location:index.php");
    }

    // $mac = exec("getmac");

    // $mac = strtok($mac, " ");

    // echo $mac;
?>
<!DOCTYPE html>
<html>
<head>
    <title>Ghost Marketer Admin Panel</title>
    <meta charset="utf-8"/>
	<meta name="viewport" content="width=device-width,initial-scale=1"/>
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous"/>
  <!--Css Stylesheet-->
  <style>
        body
        {
            background: url("../image/bgfor admin.png");
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center;
            background-attachment: fixed;
            font-family: 'Roboto', sans-serif;
            
        }
        .back
        {
            box-shadow: 0 3px 6px rgba(0, 0, 0, 0.16), 0 3px 6px rgba(0, 0, 0, 0.23);  

        }
    /* .form-group {
        margin-bottom: 40px;
        outline: 0px;
    } */
        label {
            margin-bottom: 0px;
        }
        .login-title
        {
            font-size:30px;
            font-weight:bold;
            font-family:Arial,monospace,Helvetica, sans-serif;  
            letter-spacing: 2px;
        }
        input[type=email]
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
        input[type=password]
        {
            border: none;
            border-bottom: 2px solid #0DB8DE;
            border-top: 0px;
            border-radius: 0px;
            padding-left: 0px;
            /* margin-bottom: 15px; */
            font-size: 14px;
        }
        .form-control:focus {
            border-color: inherit;
            -webkit-box-shadow: none;
            box-shadow: none;
            border-bottom:2px solid #0DB8DE;
            /* border-top:1px solid #0DB8DE;
            border-right:1px solid #0DB8DE;
            border-left:1px solid #0DB8DE; */
            outline: 0;
            background-color:aliceblue;
            color:black;

        }
        .form-control-label {
            font-size:12px;
            color: #6C6C6C;
            font-weight: bold;
            letter-spacing: 1px;
        }

        input:focus {
            outline: none;
            box-shadow: 0 0 0;
        }
        .forgot-pass
        {
            text-decoration:none;
            color:red;
            font-weight:600;
            font-size: 12px;
            font-family:Verdana, Geneva, Tahoma, sans-serif;
            margin-left:65%;
        }
        .submit_btn
        {
            background-color:lightslategray;
            color:white;
            font-weight: bold;
            letter-spacing: 0.5px;
        }
        .submit_btn:hover{
            border:3px solid lightslategray;
            color:black;
            background-color:slategray;
            font-weight: bold;
        }
        .close_btn
        {
            font-size:xx-large;
        }
        .frm_back
        {
            width: 25rem;
        }
        .frm_main
        {
        
            position:sticky;
            /* top: 40%;
            left: 47%;
            transform: translate(-50%, -50%); */
        }
        @media (max-width : 411px){
        .frm_back{

            position:sticky;
            /* top: 40%;
            left: 40%;
            transform: translate(-50%, -20%); */
           }
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
    <link rel="shortcut icon" href="../image/logo.png">
</head>
<body>
<div class="container">
    

    <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title">Forget Password</h4>
            <button type="button" class="btn close_btn" data-bs-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
            <div class="form-group">
                <label class="form-label">Enter Your Email :</label>
                <input type="email" name="email" id="email" class="form-control" />
            </div>

            <div class="form-group otp">
                <label class="form-label">Enter OTP :</label>
                <input type="number" name="otp" id="otp" class="form-control" />
            </div>

            <div class="form-group pas">
                <label class="form-label">Enter New Password :</label>
                <input type="password" name="pas" id="pas" class="form-control" />

                <label class="form-label">Confirm Password :</label>
                <input type="text" name="conpas" id="conpas" class="form-control" />
            </div>
        </div>
        <div class="modal-footer">
            <button class="btn btn-primary btn_close" id="sendotp">Send OTP</button>
            <button class="btn btn-primary btn_close" id="verifyotp">Verify OTP</button>
            <button class="btn btn-primary btn_close" id="changepas">Save Password</button>
            <button type="button" class="btn btn-danger btn_styledange btn-default" data-bs-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>
<!--Admin Login Form-->
<div class="d-flex justify-content-center m-5 frm_main">
    <div class="mt-4">
    <div class="col-md-3 col-sm-12 ">
        <div class="card back frm_back" >
         <div class="card-body">
           <div class="text-center">
          <img src="../image/Key.png" width="25%" alt="Card image cap">
        </div>
        <h5 class="card-title text-center login-title mt-3">ADMIN PANEL</h5>
         <p class="card-text">
            <form method="post" id="frm">
                <div class="p-2">   
                    <div class="form-group mb-4">
                        <label class="lbl form-control-label">EMAIL-ID:</label>
                        <input type="email" id="txtMail" name="txtMail" class="form-control"/>
                     </div>
                    <div class="form-group">
                        <label class="lbl form-control-label">PASSWORD:</label>
                         <input type="password" id="txtPwd" name="txtPwd" class="form-control"/>
                        <a href="#" class="forgot-pass" id="frg_pass">Forgot Password?</a>
                    </div>
                     <div>
                        <button id="submit_login"  class="btn submit_btn mt-4 btn-lg form-control ">LOG IN</button>
                    </div>
            </form>
          </p>
        </div>
         </div>
   
        </div>
     </div>
      </div>
    </div>
</div>
</div>
</div>
</body>


 <!-- JavaScript Bundle with Popper -->
 <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
 <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
 <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script> -->
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
 <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-growl/1.0.0/jquery.bootstrap-growl.min.js" integrity="sha512-pBoUgBw+mK85IYWlMTSeBQ0Djx3u23anXFNQfBiIm2D8MbVT9lr+IxUccP8AMMQ6LCvgnlhUCK3ZCThaBCr8Ng==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
 
 <!--Admin_login.js file-->
  <script src="../new_js/admin_login.js" type="text/javascript"></script>
  <script src="../new_js/forget_password.js" type="text/javascript"></script>
</html>
