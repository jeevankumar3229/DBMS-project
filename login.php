<?php
$Res="";
session_start();

include "connection.php";

if(isset($_POST['submit'])){
    $email=$_POST['email'];
    $password=$_POST['password'];

    $emailsearch="SELECT * FROM register where EMAIL='$email'";
    $query=mysqli_query($conn,$emailsearch);

    $emailcount=mysqli_num_rows($query);
    if($emailcount>0){
        $emailpassword=mysqli_fetch_assoc($query);
        $db_pass1=$emailpassword['PASSWORD'];
        $_SESSION['email']=$emailpassword['EMAIL'];
        if($db_pass1==$password){
           echo "<script>alert('Successfully logged in')</script>";
           ?>
           <meta http-equiv="refresh" content="0;url=http://localhost/dbmsproject/dash3.php"/>
           <?php
        }
        else{
            echo "<script>alert('login Failed')</script>";
        }
    }
    else{
        $Res="Invalid Email";
    }
}
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <title>Login Form</title>
    <!-- <link rel="stylesheet" href="style.css"> -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: "Poppins", sans-serif;
        }

        body {
            margin: 0;
            padding: 0;
            background-image: linear-gradient(rgba(0, 0, 0, 0.4), rgba(0, 0, 0, 0.4)), url(images/donar2.jpg);
            height: 100vh;
            overflow: hidden;
            /* background:url('images/organ4.jpg'); */
            background-size: cover;
        }

        .center {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 400px;
            background: white;
            border-radius: 10px;
            box-shadow: 10px 10px 15px rgba(0, 0, 0, 0.05);
        }

        .center h1 {
            text-align: center;
            padding: 45px 0;
            border-bottom: 1px solid silver;
        }

        .center form {
            padding: 0 40px;
            box-sizing: border-box;
        }

        form .txt_field {
            position: relative;
            border-bottom: 2px solid #adadad;
            margin: 30px 0;
        }

        .txt_field input {
            width: 100%;
            padding: 0 5px;
            height: 40px;
            font-size: 16px;
            border: none;
            background: none;
            outline: none;
        }

        .txt_field label {
            position: absolute;
            top: 50%;
            left: 5px;
            color: #adadad;
            transform: translateY(-50%);
            font-size: 16px;
            pointer-events: none;
            transition: .5s;
        }

        .txt_field span::before {
            content: '';
            position: absolute;
            top: 40px;
            left: 0;
            width: 0%;
            height: 2px;
            background: #2691d9;
            transition: .5s;
        }

        .txt_field input:focus~label,
        .txt_field input:valid~label {
            top: -5px;
            color: #2691d9;
        }

        .txt_field input:focus~span::before,
        .txt_field input:valid~span::before {
            width: 100%;
        }

        .pass {
            margin: -5px 0 20px 5px;
            color: #a6a6a6;
            cursor: pointer;
        }

        .pass:hover {
            text-decoration: underline;
        }

        input[type="submit"] {
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

        input[type="submit"]:hover {
            border-color: #2691d9;
            transition: .5s;
        }

        .signup_link {
            margin: 30px 0;
            text-align: center;
            font-size: 16px;
            color: #666666;
        }

        .signup_link a {
            color: #2691d9;
            text-decoration: none;
        }

        .signup_link a:hover {
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
            left:149px

        }
        .p{
            
			font-size: 25px;
			text-align: center;
		}
    </style>
</head>

<body>
    <div class="p">
        <?php
        echo $Res;
        ?>
    </div>
    <div>
        <nav class="navbar">
            <ul>
                <li><a href="home.php"><i class="fa fa-backward" aria-hidden="true"></i><b>Back</b></a></li>
            </ul>
        </nav>
    </div>
    <div class="center">
        <h1>Login</h1>
        <img src="images/login2.jpg" class="avatar">
        <form action=""method="post">
            <div class="txt_field">
                <input type="email" name="email" required>
                <span></span>
                <label>Email</label>
            </div>
            <div class="txt_field">
                <input type="password" required name="password">
                <span></span>
                <label>Password</label>
            </div>
            <div class="pass"><a href="forgotpassword.php">Forgot Password?</a></div>
            <input type="submit" name="submit" value="Login">
            <div class="signup_link">
                Not a member? <a href="register.php">Register</a>
            </div>
        </form>
    </div>

</body>

</html>