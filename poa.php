<?php

$fname = $lname = $r1 = $poa = $email =$dob = $location = $phone=$relation = $dead = $register=$p1 = $don="";
$fname1 = $lname1 = $r11 = $poa1 = $email1 = $dob1 = $location1 = $phone1 = $relation1=$dead1 = $don1="";
$emailpassword = "";
// include 'connection.php';
if ($_SERVER['REQUEST_METHOD'] == "POST") {
	include 'connection.php';
	$don = $_POST['don'];
	$emailsearch = "SELECT * FROM donor where DONORID='$don'";
	$query = mysqli_query($conn, $emailsearch);
	$emailcount = mysqli_num_rows($query);
	// $emailpassword=mysqli_fetch_assoc($query);
	if ($emailcount > 0) {
		$emailpassword = mysqli_fetch_assoc($query);
		if (empty($don)) {
			$don1 = "Email cannot be empty";
		} else {
			if ($emailpassword['DONORID'] == $don) {
				$p1 = $don;
			} else {
				$don1 = "Invalid Email";
			}
		}
		//check for firstname
		if (empty(($_POST["poa"]))) {
			$poa1 = "DonorId cannot be blank";
		} else {
			$sql = "SELECT * from poa WHERE POAID = ?";
			$stmt = mysqli_prepare($conn, $sql);
			if ($stmt) {
				mysqli_stmt_bind_param($stmt, "s", $poa2);
	
				//set the value of email
				$poa2 = trim($_POST['poa']);
	
				//Try to execute the statement
				if (mysqli_stmt_execute($stmt)) {
					mysqli_stmt_store_result($stmt);
	
					if (mysqli_stmt_num_rows($stmt) > 0) {
						$poa1 = "This is primary key field";
					} else {
						$poa = ($_POST['poa']);
					}
				} else {
					echo "Something went wrong";
				}
			}
			mysqli_stmt_close($stmt);
		}
		if (empty(($_POST['fname']))) {
			$fname1 = "fname cannot be empty";
		} else {
			$fname =$_POST['fname'] ;
		}
		//check for the lastname
		if (empty(($_POST['lname']))) {
			$lname1 = "lname cannot be empty";
		} else {
			$lname =$_POST['lname'] ;
		}
		if (empty(($_POST['r1']))) {
			$r11 = "gender cannot be empty";
		} else {
			$r1 = ($_POST['r1']);
		}
		//Check if username is empty
		if (empty(($_POST['email']))) {
			$email1 = "email cannot be empty";
		} else {
			$email =$_POST['email'] ;
		}
		if (empty(($_POST['dob']))) {
			$dob1 = "dob cannot be empty";
		} else {
			$dob = ($_POST['dob']);
		}

		//check for password
		if (empty(($_POST['phone']))) {
			$phone1 = "phone cannot be empty";
		} else {
			$phone = ($_POST['phone']);
		}


		if (empty(($_POST['location']))) {
			$location1 = "location cannot be empty";
		} else {
			$location = ($_POST['location']);
		}
		if (empty(($_POST['relation']))) {
			$relation1 = "relation cannot be empty";
		} else {
			$relation = ($_POST['relation']);
		}
        if (empty(($_POST['dead']))) {
			$dead1 = "dead cannot be empty";
		} else {
			$dead =$_POST['dead'] ;
		}
		// mysqli_stmt_close($stmt);





		//if all of then insert
		if (empty($fname1) && empty($lname1) && empty($r11) && empty($poa1) && empty($dob1) && empty($email1) && empty($location1) && empty($phone1) && empty($dead1) && empty($relation1)) {
			$sql = " INSERT INTO `poa`(`FIRSTNAME`, `LASTNAME`, `GENDER`, `POAID`,`DONORID`, `EMAIL`, `DOB`, `LOCATION`, `PHONE`, `RELATION`,`DEAD`)VALUES ('$fname','$lname','$r1','$poa','$p1','$email','$dob','$location','$phone','$relation','$dead')";
			$stmt = mysqli_prepare($conn, $sql);

			mysqli_stmt_execute($stmt);
			echo "<script>alert('Successfully Details Are Added...')</script>";
			?>
			<meta http-equiv="refresh" content="0;url=http://localhost/dbmsproject/dash3.php"/>
			<?php
		


			//Try to execute the query
			// if(mysqli_stmt_execute($stmt))
			// {
			// header("location: main.html");

			// }
			// else
			// {
			// echo "Something went wrong......cannot redirect!";
			// }
			mysqli_stmt_close($stmt);
		} else {
			echo "<script>alert(' Poa-Id Already Exists.')</script>";
		}
	} else {
		echo "<script>alert('Invalid Donor-Id.')</script>";
	}
	// mysqli_close($conn);
	mysqli_close($conn);
}
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
                <li><a href="dash3.php"><i class="fa fa-backward" aria-hidden="true"></i><b>Back</b></a></li>
            </ul>
        </nav>
    </div>
	<div class="center">
    <h1> Enter Power Of Attorney Details</h1>
	<div class="p">
  <!-- <?php   echo $register;?> -->
