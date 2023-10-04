<?php
require "custserver.php";
check_login();

// Check if customer ID is set in the session
if (!isset($_SESSION['USER']->customer_id)) {
    // Redirect or display an error message if the customer ID is not set
    // header("Location: profilehome.php"); // Replace 'profilehome.php' with your desired URL or error page
    // exit();
}

// Get the customer ID from the session
$customer_id = $_SESSION['USER']->customer_id;

// Get the maid's name and booking status for the current customer
$booking_query = "SELECT m_firstname, status FROM booking WHERE (status = 'Approved' OR status = 'Denied') AND customer_id = :customer_id LIMIT 1";
$booking = database_run($booking_query, ['customer_id' => $customer_id]);

// Check if the booking information is retrieved successfully
if (!$booking) {
    // Redirect or display an error message if the information is not found
    // header("Location: profilehome.php"); // Replace 'profilehome.php' with your desired URL or error page
    // exit();
}

// Get the maid's name and booking status
$maidName = isset($booking[0]->m_firstname) ? $booking[0]->m_firstname : null;
$status = isset($booking[0]->status) ? $booking[0]->status : null;
?>



<!DOCTYPE html>
<html>
<head>
    <title>Booking Notification</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style type="text/css">
        * {
            padding: 0;
            margin: 0;
            text-decoration: none;
            list-style: none;
            box-sizing: border-box;
        }

        body {
            background-color: lightgray;
            padding-top: 80px;
            font-family: Cambria, Cochin, Georgia, Times, 'Times New Roman', serif;
        }

        .navtab {
            display: flex;
        }

        nav {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            background-color: #dedee2;
            z-index: 999;
            /* Add a high z-index value to ensure it appears above other elements */
        }

        /* img{
            width: 100%;
            height: auto;
        } */

        label.logo {
            color: black;
            font-size: 35px;
            line-height: 80px;
            padding: 0 100px;
            font-weight: bold;
        }

        nav ul {
            float: right;
            margin-right: 30px;
        }

        nav ul li {
            display: inline-block;
            line-height: 80px;
            margin: 0 5px;
        }

        nav ul li a {
            color: black;
            font-size: 20px;
            padding: 7px 13px;
            border-radius: 3px;
            text-transform: uppercase;
        }

        nav ul li a:hover {
            color: rgb(240, 240, 240);
        }

        a.active,
        a:hover {
            /* background: gray; */
            transition: .5s;
        }

        .checkbtn {
            font-size: 30px;
            color: black;
            float: right;
            line-height: 80px;
            margin-right: 40px;
            cursor: pointer;
            display: none;
        }

        #check {
            display: none;
        }

        /* for laptop and ipad/tablet black hover for the navigation tab */
        @media (min-width: 768px) {
            nav ul li a:hover {
                color: black;
                background: white;
            }
        }

        @media (max-width: 952px) {
            label.logo {
                font-size: 30px;
                padding-left: 50px;
            }

            nav ul li a {
                font-size: 16px;
            }
        }

        /* For the phone and well basically the ipad/tablet */
        @media (max-width: 768px) {
            .checkbtn {
                display: block;
            }

            ul {
                position: fixed;
                width: 100%;
                height: 100vh;
                background: rgb(180, 177, 177);
                top: 80px;
                left: -100%;
                text-align: center;
                transition: all .5s;
            }

            nav ul li {
                display: block;
                margin: 50px 0;
                line-height: 30px;
            }

            nav ul li a {
                font-size: 20px;
            }

            a:hover {
                color: #fff2d6;
            }

            a.active {
                background: none;
            }

            #check:checked ~ ul {
                left: 0;
            }
        }

        /* section{

        } */

        .wrapper {
            width: 100%;
        }

        @media only screen and (min-width: 768px) {
            .wrapper {
                width: 600px;
                margin: 0 auto;
            }
        }

        @media only screen and (min-width: 1000px) {
            .wrapper {
                width: 1000px;
                margin: 0 auto;
            }

            .logo {
                cursor: pointer;
            }
        }

        /* CSS for the table */
        table {
            border-collapse: collapse;
            width: fit-content;
            margin-top: 20px;
        }

        th,
        td {
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

    </style>
</head>
<body>
    <div class="container">
    <nav>
    <input type="checkbox" id="check">
    <label for="check" class="checkbtn">
       <i class="fa fa-reorder"></i>
    </label>

    <a  href="../home.php"> <label class="logo" >MaidServs</label></a>
       <!-- <img src="logowhite250.png" class="logo"> -->
        <ul>
           <li><a class="active" href="">Home</a></li>
           
           <li><a href="">About</a></li>
           <li><a href="">Contacts</a></li>
           <li><a href="bookhistory.php">booking history</a></li>
           <li><a href="logout.php">Log out</a></li>
       </ul> 
   </nav>
    <div class="content">
        <h1>Booking History</h1>
    <?php
        // Retrieve booking history for the customer
            $booking_history_query = "SELECT * FROM booking WHERE customer_id = ?";
            $booking_history = database_run($booking_history_query, [$customer_id]);

        // Display the booking history
if (!empty($booking_history)) {
    echo "<h2>Booking History</h2>";
    echo "<table>";
    echo "<tr><th>Booking ID</th><th>Maid Name</th><th>Service</th><th>Start Date</th><th>End Date</th><th>Status</th></tr>";
    foreach ($booking_history as $booking) {
        echo "<tr>";
        echo "<td>" . $booking->booking_id . "</td>";
        echo "<td>" . $booking->m_firstname . "</td>";
        echo "<td>" . $booking->service_name . "</td>";
        echo "<td>" . $booking->s_date . "</td>";
        echo "<td>" . $booking->e_date . "</td>";
        echo "<td>" . $booking->status . "</td>";
        echo "</tr>";
        
    }
    echo "</table>";
} else {
    echo "<p>No bookings found.</p>";
}

?>
    </div>
</div></body>
</html>