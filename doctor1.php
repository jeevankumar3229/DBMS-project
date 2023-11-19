<?php

$fname = $lname = $r1 = $doctorId = $dob = $email  = $location = $phone=$specialization = $e1 = $f1 = $l1 = $register = "";
$fname1 = $lname1 = $r11 = $doctorId1 = $dob1 = $email1 = $location1 = $phone1 = $specialization1 = "";
$emailpassword = "";
// include 'connection.php';
if ($_SERVER['REQUEST_METHOD'] == "POST") {
	include 'connection.php';
	$email = $_POST['email'];
	$emailsearch = "SELECT * FROM register1 where EMAIL='$email'";
	$query = mysqli_query($conn, $emailsearch);
	$emailcount = mysqli_num_rows($query);
	// $emailpassword=mysqli_fetch_assoc($query);
	if ($emailcount > 0) {
		$emailpassword = mysqli_fetch_assoc($query);
		if (empty($email)) {
			$email1 = "Email cannot be empty";
		} else {
			if ($emailpassword['EMAIL'] == $email) {
				$e1 = $email;
			} else {
				$email1 = "Invalid Email";
			}
		}
		//check for firstname
		if (empty(($_POST['fname']))) {
			$fname1 = "fname cannot be empty";
		}
		$fname = ($_POST['fname']);
		if ($emailpassword['FIRSTNAME'] == $fname) {
			$f1 = $fname;
		} else {
			$fname1 = "Invalid Firstname";
		}
		//check for the lastname
		if (empty(($_POST['lname']))) {
			$lname1 = " LastName field cannot be blank";
		}
		$lname = ($_POST['lname']);
		if ($emailpassword['LASTNAME'] == $lname) {
			$l1 = $lname;
		} else {
			$lname1 = "Invalid Firstname";
		}
		if (empty(($_POST['r1']))) {
			$r11 = "gender cannot be empty";
		} else {
			$r1 = ($_POST['r1']);
		}
		//Check if username is empty
		if (empty(($_POST["doctorId"]))) {
			$donorId = "DoctorId cannot be blank";
		} else {
			$sql = "SELECT * from doctor WHERE DOCTORID = ?";
			$stmt = mysqli_prepare($conn, $sql);
			if ($stmt) {
				mysqli_stmt_bind_param($stmt, "s", $doctorId2);

				//set the value of email
				$doctorId2 = trim($_POST['doctorId']);

				//Try to execute the statement
				if (mysqli_stmt_execute($stmt)) {
					mysqli_stmt_store_result($stmt);

					if (mysqli_stmt_num_rows($stmt) > 0) {
						$doctorId1 = "This is primary key field";
					} else {
						$doctorId = ($_POST['doctorId']);
					}
				} else {
					echo "Something went wrong";
				}
			}
			mysqli_stmt_close($stmt);
		}
		if (empty(($_POST['dob']))) {
			$dob1 = "Password cannot be empty";
		} else {
			$dob = ($_POST['dob']);
		}

		//check for password
		if (empty(($_POST['phone']))) {
			$phone1 = "Password cannot be empty";
		} else {
			$phone = ($_POST['phone']);
		}


		if (empty(($_POST['location']))) {
			$location1 = "gender cannot be empty";
		} else {
			$location = ($_POST['location']);
		}
		if (empty(($_POST['specialization']))) {
			$specialization1 = "gender cannot be empty";
		} else {
			$specialization = ($_POST['specialization']);
		}

		// mysqli_stmt_close($stmt);





		//if all of then insert
		if (empty($fname1) && empty($lname1) && empty($r11) && empty($doctorId1) && empty($dob1) && empty($email1) && empty($location1) && empty($phone1) && empty($specialization1)) {
			$sql = " INSERT INTO `doctor`(`FIRSTNAME`, `LASTNAME`, `GENDER`, `DOCTORID`, `DOB`, `EMAIL`, `LOCATION`, `PHONE`, `SPECIALIZATION`)VALUES ('$f1','$l1','$r1','$doctorId','$dob','$e1','$location','$phone','$specialization')";
			$stmt = mysqli_prepare($conn, $sql);

			mysqli_stmt_execute($stmt);
			echo "<script>alert('Successfully Details Are Added...')</script>";
			?>
			<meta http-equiv="refresh" content="0;url=http://localhost/dbmsproject/dash4.php"/>
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
			echo "<script>alert('Either Doctor-Id Already Exists or Names did not match as when registered')</script>";
		}
	} else {
		echo "<script>alert('Error Occurred,Invalid Email-Id')</script>";
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
	<title>Doc detail</title>
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
                 top: 56%;
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
                <li><a href="dash4.php"><i class="fa fa-backward" aria-hidden="true"></i><b>Back</b></a></li>
            </ul>
        </nav>
    </div>
	<div class="center">
	<h1> Enter Doctor Details</h1>
	
	<form action="" method="POST">
		<table border="0" align="center" cellspacing="15">
			<br>
			<tr>
				<td><b> First Name:</b>
				<td><input type="text" style="font-size:18px;height:30px;width:280px" placeholder="Enter Your Name" required name="fname"></td>
			</tr>
			<tr>
				<td><b> Last Name:</b>
				<td><input type="text" style="font-size:18px;height:30px;width:280px" placeholder="Enter Your Name"required name="lname"></td>
			</tr>
			<tr>
				<td><b>
						Gender:</b>
				<td><input type="radio" name="r1" style="font-size:18px;height:20px;width:50px" placeholder="Select Your Gender" required value="Male">Male<br><input type="radio" name="r1" style="font-size:18px;height:20px;width:50px" placeholder="Select Your Gender" required value="Female">Female<br><input type="radio" style="font-size:18px;height:20px;width:50px" name="r1" placeholder="Select Your Gender" required value="Other">Other
			</tr>
			<tr>
				<td><b>
						Doctor-Id:</b>
				<td> <input type="number" style="font-size:18px;height:30px;width:280px" placeholder="Enter Your Aadhar number"  required name="doctorId"></td>
			</tr>
			<tr>
				<td><b>
						Date of Birth:</b>
				<td> <input type="date" style="font-size:18px;height:38px;width:280px;" placeholder="enter your DOB" name="dob" required></td>
			<tr>
				<td><b>
						Email:</b>
				<td><input type="email" style="font-size:18px;height:30px;width:280px" placeholder="Enter Your correct Email" name="email" required></td>
			</tr>


			<tr>
				<td><b>

						Location:</b>
				<td><input type="text" style="font-size:18px;height:30px;width:280px" placeholder="Enter Your Location" name="location" required></td>
			</tr>
			<tr>
				<td><b>
						Phone Number:</br>
				<td> <input type="number" style="font-size:18px;height:30px;width:280px" placeholder="Enter Your phone number" name="phone" required></td>
			</tr>
			<tr>
				<td><b>
						Specialization:</b>
				<td> <input type="text" style="font-size:18px;height:30px;width:280px" placeholder="Enter Your Specialization" name="specialization" required></td>
			</tr>

			<tr>
				<td align="center" colspan="2">
					<button class="button" name="submit" >Submit</button>
					<!-- <button class="button">Edit</button> -->
				</td>
			</tr>
		</table>
	</form>
	</div>
</body>

</html>