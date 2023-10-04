<?php

// Check if the user is logged in as a customer
// Check if a maid and customer ID are provided
if (isset($_GET['customer_id']) && isset($_GET['maid_id'])) {
    $customer_id = $_GET['customer_id'];
    $maid_id = $_GET['maid_id'];
  } else {
    // Redirect to a page where the maid and customer IDs are selected
    header("Location: profilehome.php");
    exit();
  }

// Include the database connection function
include 'custserver.php';

// Get the customer ID from the session
$customer_id = $_SESSION['USER']->customer_id;

// Get the maid ID from the URL parameter
if (isset($_GET['maid_id'])) {
    $maid_id = $_GET['maid_id'];
} else {
    // Redirect or display an error message if the maid ID is not provided
    header("Location: profilehome.php"); // Replace 'error.php' with your error page URL
    exit();
}

// Get customer and maid information
$customer_query = "SELECT c_firstname FROM customer WHERE customer_id = ?";
$maid_query = "SELECT m_firstname, service_id, service_name FROM maid WHERE maid_id = ?";

$customer = database_run($customer_query, [$customer_id])[0];
$maid = database_run($maid_query, [$maid_id])[0];

// Get service information
// $services_query = "SELECT service_id, service_name FROM service";
// $services = database_run($services_query);

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get form data
    // $service_id = $_POST['service_id'];
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];

    // ++added code++ that checks the availability of the maid on the selected date

    // Check if the maid is already booked on the selected dates 
    $booking_query = "SELECT * FROM booking WHERE maid_id = ? AND ((s_date <= ? AND e_date >= ?) OR (s_date <= ? AND e_date >= ?) OR (s_date >= ? AND e_date <= ?))";
    $existing_bookings = database_run($booking_query, [$maid_id, $start_date, $start_date, $end_date, $end_date, $start_date, $end_date]);

    if (!empty($existing_bookings)) {
        // Maid is already booked on the selected dates, display an error message
        echo "<script>alert('The maid is already booked for the selected date range. Please choose different dates.');</script>";
    } else {
        // end of added code

        // Save booking data
    $booking_query = "INSERT INTO booking (customer_id, c_firstname, maid_id, m_firstname, service_id, service_name, s_date, e_date, status)
    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
$status = 'Pending';

// $service_name = get_service_name($service_id);

$success = database_run($booking_query, [
$customer_id,
$customer->c_firstname,
$maid_id,
$maid->m_firstname,
$maid->service_id,
$maid->service_name,
$start_date,
$end_date,
$status
], false);
    }

}

// // Helper function to get the service name based on the ID
// function get_service_name($service_id)
// {
//   global $services;
//   foreach ($services as $service) {
//     if ($service->service_id == $service_id) {
//       return $service->service_name;
//     }
//   }
//   return "";
// }

?>

<!DOCTYPE html>
<html>
<head>
    <title>Book Now</title>
    <!-- Add your CSS stylesheets and other head elements -->
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
            .logo{
            cursor: pointer;
            }

            .container{
             display: flex;
              align-items: center;
             justify-content: center;
             min-height: 90vh;
             margin-top: 2px;
                      }

div.content {
margin-left: 200px;
padding: 1px 16px;
height: 1000px;
}
.box{
    background: white;
    display: flex;
    flex-direction: column;
    padding: 25px 25px;
    border-radius: 15px;
    box-shadow:
  16.7px 10.2px 1.4px rgba(0, 0, 0, 0.008),
  25.9px 15.7px 3.3px rgba(0, 0, 0, 0.016),
  30.2px 18.3px 6.1px rgba(0, 0, 0, 0.025),
  33.4px 20.3px 10.9px rgba(0, 0, 0, 0.033),
  43.1px 26.2px 20.5px rgba(0, 0, 0, 0.042),
  135px 82px 49px rgba(0, 0, 0, 0.05)

}

.form-box{
    width: 450px;
    /* minor change nimetoa hio 10px 10px to what you see hapo chini */
    margin: 20px 10px 0px 10px;
}

.form-box header{
    font-size: 25px;
    font-weight: 700;
    padding-bottom: 10px;
    border-bottom: 1px solid #e6e6e6;
    margin-bottom: 5px;
}
/* I changed the margin here its 10px on the login page */
.form-box form .field{
    /* display: flex; */
    margin-bottom: 5px;
    flex-direction: column;

}
/* height 20px instead of 40px bruuv */
.form-box form .input input{
    height: 25px;
    width: 100%;
    font-size: 16px;
    padding: 0 10px;
    border-radius: 5px;
    border: 1px solid #ccc;
    outline: none;
}
.btn{
    height: 35px;
    /* background: rgb(204, 159, 11); */
    background: rgb(27, 27, 27);
    border-radius: 5px;
    font-size: 15px;
    color: white;
    cursor: pointer;
    transition: all;
    margin-top: 10px;
    padding: 0 10px;
    width: 100%;
}
.btn:hover{
    opacity: 0.82;
}
.submit{
    width: 100%;
}