</div>
    <form action="" method="POST">
    <table border="0" align="center" cellspacing="15" >
        <br>
        <tr>
            <td><b>First Name:</b><td><input type="text" style="font-size:18px;height:35px;width:280px;"placeholder="Enter Your FirstName" required name="fname"></td>
            </tr>
            <tr>
                <td><b>Last Name:</b><td><input type="text" style="font-size:18px;height:35px;width:280px;"placeholder="Enter Yout last Name" required name="lname"></td>
                </tr>
            <tr><td><b>
                Gender:</b><td><input type="radio" name="r1"style="font-size:18pxstyle;height:20px;width:50px;" required value="Male" placeholder="Select Your Gender">Male<br><input type="radio" name="r1"style="font-size:18pxstyle;height:20px;width:50px;"
                    placeholder="Select Your Gender"required value="Female">Female<br><input type="radio" name="r1"style="font-size:18pxstyle;height:20px;width:50px;"placeholder="Select Your Gender" required value="Other">Other
                </tr>
            <tr><td><b>
                POA-Id:</b><td> <input type="number"style="font-size:18px;height:35px;width:280px;" placeholder="Enter Your Aadhar number" required name="poa"></td>
            </tr>
			<tr><td><b>
                Donor-Id:</b><td> <input type="number"style="font-size:18px;height:30px;width:280px" placeholder="Enter Donor Aadhar number" required name="don"></td></tr>
            <tr><td><b>
                Email:</b> <td><input type="email" style="font-size:18px;height:35px;width:280px;"placeholder="Enter Your correct Email" required name="email"></td></tr>
                    <tr><td><b>
                        Date of Birth:</b><td> <input type="date"style="font-size:18px;height:38px;width:280px;" placeholder="enter your DOB" required name="dob"></td>
            
            <tr><td><b>
                Location:</b><td ><input type="text" style="font-size:18px;height:35px;width:280px;"placeholder="Enter Your Location" required name="location"></td>
            </tr>
            <tr><td><b>
                Phone Number:</br><td> <input type="number"style="font-size:18px;height:35px;width:280px;" placeholder="Enter Your phone number" required name="phone"></td>
            </tr>
            <tr><td><b>
                Relation with Donar:</b><td> <input type="text" style="font-size:18px;height:35px;width:280px;"placeholder="Relation with Donar" required name="relation"></td>
            </tr>
            <tr><td><b>
                Donor Deathdate:</b><td> <input type="date"style="font-size:18px;height:35px;width:280px;" placeholder="enter donor death date" required name="dead"></td>
            </tr>
            <tr><td align="center" colspan="2"> 
            <button class="button" name="submit">Submit</button>
            <!-- <button class="button">Edit</button> -->
            </td>
            </tr>
            </table>
        </form>
    </div>
	</div>
</body>

</html>