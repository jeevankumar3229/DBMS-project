<!DOCTYPE html>
<html>

<head>
    <title>About Us</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
    <link rel="stylesheet" type="text/css" href="styles.css">
    <link href="https://fonts.googleapis.com/css2?family=Meow+Script&family=Poppins:wght@400;600;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400&display=swap');

        * {
            margin: 0px;
            padding: 0px;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        .section {
            width: 100%;
            min-height: 100vh;
            background-image: linear-gradient(rgba(0,0,0,0.4),rgba(0,0,0,0.4)),url(images/donar2.jpg);
            background-size: cover;
        }

        .container {
            width: 80%;
            display: block;
            margin: auto;
            padding-top: 100px;
        }

        .content-section {
            float: left;
            width: 55%;
        }

        .image-section {
            float: right;
            width:40%;
        }

        .image-section img {
            width: 500px;
            height: 540px;
            border-radius: 10%;
        }

        .content-section .title {
            text-transform: uppercase;
            font-size: 28px;
            color:#fff
        }

        .content-section .content h3 {
            margin-top: 20px;
            color: #fff;
            font-size: 50px;
        }

        .content-section .content p {
            margin-top: 10px;
            font-family: sans-serif;
            font-size: 24px;
            line-height: 1.5;
            color: #fff;
        }

        .content-section .content .button {
            margin-top: 30px;
        }

        .content-section .content .button a {
            background-color: rgb(110, 226, 241);
            padding: 12px 40px;
            text-decoration: none;
            color: rgb(8, 1, 1);
            font-size: 25px;
            letter-spacing: 1.5px;
        }

        .content-section .content .button a:hover {
            background-color: rgb(0, 255, 255);
            color: #fff;
        }

        .content-section .social {
            margin: 40px 40px;
        }

        .content-section .social i {
            color: #a52a2a;
            font-size: 35px;
            padding: 0px 10px;
            /* float:auto; */
        }

        .content-section .social i:hover {
            color: #fff;
        }
        
        @media screen and (max-width: 768px) {
            .container {
                width: 80%;
                display: block;
                margin: auto;
                padding-top: 50px;
            }

            .content-section {
                float: none;
                width: auto;
                display: block;
                margin: auto;
            }

            .image-section {
                float: none;
                width: 100%;

            }

            
            
            .image-section img {
                width: 100%;
                height: auto;
                display: block;
                margin: auto;
            }

            .content-section .title {
                text-align: center;
                font-size: 19px;
            }

            .content-section .content .button {
                text-align: center;
            }

            .content-section .content .button a {
                padding: 9px 30px;
            }

            .content-section .social {
                text-align: center;
            
            }
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
    
        <div class="section">
            <div class="container">
                <div class="content-section">
                    <div class="title">
                        <h1>About Us</h1>
                    </div>
                    <div class="content">
        
                            <p><b>LIFE DONOR</b> is a online web application which enables the interested donors to apply for donation by themselves without having to go to other organization to register themselves. This online web application is designed for  a specific Hospital that accepts organ so that it can be transplanted to other who need organs . All the data collected are kept confidential and it is seen only by the doctors of that hospital and  hospital staff. This web application is designed so that people can register themselves for organ donation through online without having to come to the hospitals to register themselves.This application is very useful. </p>
                        
                        <!-- <div class="button">
                            <a href="">Home</a>
                        </div> -->
                    </div>
                    <div class="social">
                        <a href=""><i class="fab fa-facebook-f"></i></a>
                        <a href=""><i class="fab fa-twitter"></i></a>
                        <a href=""><i class="fab fa-instagram"></i></a>
                    </div>
                </div>
                <div class="image-section">
                    <img src="images/organ1.jpg">
                </div>
            </div>
        </div>
    

</body>

</html>