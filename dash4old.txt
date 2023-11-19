<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>sidebar dashboard Templates</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: "Roboto", sans-serif;
            background-image: linear-gradient(rgba(0, 0, 0, 0.4), rgba(0, 0, 0, 0.4)), url(images/donar2.jpg);
            overflow: hidden;
            background-size: cover;
        }

        header {
            position: fixed;
            background: rgba(158, 200, 228, 0.568);
            padding: 20px;
            width: 100%;
            height: 30px;

        }

        .leftarea h3 {
            color: #fff;
            margin: 0;
            text-transform: uppercase;
            font-size: 27px;
            font-weight: 900;
        }

        .leftarea spam {
            color: #1DC4E7;

        }

        .logout_btn {
            padding: 5px;
            background:rgb(100, 201, 248);
            text-decoration: none;
            float: right;
            margin-top: -40px;
            margin-right: 40px;
            border-radius: 2px;
            font-size: 20px;
            font-weight: 600;
            color: #fff;
            transition: 0.5s;
            transition-property: background;
        }

        .logout_btn:hover {
            background: #0D9DBB;


        }

        .sidebar {
            background:rgba(158, 200, 228, 0.568);
            margin-top: 70px;
            padding-top: 30px;
            position: fixed;
            left: 0;
            width: 280px;
            height: 100%;
            transition: 0.5s;
            transition-property: left;
        }

        .sidebar .profilephoto {
            width: 90px;
            height: 100px;
            border-radius: 100px;
            margin-bottom: 10px;
            padding-right: 10px;
        }

        .sidebar h4 {
            color: #fff;
            margin-top: 0;
            margin-bottom: 20px;

        }

        .sidebar a {
            color: #fff;
            display: block;
            width: 100%;
            line-height: 20px;
            text-decoration: none;
            padding-left: 0px;
            box-sizing: border-box;
            transition: 0.5s;
            transition-property: background;
        }

        .sidebar a:hover {
            background: #19B3D3;

        }

        .sidebar i {
            padding-right: 40px;
            

        }

        label #sidebar_btn {
            z-index: 1;
            color:#fff ;
            position: fixed;
            cursor: pointer;
            left: 300px;
            font-size: 20px;
            margin: 5px 0;
            transition: 0.5s;
            transition-property: color;
        }

        label #sidebar_btn:hover {
            color: #19B3D3;

        }

        #check:checked~.sidebar {
            left: -190px;

        }

        #check:checked~.sidebar a span {
            display: none;
        }

        #check:checked~.sidebar i {
            font-size: 20px;
            margin-left: 170px;
            width: 80px;
        }

        .content {
            margin-left: 250px;
            background: linear-gradient(rgba(0, 0, 0, 0.4), rgba(0, 0, 0, 0.4)), url(images/donar2.jpg) no-repeat;
            background-position: center;
            background-size: cover;
            height: 100vh;
            transition: 0.5s;
        }

        #check:checked~.content {
            margin-left: 60px;
        }

        #check {
            display: none;
        }
        nav{
            width: 280px;
            position: absolute;
            /* top: 0; */
            /* bottom: 0; */
            /* background: rgba(0,0, 0, 0.1); */
            border-radius: 10px;
            box-shadow: 5px 7px 10px rgba(0,0,0,0.1);
            margin-left: 0px;
        }
        nav ul{
            position: relative;
            list-style-type: none;
        }
        nav ul li a{
            display: flex;
            align-items: center;
            font-family: arial;
            font-size: 1.15em;
            text-decoration: none;
            text-transform: capitalize;
            color: rgba(158, 200, 228, 0.568);
            padding: 30px 30px;
            height: 60px;
            transition: 1s ease;
            border-radius: 0 30px;
        }
        nav ul li a:hover{
            background: rgb(100,200,248);
            color:#fff;
        }
        nav ul ul{
            position: absolute;
            left: 236px;
            width: 250px;
            top:0;
            display: none;
            background: rgba(158, 200, 228, 0.568);
                       border-radius: 5px;
            box-shadow: 2px 2px 10px rgba(0,0,0,1);
        }
        nav ul .dropdown{
            position: relative;

        }
        nav ul .dropdown:hover ul{
            display: initial;

        }
        nav ul  span{
            position: absolute;
            right: 20px;
            font-size: 1.5em;

        }
        .sidebar nav ul li .dropdown .fab{
            margin-left: 60px;
        }
        .rightarea .logout_btn .fa{
            margin-right: 7px;
        }
    </style>
</head>

<body>
    <input type="checkbox" id="check">
    <header>
        <label for="check">
            <i class="fas fa-bars" id="sidebar_btn"></i>
        </label>
        <div class="leftarea">
            <h3>Life<span>Donar</span></h3>
        </div>
        <!-- <div class="rightarea"> -->
            <!-- <a href="#" class="logout_btn"><i class="fas fa-sign-out-alt"></i>Logout</a> -->
        </div>
    </header>
    <div class="sidebar">
        <center>
            <img src="images/donar3.jpg" class="profilephoto" alt="">
            <h4>
                <?php
                echo $_SESSION['email'];
                ?>
            </h4>
        </center>
        <nav>
            <ul>
                <li class="dropdown"><a href="#"><i class="fab fa-wpforms" id="sidebar_btn"></i>Add  Details<span>&rsaquo;</span></a>
                <ul>
                    <li><a href="doctor1.php"><i class="fas fa-user-alt" id="sidebar_btn"></i>Doctor</a></li>
                    <li><a href="organ1.php"><i class="fas fa-user-alt" id="sidebar_btn"></i>Organ</a></li>
                </ul>
                </li>
                <li class="dropdown"><a href="#"><i class="fab fa-wpforms" id="sidebar_btn"></i>Update Details <span>&rsaquo;</span></a>
                <ul>
                    <li><a href="doctordata.php"><i class="fas fa-user-alt" id="sidebar_btn"></i>Doctor</a></li>
                    <li><a href="organdata.php"><i class="fas fa-user-alt" id="sidebar_btn"></i>Organ</a></li>
                </ul>
                </li>
                <li class="dropdown"><a href="#"><i class="fas fa-eye"></i>View Details<span>&rsaquo;</span></a>
                    <ul>
                        <li><a href="doctorview.php"><i class="fas fa-user-alt" id="sidebar_btn"></i>Doctor</a></li>
                        <li><a href="organview.php"><i class="fas fa-user-alt" id="sidebar_btn"></i>Organ</a></li>
                        <li><a href="donorview.php"><i class="fas fa-user-alt" id="sidebar_btn"></i>Donor</a></li>
                        <li><a href="poaview.php"><i class="fas fa-user-alt" id="sidebar_btn"></i>Power Of Attorney</a></li>
                    </ul>
                    </li>
                <br>
                <br><br><br><br><br><br>
                <br><br><br><br><br>
                <!-- <br><br><br> -->
                <li class="Dropdown">
                    <a href="logout.php" ><i class="fas fa-sign-out-alt"></i>Logout</a>
                </li>
            </ul>
            
        </nav>
    </div>
    <div class="content">

    </div>
</body>

</html>