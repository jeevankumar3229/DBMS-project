<?php

$oname = $did = $dod = $od = $ddate=$register =$d1= $d2="";
$oname1 = $did1 = $dod1 = $od1 = $ddate1  = "";
$did2 = "";

// include 'connection.php';
if ($_SERVER['REQUEST_METHOD'] == "POST") {
	include 'connection.php';
	$did = $_POST['did'];
	$emailsearch = "SELECT * FROM donor where DONORID='$did'";
	$query = mysqli_query($conn, $emailsearch);
	$didcount = mysqli_num_rows($query);
    
	// $emailpassword=mysqli_fetch_assoc($query);
	if ($didcount > 0) {
		$did2 = mysqli_fetch_assoc($query);
    if (empty($did)) {
        $did1 = "Email cannot be empty";
    } else {
        if ($did2['DONORID'] == $did) {
            $d1 = $did;
        } else {
            $did1 = "Invalid donarid";
        }
    }
    $dod = $_POST['dod'];
    $dodsearch="SELECT * FROM doctor where DOCTORID='$dod'";
    $query1= mysqli_query($conn, $dodsearch);
	$dodcount = mysqli_num_rows($query1);
    if ($dodcount > 0) {
		// $did2 = mysqli_fetch_assoc($query);
		$dod2 = mysqli_fetch_assoc($query1);
		if (empty($dod)) {
			$dod1 = "Email cannot be empty";
		} else {
			if ($dod2['DOCTORID'] == $dod) {
				$d2 = $dod;
			} else {
				$dod1 = "Invalid doctorid";
			}
		}
    
	if (empty(($_POST['oname']))) {
			$oname1 = "gender cannot be empty";
		} else {
			$oname = ($_POST['oname']);
		}
		//Check if username is empty
		if (empty(($_POST["od"]))) {
			$od1 = "DoctorId cannot be blank";
		} else {
			$sql = "SELECT * from organ WHERE ORGANID = ?";
			$stmt = mysqli_prepare($conn, $sql);
			if ($stmt) {
				mysqli_stmt_bind_param($stmt, "s", $od2);

				//set the value of email
				$od2 = trim($_POST['od']);

				//Try to execute the statement
				if (mysqli_stmt_execute($stmt)) {
					mysqli_stmt_store_result($stmt);

					if (mysqli_stmt_num_rows($stmt) > 0) {
						$od1 = "This is primary key field";
					} else {
						$od = ($_POST['od']);
					}
				} else {
					echo "Something went wrong";
				}
			
			mysqli_stmt_close($stmt);
            }
		}
		if (empty(($_POST['ddate']))) {
			$ddate1 = "Password cannot be empty";
		} else {
			$ddate = ($_POST['ddate']);
		}
    //if all of then insert
		if (empty($did1) && empty($dod1) && empty($od1) && empty($oname1) && empty($ddate1)) {
			$sql = " INSERT INTO `organ`(`ORGANNAME`, `DONORID`, `DOCTORID`, `ORGANID`, `DONATEDDATE`)VALUES ('$oname','$did','$dod','$od','$ddate')";
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
		}
        else
            {
                echo "<script>alert(' Organ-Id Already Exists.')</script>";
            }
    }
	else{
        echo "<script>alert('Invalid Doctor-Id')</script>";
    }
} 
 else {
    echo "<script>alert('Invalid Donor-Id')</script>";
	}
	// mysqli_close($conn);
	mysqli_close($conn);
}

?>
<!DOCTYPE html>
<html lang="en">

<!-- l="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"> -->

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
                 top: 50%;
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
    <h1>Enter Organ Details</h1>
    <div class="p">
        <?php   echo $register;?>
      </div>
    <form action="" method="POST">
        <table border="0" align="center" cellspacing="15">
            <br>
            <tr>
                <td><b> Organ-Name:</b>
                <td><input type="text" style="font-size:18px;height:30px;width:280px;;" placeholder="Enter Organ Name"
                        required name="oname"></td>
            </tr>

            <tr>
                <td><b>
                        Donar-Id:</b>
                <td> <input type="number" style="font-size:18px;height:30px;width:280px;" placeholder="Enter Donar-Id"
                        required name="did"></td>
            </tr>

            <tr>
                <td><b>
                        Doctor-Id:</b>
                <td><input type="number" style="font-size:18px;height:30px;width:280px;" placeholder="Enter Doctor-Id"
                        required name="dod"></td>
            </tr>
            <tr>
                <td><b>
                        Organ-Id:</b>
                <td><input type="number" style="font-size:18px;height:30px;width:280px;" placeholder="Enter Organ-Id"
                        required name="od"></td>
            </tr>



            <tr>
                <td><b>
                        Donated-date:</b>
                <td> <input type="date" style="font-size:18px;height:30px;width:280px;" placeholder="Enter Donated Date"
                        required name="ddate"></td>
            </tr>

            <tr>
                <td align="center" colspan="2">
                    <button class="button" name="submit">Submit</button>

                </td>
            </tr>
        </table>
    </form>
    </div>
</body>

</html>