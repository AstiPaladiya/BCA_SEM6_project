<?php 
    $page="visiterUser";
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
    <link href="//cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css" rel="stylesheet"/>
    <link href="https://cdn.datatables.net/rowreorder/1.3.1/css/rowReorder.dataTables.min.css" rel="stylesheet" />
    <link href="https://cdn.datatables.net/responsive/2.4.0/css/responsive.dataTables.min.css" rel="stylesheet" />
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
            
            /* box-shadow:0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19); */
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
                     <form id="frm" method="post">
                       <div class="tbl_main table-responsive">
                            <table id="visitor" class="table hover" >
                                <thead class="thead-dark">
                                    <tr>
                                        <th>Year</th>
                                        <th>No of Visitor</th>
                                        <th>View More</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                        
                                        $query = mysqli_query($con,"SELECT EXTRACT(year from created_at) as year, count(*) FROM visitor_master GROUP BY year");

                                        while($row=mysqli_fetch_array($query))
                                        {
                                            echo "<tr>";
                                            echo "<td >".$row['year']."</td>";
                                            echo "<td>".$row['count(*)']."</td>";
                                            echo "<td><button type='button' id='btnViewMore' data-id='".$row['year']."' data-toggle='modal' title='View More' data-target='#viewVisitor' style='width:60px;height:45px' class='btn btn-primary btn-tone btnViewMore'><i class='far fa-eye' title='View More'></i></button></td>";
                                            echo "</tr>";
                                        }
                                        
                                        ?>
                                    </tbody>
                                <tfoot>
                                    <tr>
                                        <th>Year</th>
                                        <th>No of Visitor</th>
                                    <th>View More</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </form>
                   <!-- Modal -->
                   <div class="modal fade" id="viewVisitor">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content justify-content-center">
                                <div class="modal-header justify-content-center ">
                                   <div class="modal-title" id="addNewPlanLabel" style="font-size:25px;font-weight:700;" >
                                        <div>View Visitor User</div>
                                    </div>
                                </div>
                                <hr>
                             
                            <div class="modal-body">
                                <div class="tbl_main table-responsive">
                                    <table id="monthwiseuser" class="table hover">
                                        <thead class="thead-dark">
                                            <tr>
                                                <th>Month</th>
                                                <th>No of Visitor</th>
                                            </tr>
                                        </thead>
                                        <tbody id="monwisedetai"></tbody>
                                        <tfoot>
                                            <tr>
                                                <th>Month</th>
                                                <th>No of Visitor</th>
                                            </tr>
                                        </tfoot>
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
            
                <!-- Content Wrapper END -->
              
                <!-- Footer START -->
                    <?php include("footer.php"); ?>
            </div>
                <!-- Footer END -->
            <!-- Page Container END -->

            <!-- Quick theme START -->
            <?php include("theme.php"); ?>
            <!-- Quick theme END -->
        </div>
    </div>

    <?php include("include.php"); ?>
    <script>
        $("#visitor").DataTable();
        // $("#monthwiseuser").DataTable();
     </script>
     <!-- Visitor User Js -->
   <script src="../new_js/visitoruser.js"></script>
</body>

</html>