<?php
    $page ="Buss User";
    session_start();
    include("../connection.php");
    if(!isset($_SESSION["admin"]))
    {
        header("Location:login.php");
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Ghost Marketer Dashboard</title>

    <!-- Favicon -->
    <link rel="shortcut icon" href="../image/logo.png">

    <!-- page css -->

    <!-- Core css -->
    <link href="../assets/css/app.min.css" rel="stylesheet">

    <!-- Datatable CSS CDN -->
    <link href="//cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css" rel="stylesheet">
    <style>
          th
        {
            font-size:17px;
        }
        td
        {
            font-size:14px;
        }
        .tbl_main
        {
            /* box-shadow:4px 4px  12px 1px grey; */
            
            box-shadow:0 2px 4px 0 rgba(0, 0, 0, 0.2), 0 2px 10px 0 rgba(0, 0, 0, 0.19);
            padding-top: 15px;
            padding-bottom:15px;
            padding-left: 15px;
            padding-right: 15px;
            background-color: white;
            
        }
        .main-content{
            background-color:whitesmoke;
        }   
       .btn_close:hover{
            background-color: rgba(197, 239, 247,1);
            color:rgba(68, 108, 240,1);
            font-weight:500;
            border:0px;

       }
        .label_style
        {
            font-size:15px;
            font-weight:500;
        }
        .btn_styledange:hover{
            color:red;
            border:0px;
            font-weight:500;
            background-color: rgba(160,0,0,0.2); 
        }
        .btn_styleprime:hover{
            background-color: rgba(0,160,0,0.2);
            color:rgba(0, 160, 110, 1);
            font-weight:500;
            border:0px;
        }
    
    </style>

</head>

<body>
    <div class="app">
        <div class="layout">
            <!-- Header START -->
            <?php
                include("header.php");
            ?>
            <!-- Header END -->

            <!-- Side Nav START -->
            <?php
                include("sidebar.php");
            ?>
            <!-- Side Nav END -->

            <!-- Page Container START -->
            <div class="page-container">
                <div class="main-content"> 

                <!-- Modal -->
                <div class="modal fade" id="exampleModal">
                    <div class="modal-dialog justify-content-center">
                        <div class="modal-content justify-content-center">
                            <div class="modal-header justify-content-center">
                                <h5 class="modal-title" id="exampleModalLabel" style="font-size:25px;font-weight:700;">Modal title</h5>
                                <!-- <button type="button" class="close" data-dismiss="modal">
                                    <i class="anticon anticon-close"></i>
                                </button> -->
                            </div>
                            <div class="modal-body">
                                <label class="form-label label_style" id="reason-Label"></label>
                                <textarea name="reason" id="reason" placeholder="Enter Reason Here......" class="form-control" cols="30" rows="5" style="border:1px solid lightgrey;"></textarea>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-primary btn_close" id="save">Save changes</button>
                                <button type="button" class="btn btn-dark btn-tone" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>

                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Premium Business</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Expired Business</a>
                    </li>
                </ul>
                <div class="tab-content m-t-15" id="myTabContent">
                <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                    <div class="tbl_main table-responsive">     
                        <table id="substable" class="table hover" >
                            <thead class="thead-dark">
                                <tr>
                                    <th>Registered Date</th>
                                    <th>Business Name</th>
                                    <th>Owner Name</th>
                                    <th>Address</th>
                                    <th>Email Id</th>
                                    <th>Contact No</th>
                                    <th>GST Number</th>
                                    <th>State</th>
                                    <th>City</th>
                                    <th>Status</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                    $query = mysqli_query($con, "SELECT * FROM `user_master` WHERE `id` IN (SELECT `id` FROM `user_master` WHERE DATEDIFF(`expiary_date`, CURRENT_DATE) > 0 AND `role` = 1)");

                                    while($row = mysqli_fetch_array($query))
                                    {?>
                                        <tr>
                                            <td><?php echo date("d/M/Y", strtotime($row['created_at'])) ?></td>
                                            <td><?php echo $row['bussiness_name'] ?></td>
                                            <td><?php echo $row['owner_name'] ?></td>
                                            <td><?php echo $row['address'] ?></td>
                                            <td><?php echo $row['email'] ?></td>
                                            <td><?php echo $row['phone'] ?></td>
                                            <td><?php echo $row['gst_no'] ?></td>
                                            <td><?php echo $row['state'] ?></td>
                                            <td><?php echo $row['city'] ?></td>
                                            <td><?php
                                                if($row['status'] != "active")
                                                {
                                                    // echo "<button class='btn btn-danger block' data-id='". $row['id'] ."'>Block User</button>";

                                                    echo "<button class='btn btn-danger btn_styledange unblock' data-id='". $row['id'] ."' data-do='Active'>Block</button>";
                                                }
                                                else
                                                {
                                                    // echo "<button class='btn btn-success unblock' data-id='". $row['id'] ."'>Unblock User</button>";

                                                    echo "<button class='btn btn-success btn_styleprime block' data-id='". $row['id'] ."' data-do='Block'>Active</button>";
                                                }
                                            ?></td>
                                        </tr>
                                    <?php
                                    }
                                ?>
                                </tbody>
                            <tfoot>
                                <tr>
                                <th>Registered Date</th>
                                    <th>Business Name</th>
                                    <th>Owner Name</th>
                                    <th>Address</th>
                                    <th>Email Id</th>
                                    <th>Contact No</th>
                                    <th>GST Number</th>
                                    <th>State</th>
                                    <th>City</th>
                                    <th>Status</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                    </div>
                    <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                        <div class="tbl_main table-responsive">  
                            <table id="userTable" class="table hover" >
                                <thead class="thead-dark">
                                    <tr>
                                        <th>Registered Date</th>
                                        <th>Business Name</th>
                                        <th>Owner Name</th>
                                        <th>Address</th>
                                        <th>Email Id</th>
                                        <th>Contact No</th>
                                        <th>GST Number</th>
                                        <th>State</th>
                                        <th>City</th>
                                        <th>Status</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                        $query = mysqli_query($con, "SELECT * FROM `user_master` WHERE `id` IN (SELECT `id` FROM `user_master` WHERE DATEDIFF(`expiary_date`, CURRENT_DATE) < 0 AND `role` = 1)");

                                        while($row = mysqli_fetch_array($query))
                                        {?>
                                            <tr>
                                                <td><?php echo date("d/M/Y", strtotime($row['created_at'])) ?></td>
                                                <td><?php echo $row['bussiness_name'] ?></td>
                                                <td><?php echo $row['owner_name'] ?></td>
                                                <td><?php echo $row['address'] ?></td>
                                                <td><?php echo $row['email'] ?></td>
                                                <td><?php echo $row['phone'] ?></td>
                                                <td><?php echo $row['gst_no'] ?></td>
                                                <td><?php echo $row['state'] ?></td>
                                                <td><?php echo $row['city'] ?></td>
                                                <td><?php
                                                    if($row['status'] != "active")
                                                    {
                                                        // echo "<button class='btn btn-danger block' data-id='". $row['id'] ."'>Block User</button>";

                                                        echo "<button class='btn btn-success btn_styledange unblock' data-id='". $row['id'] ."'>Block</button>";
                                                    }
                                                    else
                                                    {
                                                        // echo "<button class='btn btn-success unblock' data-id='". $row['id'] ."'>Unblock User</button>";

                                                        echo "<button class='btn btn-danger btn_styleprime block' data-id='". $row['id'] ."'>Active</button>";
                                                    }
                                                ?></td>
                                            </tr>
                                        <?php
                                        }
                                    ?>
                                    </tbody>
                                <tfoot>
                                    <tr>
                                        <th>Registered Date</th>
                                        <th>Business Name</th>
                                        <th>Owner Name</th>
                                        <th>Address</th>
                                        <th>Email Id</th>
                                        <th>Contact No</th>
                                        <th>GST Number</th>
                                        <th>State</th>
                                        <th>City</th>
                                        <th>Status</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
                    
                            
                        
                    </div>
                <!-- Content Wrapper END -->
              
                <!-- Footer START -->
                    <?php include("footer.php"); ?>
                <!-- Footer END -->
            </div>
            <!-- Page Container END -->

            <!-- Quick theme START -->
            <?php include("theme.php"); ?>
            <!-- Quick theme END -->
        </div>
    </div>

    <?php include("include.php"); ?>
    <script>
        $("#userTable").DataTable({
            // rowReorder: {
            //     selector: 'td:nth-child(2)'
            // },
            // responsive: true
        });

        $("#substable").DataTable({
            // rowReorder: {
            //     selector: 'td:nth-child(2)'
            // },
            // responsive: true
        });
        
        if(sessionStorage.getItem("current-admin-regBus") == "" || sessionStorage.getItem("current-admin-regBus") == null)
        {
            sessionStorage.setItem("current-admin-regBus", "home-tab");
        }
        else if(sessionStorage.getItem("current-admin-regBus") == "home-tab")
        {
            $("#myTab").children().find("a").removeClass("active");
            
        }
        else if(sessionStorage.getItem("current-admin-regBus") == "profile-tab")
        {
            $("#myTab").children().find("a").removeClass("active");
            
        }

        $(`#${sessionStorage.getItem("current-admin-regBus")}`).attr("aria-selected", true);
        $(`#${sessionStorage.getItem("current-admin-regBus")}`).addClass("active");

        $(".tab-pane").removeClass("active");
        $(".tab-pane").removeClass("show");
        $(`[aria-labelledby=${sessionStorage.getItem("current-admin-regBus")}]`).addClass("show");
        $(`[aria-labelledby=${sessionStorage.getItem("current-admin-regBus")}]`).addClass("active");

        $("#home-tab").click(function(){
            sessionStorage.setItem("current-admin-regBus", "home-tab");
        });
        $("#profile-tab").click(function(){
            sessionStorage.setItem("current-admin-regBus", "profile-tab");
        });
     </script>
   
</body>

</html>