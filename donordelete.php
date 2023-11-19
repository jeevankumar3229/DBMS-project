<?php
include 'connection.php';
$id=$_GET['id1'];
$query="DELETE  FROM donor where DONORID='$id'";
                $query_run=mysqli_query($conn,$query);
                if($query_run)
                {
                  echo "<script>alert('Record Deleted Successfully')</script>";
                  ?>
                  <meta http-equiv="refresh" content="0;url=http://localhost/dbmsproject/donordata.php"/>
                  <?php
                }
                else{
                  echo "<script>alert('Record Not Deleted Successfully')</script>";
                }
?>