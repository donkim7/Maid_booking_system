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

// Get all bookings for the current customer
$booking_query = "SELECT m_firstname, status FROM booking WHERE customer_id = :customer_id";
$bookings = database_run($booking_query, ['customer_id' => $customer_id]);

// Check if the booking information is retrieved successfully
if (!$bookings || (!is_array($bookings) && !is_object($bookings))) {
    // Redirect or display an error message if the information is not found
    // header("Location: profilehome.php"); // Replace 'profilehome.php' with your desired URL or error page
    // exit();
}
?>


<!DOCTYPE HTML>
<html>
<head>
  <title>Book Maid</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
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

/* Common styles for all screen sizes */
.maid-cards {
  display: flex;
  flex-wrap: wrap;
  justify-content: space-between;
  margin: 50px; /* Add negative margin to create space on both sides */
}

.maid-card {
  width: calc(33.33% - 20px); /* Adjust the width as needed */
  background-color: #f5f5f5;
  border-radius: 5px;
  margin-bottom: 20px;
  padding: 10px;
  box-sizing: border-box;
  box-shadow: 1px 10px 7px rgba(0.1, 0, 1, 0.2);
}

.maid-image img {
  width: 100%;
  height: auto;
  border-top-left-radius: 5px;
  border-top-right-radius: 5px;
}

.maid-details {
  padding: 10px 0;
}

.maid-details h3 {
  margin: 0;
  font-size: 18px;
  font-weight: bold;
}

.maid-details p {
  margin: 5px 0;
}

.maid-actions .book-button {
  display: inline-block;
  padding: 8px 16px;
  background-color: #000;
  color: #fff;
  text-decoration: none;
  border-radius: 5px;
  transition: opacity 0.3s;

}
.maid-actionss .book-button {
  display: inline-block; /*Change display to block */
  width: 100%; /* Set width to 100% */
  padding: 8px 16px;
  background-color: #000;
  color: #fff;
  text-decoration: none;
  border-radius: 5px;
  transition: opacity 0.3s;
  /* margin-top: auto; Add margin-top: auto to center the button vertically */
}

.maid-actions .book-button:hover {
  opacity: 0.7;
}

/* Media query for screens larger than 992px */
@media (max-width: 1199px) {
  .maid-card {
    width: calc(50% - 20px); /* Adjust the width as needed */
  }
}

/* Media query for screens up to 767px */
@media (max-width: 767px) {
  .maid-card {
    width: 100%;
    /*margin: 0; /* Remove the negative margin on smaller screens */
  }
}
.popup-notification {
            position: fixed;
            top: 80px;
            right: 20px;
            background-color: #efc172;
            border: 1px solid #ccc;
            padding: 15px;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.3);
            z-index: 9999;
            display: none;
        }

</style>
</head>
<body>

<div class="notification-container">
    <?php if (is_countable($bookings) && count($bookings) > 0) : ?>
        <?php foreach ($bookings as $booking) : ?>
            <div class="popup-notification">
                Your booking with <?php echo $booking->m_firstname; ?> is <?php echo $booking->status; ?>
            </div>
        <?php endforeach; ?>
    <?php else : ?>
        <div class="popup-notification">
            You don't have any bookings. Book now!
        </div>
    <?php endif; ?>
</div>

<script>
    // Function to display the popup notifications
    function showBookingNotifications() {
        var notifications = document.querySelectorAll('.popup-notification');
        notifications.forEach(function(notification) {
            notification.style.display = 'block';
        });
    }

    // Example usage: call the showBookingNotifications function
    showBookingNotifications();
</script>






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
           <li><a href="logout.php">Log out</a></li>
       </ul> 
   </nav>

<h1>Maids Available</h1>
<div class="maid-cards">
    <?php
    // Retrieve data from the database
    $maids = get_all_maids();

    // Loop through the data and display it as profile cards
    foreach ($maids as $maid) {
    ?>
    <div class="maid-card">
        <div class="maid-image">
            <img src="../maid/img/<?php echo $maid->image; ?>" width="150" height="120" alt="Passport Image">
        </div>
        <div class="maid-details">
            <h3><?php echo $maid->m_firstname . ' ' . $maid->lastname; ?></h3>
            <p><strong>Phone:</strong> <?php echo $maid->phone_number; ?></p>
            <p><strong>Gender:</strong> <?php echo $maid->gender; ?></p>
        </div>
        <div class="maid-actions">
            <a href="booknow.php?maid_id=<?php echo $maid->maid_id; ?>&customer_id=<?php echo $customer_id; ?>" class="book-button">Book Maid</a>
        </div>
    </div>
    <?php } ?>
</div>
</body>
</html>
