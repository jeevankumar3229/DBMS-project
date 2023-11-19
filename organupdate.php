<?php
include 'connection.php';
error_reporting (E_ERROR | E_PARSE);
$id=$_GET['id1'];
$query="SELECT * FROM organ where ORGANID='$id'";
                $query_run=mysqli_query($conn,$query);
                $total =mysqli_num_rows($query_run);
                $row=mysqli_fetch_assoc($query_run);
                ?>
<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Organ detail</title>
    <link href="https://fonts.googleapis.com/css2?family=Meow+Script&family=Poppins:wght@400;600;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
         *{
            font-family: sans-serif;
        }
        body{
            background-image: linear-gradient(rgba(0,0,0,0.4),rgba(0,0,0,0.4)),url(images/donar2.jpg);
            background-size: cover;
        }
        .center{
                 position: absolute;
                 top: 45%;
                 left: 50%;
				 /* bottom:80%; */
                 transform: translate(-50%, -50%);
                 width: 600px;                 background: white;
                 border-radius: 10px;
                 box-shadow: 10px 10px 15px rgba(0,0,0,0.05);
				 
}
        .button{
        margin:0px 9px;
        background-color: rgb(87, 182, 238);;
        color: rgb(6, 7, 5);
        padding: 4px 20px;
        border: 2px solid gray;
        border-radius: 5px;
        font-size: 20px;
        cursor: pointer;
        font-family:'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;
    }
    .button:hover{
        background-color: rgb(60, 63, 55);
    }
        
        
        table{
            color:rgb(43, 31, 31);
            font-size: 22px;
            /* background-color: white; */
        }
        h1{
            text-align: center;
        }
        
		.navbar .fa{
            margin-right:  7px;
        }
        .navbar {
            position: fixed;
            height: 10%;
            width: 100%;
            top: 0;
            left: 0;
            /* background: rgba(158, 200, 228, 0.568); */
        }

        .navbar ul li a:hover {
            background: rgb(100, 201, 248);
            border-radius: 2px;
        }

        .navbar ul {
            float: right;
            margin-right: 100px;
        }

        .navbar ul li {
            list-style: none;
            margin: 0 8px;
            display: inline-block;
            line-height: 80px;
        }

        .navbar ul li a {
            font-size: 20px;
            font-family: 'Roboto', sans-serif;
            color: white;
            padding: 3px 10px;
            text-decoration: none;
            transition: .4s;
        }
    </style>
</head>

<body>
<div>
        <nav class="navbar">
            <ul>
                <li><a href="organdata.php"><i class="fa fa-backward" aria-hidden="true"></i><b>Back</b></a></li>
            </ul>
        </nav>
    </div>
	<div class="center">
    <h1>Update Organ Details</h1>
    
    <form action="" method="POST">
        <table border="0" align="center" cellspacing="15">
            <br>
            <tr>
                <td><b> Organ-Name:</b>
                <td><input type="text" style="font-size:18px;height:30px;width:280px;;" placeholder="Enter Organ Name"
                        required name="oname" value="<?php echo $row['ORGANNAME']; ?>"></td>
            </tr>

             <tr>
                <td><b>
                        Donar-Id:</b>
                <td> <input type="number" style="font-size:18px;height:30px;width:280px;" placeholder="Enter Donar-Id"
                        required name="did"value="<?php echo $row['DONORID']; ?>"></td>
            </tr>

            <tr>
                <td><b>
                        Doctor-Id:</b>
                <td><input type="number" style="font-size:18px;height:30px;width:280px;" placeholder="Enter Doctor-Id"
                        required name="dod"value="<?php echo $row['DOCTORID']; ?>"></td>
            </tr>
             <tr>
                <td><b>
                        Organ-Id:</b>
                <td><input type="number" style="font-size:18px;height:30px;width:280px;" placeholder="Enter Organ-Id"
                        required name="od"value="<?php echo $row['ORGANID']; ?>"></td>
            </tr>



            <tr>
                <td><b>
                        Donated-date:</b>
                <td> <input type="date" style="font-size:18px;height:30px;width:280px;" placeholder="Enter Donated Date"
                        required name="ddate"value="<?php echo $row['DONATEDDATE']; ?>"></td>
            </tr>

            <tr>
                <td align="center" colspan="2">
                    <button class="button" name="submit">Update</button>

                </td>
            </tr>
        </table>
    </form>
    </div>
</body>

</html>
<?php
if(isset($_POST['submit'])){
$oname=$_POST['oname'];
$ddate=$_POST['ddate'];
$did=$_POST['did'];
$od=$_POST['od'];
$dod=$_POST['dod'];
$query="UPDATE organ SET ORGANNAME='$oname',DONORID='$did',DOCTORID='$dod',ORGANID='$od',DONATEDDATE='$ddate' WHERE ORGANID='$id'";
$data=mysqli_query($conn,$query);
if($data)
{
    echo "<script>alert('Data Updated Successfully')</script>";
    ?>
    <meta http-equiv="refresh" content="0;url=http://localhost/dbmsproject/organdata.php"/>
    <?php
}
else
{
    echo "<script>alert('Failed to update')</script>";
}
}


?>