<?php
    $page="subscription";
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
            /* color:black; */
        }
        .inpt_minifrm{
            /* background-color:whitesmoke;  */
            border:1px solid lightgrey;
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
        .btn_styledangeclose:hover
        {
            color:red;
            border:0px;
            font-weight:500;
            background-color: rgba(160,0,0,0.2); 
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
                

                <!-- Content Wrapper START -->
                <div class="main-content">
                <!--Add subscription plan Model -->
                    <div class="modal fade" id="addNewPlan" status="dialog">
                        <div class="modal-dialog">
                            <div class="modal-content  justify-content-center">
                                <div class="modal-header  justify-content-center">
                                        <div class="modal-title" id="addNewPlanLabel" style="font-size:25px;font-weight:700;" >Add New Subscription Plan</div>
                                </div>
                                
                                    <form method="post" id="subscriptionPlan">
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label style="font-size:15px;font-weight:500">Name:</label>
                                            <input type="text" id="subName" name="subName" class="form-control inpt_minifrm" placeholder="Name"/>
                                        </div>
                                        <div class="form-group">
                                            <label style="font-size:15px;font-weight:500">Description:</label>
                                            <textarea type="text" id="subDes" name="subDes" class="form-control inpt_minifrm" placeholder="Description"></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label style="font-size:15px;font-weight:500">Price:</label>
                                            <input type="number" id="subPrice" name="subPrice" class="form-control inpt_minifrm" placeholder="Price"/>
                                        </div>
                                        <div class="form-group">
                                            <label style="font-size:15px;font-weight:500">Time Perioud(Days):</label>
                                            <input type="number" id="subTime" name="subTime" class="form-control inpt_minifrm" placeholder="Time Perioud"/>
                                        </div>
                                        </div>
                                    </form>
                                
                                <div class="modal-footer">
                                    <button type="button" id="btnSubmit" class="btn btn-primary btn_close">Save changes</button>
                                    <button type="button" class="btn btn-dark btn-tone" data-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- button trigger model -->
                    <div style="font-size:23px;font-weight:bold">Subscription Plan:</div>
                    <button class="btn btn-primary m-5" data-target="#addNewPlan" data-toggle="modal" id="addNewPlan">Add New Subscription Plan</button><br/><br/>
                        <div class="tbl_main table-responsive">
                            <table id="tblPlan" class="table hover">
                                <thead ad class="thead-dark">
                                <tr>
                                        <th>Name</th>
                                        <th>Description</th>
                                        <th>Price</th>
                                        <th>Time Perioud</th>
                                        <th>Status</th>
                                        <th>View More</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php
                                    $query = mysqli_query($con, "select * from subscription_master");
                                    while($row=mysqli_fetch_array($query))
                                    {
                                        echo "<tr>";
                                        echo "<td>".$row['subscription_name']."</td>";
                                        echo "<td>".$row['description']."</td>";
                                        echo "<td>".$row['rate']."</td>";
                                        echo "<td>".$row['time_perioud']."</td>";
                                        if($row['status']=='Active')
                                        {
                                            echo "<td><button type='button' id='btnBlock' data-id='".$row['id']."' class='btn btn-success btn_styleprime active_block'>Active</button>";
                                            // echo "<td><label class='switch switch-left-right'>";
                                            // echo "<input class='switch-input active_block' data-id='".$row['id']."' type='checkbox'/>";
                                            // echo "<span class='switch-label' data-on='on' data-off='off'></span>";
                                            //  echo "<span class='switch-handle'></span>";
                                            // echo "</label>";
                                        }
                                        else
                                        {
                                            echo "<td><button type='button' id='btnActive' data-id='".$row['id']."' class='btn btn-danger btn_styledange block_active'>Block</button>";
                                        
                                        }
                                        "</td>";
                                            
                                        echo "<td><button type='button' id='btnView' style='width:60px;height:45px;' title='View More' data-id='".$row['id']."' data-toggle='modal' data-target='#view' class='btn btn-primary btn-tone  viewbutton'><i class='far fa-eye' title='View More'></i></button></td>";
                                        echo "</tr>";
                                    
                                    }
                                ?>
                                
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>Subscription Name</th>
                                        <th>Description</th>
                                        <th>Price</th>
                                        <th>Time Perioud</th>
                                        <th>Status</th>
                                        <th>View More</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                         <!-- Modal -->
                   <div class="modal fade" id="view">
                        <div class="modal-dialog modal-lg justify-content-center" >
                            <div class="modal-content justify-content-center">
                                <div class="modal-header justify-content-center ">
                                   <div class="modal-title" id="addNewPlanLabel" >
                                        <h5 style="font-size:25px;font-weight:700;" id="viewMoreHeader">View Visitor User</h5>
                                        <!-- <button type="button" class="close" data-dismiss="modal">
                                            <i class="anticon anticon-close "></i>
                                        </button>  -->
                                    </div>
                                </div>
                                <hr>
                             
                            <div class="modal-body">
                                <div class="tbl_main table-responsive">
                                    <table id="monthwiseuser" class="table hover">
                                        <thead class="thead-dark">
                                            <tr>
                                                <th>Name</th>
                                                <th>Email</th>
                                                <th>Phone No.</th>
                                                <th>User Type</th>
                                            </tr>
                                        </thead>
                                        <tbody id="subscri"></tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                            </div>
                            </div>
                        </div>
                    </div>

                    </div>
                    <!-- Footer START -->
                    <?php include("footer.php"); ?>
                </div>
                <!-- Content Wrapper END -->

                
                <!-- Footer END -->
            </div>
            <!-- Page Container END -->

            <!-- Quick theme START -->
            <?php include("theme.php"); ?>
            <!-- Quick theme END -->
        </div>
    </div>

    <?php include("include.php") ?>
    <script>
        $("#tblPlan").DataTable();
        // $("#monthwiseuser").DataTable();
    </script>

    <script src="../new_js/addSubscriptionPlan.js"></script>
</body>

</html>
