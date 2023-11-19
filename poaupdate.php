<?php
include 'connection.php';
error_reporting (E_ERROR | E_PARSE);
$id=$_GET['id1'];
$query="SELECT * FROM poa where POAID='$id'";
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
    <title>Document</title>
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
                 top: 62%;
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
                <li><a href="poadata.php"><i class="fa fa-backward" aria-hidden="true"></i><b>Back</b></a></li>
            </ul>
        </nav>
    </div>
	<div class="center">
    <h1>  Update Power Of Attorney Details</h1>
	
    <form action="" method="POST">
    <table border="0" align="center" cellspacing="15" >
        <br>
        <tr>
            <td><b>First Name:</b><td><input type="text" style="font-size:18px;height:35px;width:280px;"placeholder="Enter Your FirstName" required name="fname"value="<?php echo $row['FIRSTNAME']; ?>"></td>
            </tr>
            <tr>
                <td><b>Last Name:</b><td><input type="text" style="font-size:18px;height:35px;width:280px;"placeholder="Enter Yout last Name" required name="lname" value="<?php echo $row['LASTNAME']; ?>"></td>
                </tr>
            <tr><td><b>
                Gender:</b><td><input type="radio" name="r1"style="font-size:18pxstyle;height:20px;width:50px;" required placeholder="Select Your Gender" value="Male"<?php 
                                                                                                                                                        if ($row['GENDER'] == 'Male') {
                                                                                                                                                            echo "checked";
                                                                                                                                                        }
                                                                                                                                                        ?>>Male<br><input type="radio" name="r1"style="font-size:18pxstyle;height:20px;width:50px;"
                    placeholder="Select Your Gender"required value="Female"<?php
                                                                                                                                                        if ($row['GENDER'] == 'Female') {
                                                                                                                                                            echo "checked";
                                                                                                                                                        }
                                                                                                                                                        ?>
                    >Female<br><input type="radio" name="r1"style="font-size:18pxstyle;height:20px;width:50px;"placeholder="Select Your Gender" required value="Other"<?php
                                                                                                                                                        if ($row['GENDER'] == 'Other') {
                                                                                                                                                            echo "checked";
                                                                                                                                                        }
                                                                                                                                                        ?>>Other
                </tr>
            <tr><td><b> 
                POA-Id:</b><td> <input type="number"style="font-size:18px;height:35px;width:280px;" placeholder="Enter Your Aadhar number" required name="poa" value="<?php echo $row['POAID']; ?>"></td>
            </tr> 
			<tr><td><b>
                Donor-Id:</b><td> <input type="number"style="font-size:18px;height:30px;width:280px" placeholder="Enter Donor Aadhar number" required name="don"value="<?php echo $row['DONORID']; ?>"></td></tr>
            <tr><td><b>
                Email:</b> <td><input type="email" style="font-size:18px;height:35px;width:280px;"placeholder="Enter Your correct Email" required name="email"value="<?php echo $row['EMAIL']; ?>"></td></tr>
                    <tr><td><b>
                        Date of Birth:</b><td> <input type="date"style="font-size:18px;height:38px;width:280px;" placeholder="enter your DOB" required name="dob"value="<?php echo $row['DOB']; ?>"></td>
            
            <tr><td><b>
                Location:</b><td ><input type="text" style="font-size:18px;height:35px;width:280px;"placeholder="Enter Your Location" required name="location"value="<?php echo $row['LOCATION']; ?>"></td>
            </tr>
            <tr><td><b>
                Phone Number:</br><td> <input type="number"style="font-size:18px;height:35px;width:280px;" placeholder="Enter Your phone number" required name="phone"value="<?php echo $row['PHONE']; ?>"></td>
            </tr>
            <tr><td><b>
                Relation with Donar:</b><td> <input type="text" style="font-size:18px;height:35px;width:280px;"placeholder="Relation with Donar" required name="relation"value="<?php echo $row['RELATION']; ?>"></td>
            </tr>
            <tr><td><b>
                Donor Deathdate:</b><td> <input type="date"style="font-size:18px;height:35px;width:280px;" placeholder="enter donor death date" required name="dead"value="<?php echo $row['DEAD']; ?>"></td>
            </tr>
            <tr><td align="center" colspan="2"> 
            <button class="button" name="submit">Update</button>
            <!-- <button class="button">Edit</button> -->
            </td>
            </tr>
            </table>
        </form>
    </div>
</body>

</html>
<?php
if(isset($_POST['submit'])){
$fname=$_POST['fname'];
$lname=$_POST['lname'];
$r1=$_POST['r1'];
$poa=$_POST['poa'];
$don=$_POST['don'];
$email=$_POST['email'];
$dob=$_POST['dob'];
$location=$_POST['location'];
$phone=$_POST['phone'];
$relation=$_POST['relation'];
$dead=$_POST['dead'];
$query="UPDATE poa SET FIRSTNAME='$fname',LASTNAME='$lname',GENDER='$r1',POAID='$poa',DONORID='$don',EMAIL='$email',DOB='$dob',LOCATION='$location',PHONE='$phone',RELATION='$relation',DEAD='$dead' WHERE POAID='$id'";
$data=mysqli_query($conn,$query);
if($data)
{
    echo "<script>alert('Data Updated Successfully')</script>";
    ?>
    <meta http-equiv="refresh" content="0;url=http://localhost/dbmsproject/poadata.php"/>
    <?php
}
else
{
    echo "<script>alert('Failed to update')</script>";
}
}


?>