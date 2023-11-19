<?php

$firstname = $lastname = $email = $password = $confirm_password = $register=$register1=$color="";
$firstname1 = $lastname1 = $email1 = $password1 = $confirm_password1 =$color= "";


if ($_SERVER['REQUEST_METHOD'] == "POST") {

	include 'connection.php';
	//check for firstname
	if (empty(trim($_POST['firstname']))) {
		$firstname1 = "Password cannot be empty";
	} else {
		$firstname = trim($_POST['firstname']);
	}
	//check for the lastname
	if (empty(trim($_POST['lastname']))) {
		$lastname1 = "Name field cannot be blank";
	} else {
		$lastname = trim($_POST['lastname']);
	}
	//Check if username is empty
	if (empty(trim($_POST["email"]))) {
		$emp_id_err = "Employee id cannot be blank";
	} else {
		$sql = "SELECT EMAIL from register WHERE email = ?";
		$stmt = mysqli_prepare($conn, $sql);
		if ($stmt) {
			mysqli_stmt_bind_param($stmt, "s", $email2);

			//set the value of email
			$email2 = trim($_POST['email']);

			//Try to execute the statement
			if (mysqli_stmt_execute($stmt)) {
				mysqli_stmt_store_result($stmt);

				if (mysqli_stmt_num_rows($stmt) > 0) {
					$email1 = "This is primary key field";
				} else {
					$email = trim($_POST['email']);
				}
			} else {
				echo "Something went wrong";
			}
		
		mysqli_stmt_close($stmt);
    }
	}
	//check for password
	if (empty(trim($_POST['password']))) {
		$password1 = "Password cannot be empty";
	} elseif(strlen(trim($_POST['password'])) < 8)
	{
		$password1="Password cannot be less than 8 character";
	}
	else {
		$password = trim($_POST['password']);
	}
	//check for confirm password 
	if (trim($_POST['confirm_password']) != trim($_POST['password'])) {
		$password1 = "Passwords should match";
	}

	if (empty(trim($_POST['color']))) {
		$color1 = " field cannot be blank";
	} else {
		$color = trim($_POST['color']);
	}



	//if all of then insert
	if (empty($firstname1) && empty($lastname1) && empty($email1) && empty($password1) && empty($confirm_password1) && empty($color1)) {
		$sql = " INSERT INTO register (FIRSTNAME, LASTNAME,EMAIL,COLOR,PASSWORD) VALUES (?, ?,?, ?, ?)";
		$stmt = mysqli_prepare($conn,$sql);
		if($stmt)
		{
			mysqli_stmt_bind_param($stmt, "sssss", $firstname2, $lastname2, $email2,$color2, $password2);


			//set these param parameters
			$firstname2=$firstname;
			$lastname2=$lastname;
			$email2=$email;
      $color2=$color;
			$password2=$password;
			
			mysqli_stmt_execute($stmt);
			echo "<script>alert(' Successfully Registered')</script>";
    ?>
    <meta http-equiv="refresh" content="0;url=http://localhost/dbmsproject/login.php"/>
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
      
	}
	else
	{
    echo "<script>alert('Error Occured, either password  and confirm password is not same or Email already Registered')</script>";
	}
	mysqli_close($conn);
}

?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Register Form</title>
    <!-- <link rel="stylesheet" href="style.css"> -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        *{
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: "Poppins", sans-serif;
          }
          body{
            margin: 0;
            padding: 0;
            background-image: linear-gradient(rgba(0,0,0,0.4),rgba(0,0,0,0.4)),url(images/donar2.jpg);
            height: 100vh;
            overflow: hidden;
            /* background:url('images/organ6.jpg'); */
            background-size: cover;
          }
          .center{
            position: absolute;
            top: 55%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 450px;
            height: 666.5px;
            background: white;
            border-radius: 10px;
            box-shadow: 10px 10px 15px rgba(0,0,0,0.05);
          }
          .center h1{
            text-align: center;
            padding: 45px 0;
            border-bottom: 1px solid silver;
          }
          .center form{
            padding: 0 40px;
            box-sizing: border-box;
          }
          form .txt_field{
            position: relative;
            border-bottom: 2px solid #adadad;
            margin: 30px 0;
          }
          .txt_field input{
            width: 100%;
            padding: 0 5px;
            height: 40px;
            font-size: 16px;
            border: none;
            background: none;
            outline: none;
            border-bottom: 1px solid silver; 
            margin:10px 0;
          }
          .txt_field label{
            position: absolute;
            top: 50%;
            left: 5px;
            color: #adadad;
            transform: translateY(-50%);
            font-size: 16px;
            pointer-events: none;
            transition: .5s;
          }
          .txt_field span::before{
            content: '';
            position: absolute;
            top: 40px;
            left: 0;
            width: 0%;
            height: 2px;
            background: #2691d9;
            transition: .5s;
          }
          .txt_field input:focus ~ label,
          .txt_field input:valid ~ label{
            top: -5px;
            color: #2691d9;
          }
          .txt_field input:focus ~ span::before,
          .txt_field input:valid ~ span::before{
            width: 100%;
          }
          .pass{
            margin: -5px 0 20px 5px;
            color: #a6a6a6;
            cursor: pointer;
          }
          .pass:hover{
            text-decoration: underline;
          }
          input[type="submit"]{
            width: 100%;
            height: 50px;
            border: 1px solid;
            background: #2691d9;
            border-radius: 25px;
            font-size: 18px;
            color: #e9f4fb;
            font-weight: 700;
            cursor: pointer;
            outline: none;
          }
          input[type="submit"]:hover{
            border-color: #2691d9;
            transition: .5s;
          }
          .login_link{
            margin: 30px 0;
            text-align: center;
            font-size: 16px;
            color: #666666;
            /* border-bottom: none; */
          }
          .login_link a{
            color: #2691d9;
            text-decoration: none;
          }
          .login_link a:hover{
            text-decoration: underline;
          }
          .navbar {
            position: fixed;
            height: 80px;
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
            padding: 6px 13px;
            text-decoration: none;
            transition: .4s;
        }
        .navbar .fa{
            margin-right: 7px;
        }
        .avatar{
            width: 100px;
            height: 100px;
            border-radius: 58%;
            position: absolute;
            top:-50px;
            left:167px

        }
		.p{
			font-size: 23px;
			text-align: center;
		}
          </style>
    
  </head>
  <body>
	  
<div class="p">
  <?php   echo $register;?>
</div>
    <div>
      <nav class="navbar">
          <ul>
              <li><a href="login.php"><i class="fa fa-backward" aria-hidden="true"></i><b>Back</b></a></li>
          </ul>
      </nav>
  </div>
    <div class="center">
      <h1>Register</h1>
      <img src="images/register.png" class="avatar">
      <form action="register.php"method="post">
        <div class="txt_field">
            <form id='register' class='input-group-register'>
                <input type='text'class='input-field'placeholder='First Name' required name="firstname">
                <input type='text'class='input-field'placeholder='Last Name ' required name="lastname">
                <input type='email'class='input-field'placeholder='Email Id' required name="email">
                <input type='text' class='input-field'placeholder='Enter your favorite color' required name="color">
                <input type='password'class='input-field'placeholder='Enter min. 8 digit password (eg:abcd_d123)'pattern="\w\w\w\w\w\w\w\w+" required name="password">
                <input type='password'class='input-field'placeholder='Confirm Password' pattern="\w\w\w\w\w\w\w\w+"  required name="confirm_password">
        <input type="submit" value="Register" >
		
        <div class="login_link">
          Already a member? <a href="login.php">Login</a>
        </div>
      </form>
    </div>

  </body>
</html>