.links{
    margin-bottom: 15px;
}

/* dropdown css */
#dropdown {
  /* background-color: #f2f2f2;
  border: 1px solid #ccc; */
  border-radius: 4px;
  padding: 8px;
}

#dropdown label {
  display: block;
  margin-bottom: 8px;
  /* color: #666; */
}

#dropdown select {
  width: 100%;
  padding: 8px;
  font-size: 14px;
  border: 1px solid #ccc;
  border-radius: 4px;
  background-color: #fff;
  color: #333;
}

#dropdown select option {
  background-color: #f2f2f2;
  color: #333;
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

/* Pop-up styles */
.popup {
            display: flex;
            justify-content: center;
            align-items: center;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 9999;
        }

        .popup-content {
            background-color: #232222ad;
            color: #fff;
            padding: 20px;
            text-align: center;
            border-radius: 5px;
        }
        .popup-content:hover{
    opacity: 0.92;
}

        .popup button {
            background-color: #1b1a1a;
            color: #fff;
            border: none;
            padding: 10px 20px;
            margin-top: 10px;
            cursor: pointer;
            border-radius: 5px;

        }

        .popup button:hover{
    opacity: 0.42;
}
</style>

</head>
<body>
<nav>
    <input type="checkbox" id="check">
    <label for="check" class="checkbtn">
    </label>

    <a  href="../home.php"> <label class="logo" >MaidServs</label></a>
       <!-- <img src="logowhite250.png" class="logo"> -->
        <ul>
           <li><a class="active" href="../home.php">Home</a></li>
           
           <li><a href="">About</a></li>
           <li><a href="">Contacts</a></li>
           <li><a href="logout.php">Log out</a></li>
       </ul> 
</nav>
   <div class="container">

<div class="box form-box">


<!-- checkingif the has passed or not -->
<script>
function validateForm() {
  var startDate = new Date(document.getElementById('start_date').value);
  var endDate = new Date(document.getElementById('end_date').value);
  var currentDate = new Date();

  if (startDate < currentDate || endDate < currentDate) {
    alert("Invalid date. Please select a future date.");
    return false; // Prevent form submission
  }

  if (startDate > endDate) {
    alert("Invalid date range. End date should be later than the start date.");
    return false; // Prevent form submission
  }

  return true; // Allow form submission
}
</script>
<!-- end of checking if the date has passed or not -->


    <h1>Book Now</h1>
    <form method="POST" action="" onsubmit="return validateForm()">
        <div class="field input">
            <label for="c_firstname">Customer First Name:</label>
            <input type="text" id="c_firstname" name="c_firstname" value="<?php echo $customer->c_firstname; ?>" readonly>
        </div>

        <div class="field input">
            <label for="m_firstname">Maid First Name:</label>
            <input type="text" id="m_firstname" name="m_firstname" value="<?php echo $maid->m_firstname; ?>" readonly>
        </div>

  <input type="hidden" id="m_firstname" name="servive_id" value="<?php echo $maid->service_id; ?>" readonly>

  <div class="field input">
            <label for="service_name">Service:</label>
            <input type="text" id="m_firstname" name="servive_name" value="<?php echo $maid->service_name; ?>" readonly>
        </div>

        <div class="field input">
            <label for="start_date">Start Date:</label>
            <input type="date" id="start_date" name="start_date" required>
        </div>

        <div class="field input">
            <label for="end_date">End Date:</label>
            <input type="date" id="end_date" name="end_date" required>
        </div>

        <div class="field">
            <input class="btn" type="submit" value="Book Now">
        </div>
    </form>
</div>
   </div>
       <!-- Success pop-up -->
       <?php if ($success) { ?>
        <div class="popup">
            <div class="popup-content">
                <h2>Booking Successful!</h2>
                <button onclick="window.location.href = 'home.php';">OK</button>
            </div>
        </div>
    <?php } ?>

    <!-- Error pop-up -->
    <?php if (!$success && isset($_POST['service_id'])) { ?>
        <div class="popup">
            <div class="popup-content">
                <h2>Booking Unsuccessful. Please try again.</h2>
                <!-- <button onclick="location.reload();">OK</button> -->
                <button onclick="window.location.href = 'home.php';">OK</button>

            </div>
        </div>
    <?php } ?>
</body>
</html>
