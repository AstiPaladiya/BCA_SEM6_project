<?php
  
    include("connection.php");

// PHP code to get the MAC address of Server
$MAC = exec('getmac');
  
// Storing 'getmac' value in $MAC
$MAC = strtok($MAC, ' ');
  
// Updating $MAC value using strtok function, 
// strtok is used to split the string into tokens
// split character of strtok is defined as a space
// because getmac returns transport name after
// MAC address   
$query = mysqli_query($con, "select count(*) from visitor_master where mac_address='".$MAC."'");
$row = mysqli_fetch_array($query);
if($row[0]<0)
{
    mysqli_query($con, "insert into visitor_master (mac_address) values ('" . $MAC . "') ");

}
?>