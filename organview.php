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
        body{
            
        background-image: linear-gradient(rgba(0, 0, 0, 0.4), rgba(0, 0, 0, 0.4)), url(images/donar2.jpg);
        background-size: cover;
        }
        table{
            margin-top: 2%;
       background-color: white;
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
        h1{
            color: #fff;
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
    <center>
        <h1>
       Organ Details
        </h1>
    </center>
    
            <?php
            include 'connection.php';
            
                
                $query="SELECT * FROM organ ";
                $query_run=mysqli_query($conn,$query);
                $total =mysqli_num_rows($query_run);
                
                if($total>0){
                    ?>
                    
            <table border="1"cellspacing="7" width="80%" align="center">
                
            <tr>
                <th width="10%">ORGANNAME</th>
                <th width="10%" >DONORID</th>
                <th width="10%" >DOCTORID</th>
                <th width="10%" >ORGANID</th>
                <th width="10%" >DONATEDDATE</th>
                <!-- <th width="20%">Operations</th> -->
            </tr>
                
            <?php
                while($row=mysqli_fetch_assoc($query_run)){
                    echo "<tr>
                    <td>".$row['ORGANNAME']."</td>
                    <td>".$row['DONORID']."</td>
                    <td>".$row['DOCTORID']."</td>
                    <td>".$row['ORGANID']."</td>
                    <td>".$row['DONATEDDATE']."</td>
                    
                </tr>
                ";
                }
            }
            else{
                echo "<script>alert('No Records Found')</script> ";
                ?>
                <meta http-equiv="refresh" content="0;url=http://localhost/dbmsproject/dash4.php"/>
                <?php
            }
        
            ?>
        </table>
    
</body>
</html>