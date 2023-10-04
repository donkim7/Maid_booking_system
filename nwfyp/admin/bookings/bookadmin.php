<?php
require "../adminserver.php";
check_login();
?>
<!DOCTYPE HTML>
<html>
<head>
    <title>Userprofile</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style type="text/css">
           *{
               padding: 0;
               margin: 0;
               text-decoration: none;
               list-style: none;
               box-sizing: border-box; 
           }
           body{
                background-color: lightgray;
                padding-top: 80px;
                font-family: Cambria, Cochin, Georgia, Times, 'Times New Roman', serif;
            }
            .navtab{
                display: flex; 
                
            }
            nav {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            background-color: #dedee2;
            z-index: 999; /* Add a high z-index value to ensure it appears above other elements */
        }
            /* img{
                width: 100%;
                height: auto;
            } */

            label.logo{
                color: black;
                font-size: 35px;
                line-height: 80px;
                padding: 0 100px;
                font-weight: bold;
            }

            nav ul{
                float: right;
                margin-right: 30px;
            }

            nav ul li{
                display: inline-block;
                line-height: 80px;
                margin: 0 5px;
            }

            nav ul li a{
                color: black;
                font-size: 20px;
                padding: 7px 13px;
                border-radius: 3px;
                text-transform: uppercase;
            }

            /* nav ul li a::after{
                content: '';
                height: 3px;
                width: 0;
                background: black;
                position: absolute;
                left: 0;
                bottom: -10px;
                transition: 0.5s;
            } */

            nav ul li a:hover{
                color: rgb(240, 240, 240);
            }
            a.active, a:hover{

                /* background: gray; */
                transition: .5s;
            }

            .checkbtn{
                font-size: 30px;
                color: black;
                float: right;
                line-height: 80px;
                margin-right: 40px;
                cursor: pointer;
                display: none;
            }

            #check{
                display: none;

            }
            /* for laptop and ipad/tablet black hover for the navigation tab */
            @media (min-width:768px){
                nav ul li a:hover{
                color: black;
                background: white ;
            }

            }
            @media (max-width:952px){
                label.logo{
                    font-size: 30px;
                    padding-left: 50px;
                }
                nav ul li a{
                    font-size: 16px;
                }
               
            }
            /* For the phone and well basically the ipad/tablet */
            @media (max-width:768px){
                .checkbtn{
                    display: block;
                }
                ul{
                    position: fixed;
                    width: 100%;
                    height: 100vh;
                    background: rgb(180, 177, 177);
                    top: 80px;
                    left: -100%;
                    text-align: center;
                    transition: all .5s;
                }
                nav ul li{
                    display: block;
                    margin: 50px 0;
                    line-height: 30px;
                }
                nav ul li a{
                    font-size: 20px;
                }
                a:hover{
                    
                    color: #fff2d6;
                }
                a.active{
                    background: none;
                }
                #check:checked ~ ul{
                    left: 0;

                }
            }
            /* section{

            } */

            .wrapper{
                width: 100%;
            }



            @media only screen and (min-width: 768px){
                .wrapper{
                    width: 600px;
                    margin: 0 auto;
                }

            }

            @media only screen and (min-width: 1000px){
                .wrapper{
                    width: 1000px;
                    margin: 0 auto;
                }


            .logo{

                cursor: pointer;
            }
        }

            /* CSS code for sidebar */
            .sidebar {
            margin: 0;
            padding: 0;
            width: 200px;
            background-color: #0663e0d4;
            position: fixed;
            height: 100%;
            overflow: auto;
            left: 0; /* Add this property to position the sidebar on the left */
        }

        div.content {
            margin-left: 200px;
            padding: 1px 16px;
            height: 1000px;
        }

.sidebar a {
  display: block;
  color: lightgray;
  padding: 16px;
  text-decoration: none;
}
 
.sidebar a.active {
  background-color: #0663e0d4;
  color: white;
}

