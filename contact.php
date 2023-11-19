<?php
include 'connection.php';
if(isset($_POST['send']))
{
    $name=$_POST['name'];
    $phone=$_POST['phone'];
    $email=$_POST['email'];
    $subject=$_POST['subject'];
    $message=$_POST['message'];
    $query="INSERT INTO `contact`(`NAME`, `PHONE`, `EMAIL`, `SUBJECT`, `MESSAGE`) VALUES('$name','$phone','$email','$subject','$message')";
    $query1=mysqli_query($conn,$query);
    if($query1)
    {
        echo "<script>alert('Successfully Sent')</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact us</title>
    <link href="https://fonts.googleapis.com/css2?family=Meow+Script&family=Poppins:wght@400;600;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        *{
            margin: 0;
            padding: 0;
        }
        body{
            /* background: url('images/organ4.jpg'); */
            background-size: cover;
            font-size: 15px;
            font-family:'Poppins', sans-serif; 
            background-image: linear-gradient(rgba(0,0,0,0.4),rgba(0,0,0,0.4)),url(images/donar2.jpg);
        }
        .container{
            width: 80%;
            margin:50px auto;
        }
        .contact-box{
            background:white;
            display: flex;

        }
        .contact-left{
            flex-basis: 60%;
            padding: 40px 60px;
        }
        .contact-right{
            flex-basis: 40%;
            padding: 40px;
            background:rgba(158, 200, 228, 0.568);
            color: rgb(12, 1, 1);
        }
        h1{
            margin-bottom: 10px;
            color:#fff;
        }
        .container p{
            margin-bottom: 40px;
            color: #fff;
        }
        .input-row{
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
        }
        .input-row .input-group{
            flex-basis: 45%;
        }
        input{
            width: 100%;
            border: none;
            border-bottom: 1px solid #ccc;
            outline: none;
            padding-bottom: 5px;
        }
        textarea{
            width: 100%;
            border: 1px solid #ccc;
            outline: none;
            padding: 10px;
            box-sizing: border-box;
        }
        label{
            margin-bottom: 6px;
            display: block;
            color:grey;
        }
        input[type='submit']{
            background:rgba(158, 200, 228, 0.568);
            width: 100px;
            border: none;
            outline: none;
            color: rgb(10, 3, 3);
            height: 35px;
            border-radius: 30px;
            margin-top: 20px;
            box-shadow: 0px 5px 15px 0px rgba(28,0,183,0.3);
        }
        .contact-left h3{
            color: rgb(128, 128, 128);
            font-weight: 600;
            margin-bottom: 30px;

        }
        .contact-left h3{
        
            font-weight: 600;
            margin-bottom: 30px;
            
        }
        tr td:first-child{
            padding-right: 20px;
        }
        tr td{
            padding-top: 28px;
        }
        .navbar .fa{
            margin-right:  7px;
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
    </style>
</head>
<body>
    <div>
        <nav class="navbar">
            <ul>
                <li><a href="home.php"><i class="fa fa-backward" aria-hidden="true"></i><b>Back</b></a></li>
            </ul>
        </nav>
    </div>
    <div class="container">
        <h1>Connect With Us</h1>
        <p>We would love to respond to your queries and help you succeed.<br>Feel free to get in touch with us.</p>
        <div class="contact-box">
            <div class="contact-left">
                <h3>Send Your Request</h3>
                <form action="" method="POST">
                    <div class="input-row">
                        <div class="input-group">
                            <label >Name</label>
                            <input type="text" placeholder="Enter Your Name" required name="name">
                        </div>
                        <div class="input-group">
                            <label >Phone</label>
                            <input type="phone" placeholder="Enter Phone Number" required name="phone">
                        </div>
                    </div>
                    <div class="input-row">
                        <div class="input-group">
                            <label >Email</label>
                            <input type="email" placeholder="Enter Your Email" required name="email">
                        </div>
                        <div class="input-group">
                            <label >Subject</label>
                            <input type="text" placeholder="Enter Subject" required name="subject">
                        </div>
                    </div>
                    <label >Message</label>
                    <textarea  rows="5" placeholder="Your Message" required name="message"></textarea>
                    <input type="submit" name="send" value="SEND">
                </form>
            </div>
            <div class="contact-right">
                <h3>Reach Us</h3>
                <table>
                    <tr>
                        <td><i class="fa fa-envelope" aria-hidden="true"></i>Email</td>
                        <td>jeeevan@gmail.com</td>
                    </tr>
                    <tr>
                        <td><i class="fa fa-phone" aria-hidden="true"></i>Phone</td>
                        <td>+91-3636367800</td>
                    </tr>
                    <tr>
                        <td><i class="fa fa-map-marker" aria-hidden="true"></i>Address</td>
                        <td>#212,Ground floor,7th cross<br>
                         Super layout, Super Road ,<br>Bangalore-568001</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</body>
</html>