<?php
include 'connection.php';
if(isset($_POST["submit"]))
{
  $email=$_POST['email'];
  $color=$_POST['color'];
  $password=$_POST['password'];
  $query="SELECT * FROM register1 where EMAIL='$email'AND COLOR='$color'";
  $data=mysqli_query($conn,$query);
  $d1=mysqli_num_rows($data);
  if($d1==1)
   {
     $query1="UPDATE register1 SET PASSWORD='$password'WHERE EMAIL='$email'";
     $data1=mysqli_query($conn,$query1);
     if($data1)
     {
       echo "<script>alert('Successfully Password is Updated')</script>";
       ?>
       <meta http-equiv="refresh" content="0;url=http://localhost/dbmsproject/login1.php"/>
       <?php
     }
   }
   else{
    echo "<script>alert('Invalid Email or Color')</script>";
   }
}
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Forgot Password</title>
    <link rel="stylesheet" href="styles.css">
    <link href="https://fonts.googleapis.com/css2?family=Meow+Script&family=Poppins:wght@400;600;800&display=swap" rel="stylesheet">
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
      background-size:cover ;
  }

  .center{
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    width: 410px;
    height: 460px;
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
  .signup_link a:hover{
    text-decoration: underline;
  }
  .avatar{
            width: 100px;
            height: 100px;
            border-radius: 58%;
            position: absolute;
            top:-50px;
            left:153px

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
                <li><a href="login.php"><i class="fa fa-backward" aria-hidden="true"></i><b>Back</b></a></li>
            </ul>
        </nav>
    </div>
    <div class="center">
      <h1>Forgot Password</h1>
      <img src="images/login2.jpg" class="avatar">
      <form method="post">
        <div class="txt_field">
          <input type="email" required name="email" placeholder="Enter Email">
          <span></span>
          <!-- <label>Enter Email</label> -->
        </div>
        <div class="txt_field">
        <input type='text' placeholder='Enter your favorite color' required name="color">
        <span></span>
        </div>
        <div class="txt_field">
            <input type="text" required name="password"pattern="\w\w\w\w\w\w\w\w+" placeholder="Enter minimum 8-digit new password">
            <span></span>
            <!-- <label>Enter minimum 8-digit new password</label> -->
      </div>
        <input type="submit" value="Login" name="submit">
        </div>
      </form>
    </div>

  </body>
</html>