.sidebar a:hover:not(.active) {
  background-color: #00008b73;
  color: white;
}



@media screen and (max-width: 700px) {
  .sidebar {
    width: 100%;
    height: auto;
    position: relative;
  }
  .sidebar a {float: left;}
  div.content {margin-left: 0;}
}

@media screen and (max-width: 400px) {
  .sidebar a {
    text-align: center;
    float: none;
  }
}



      /* CSS code for the table */
      table {
        border-collapse: collapse;
        width: fit-content;
        margin-top: 20px;
      }

      th, td {
        text-align: left;
        padding: 8px;
      }

      th {
        background-color: #f0d69f;
        color: black;
      }

      tr:nth-child(even) {
        background-color: #f2f2f2;
      }

      tr:hover {
        background-color: #ddd;
      }

        /* Styles for the Edit button */
        .approvebtn {
            background-color: #083c08c4;
            color: white;
            border: none;
            padding: 6px 12px;
            border-radius: 4px;
            text-decoration: none;
        }

        /* Styles for the Delete button */
        .denybtn {
            background-color: orangered;
            color: white;
            border: none;
            padding: 6px 12px;
            border-radius: 4px;
            text-decoration: none;
        }

        .profile-picture {
            display: flex;
            align-items: center;
        }

        .profile-picture img {
            width: 30px;
            height: 30px;
            border-radius: 50%;
            object-fit: cover;
            margin-left: 10px;
        }
    </style>
</head>

<body>
<div class="container">
    <nav>
        <input type="checkbox" id="check">
        <label for="check" class="checkbtn"></label>
        <a href="../home.php">
            <label class="logo">MaidServs</label>
        </a>

        <ul>
            <li><a class="active" href="">Home</a></li>
            <li><a href="">About</a></li>
            <li><a href="">Contacts</a></li>
            <li><a href="logout.php">Log out</a></li>
        </ul>
    </nav>

    <div>
<div class="sidebar">
  <a href="../admin.php">Dashboard</a>
  <a class="../maid/maidadmin.php" href="#news">Maids</a>
  <a href="../customer/custadmin.php">Customers</a>
  <a href="active">Bookings</a>
  <a href="../services/servicesadmin.php">Services</a>

</div>
  
</div>
    <div class="content">
        <h1>Available Booking</h1>
        <table>
            <thead>
            <tr>
                <th>#</th>
                <th>Customer Name</th>
                <th>Has Booked You</th>
                <th>For Service</th>
                <th>From</th>
                <th>To</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            <?php
            $ret = "SELECT * FROM booking WHERE status = status";
            $stmt = database_run($ret);
            $cnt = 1;
            if ($stmt) {
                foreach ($stmt as $row) {
                    ?>
                    <tr>
                        <td><?php echo $cnt; ?></td>
                        <td><?php echo $row->c_firstname; ?></td>
                        <td><?php echo $row->m_firstname; ?></td>
                        <td><?php echo $row->service_name; ?></td>
                        <td><?php echo $row->s_date; ?></td>
                        <td><?php echo $row->e_date; ?></td>
                        <td>
                            <?php if ($row->status == "Pending") : ?>
                                <span class="badge badge-warning"><?php echo $row->status; ?></span>
                            <?php else : ?>
                                <span class="badge badge-success"><?php echo $row->status; ?></span>
                            <?php endif; ?>
                        </td>
                        <td>
                            <a href="aprvbking.php?booking_id=<?php echo $row->booking_id; ?>"
                               class="approvebtn"><i class="fa fa-check"></i> Approve</a>
                            <a href="dltbking.php?booking_id=<?php echo $row->booking_id; ?>"
                               class="denybtn"><i class="fa fa-trash"></i> Deny</a>
                        </td>
                    </tr>
                    <?php
                    $cnt++;
                }
            }
            ?>
            </tbody>
        </table>
    </div>
</div>
</body>

</html>