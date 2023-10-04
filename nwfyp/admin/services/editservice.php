<?php

include('../adminserver.php');
check_login();

// Check if form submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $errors = array();

    // Sanitize input fields
    $service_id = filter_var($_POST['service_id'], FILTER_SANITIZE_NUMBER_INT);
    $service_name = filter_var($_POST['service_name'], FILTER_SANITIZE_STRING);
    $price = filter_var($_POST['price'], FILTER_SANITIZE_STRING);


    // Validate input fields
    if (empty($service_name)) {
        $errors[] = 'First name is required';
    }
    if (empty($price)) {
        $errors[] = 'Price is required';
    }


    // If no errors, update the service in the database
    if (empty($errors)) {
        $service = array(
            'service_id' => $service_id,
            'service_name' => $service_name,
            'price' => $price,

        );
        update_service($service);
        header('Location: servicesadmin.php');
        die();
    }
} else {
    // If not submitted, get the service data from the database
    $service_id = filter_var($_GET['service_id'], FILTER_SANITIZE_NUMBER_INT);
    $service = get_service_by_id($service_id);
    if (!$service) {
        header('Location: servicesadmin.php');
        die();
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <title>Edit service</title>
    <link rel="stylesheet" href="style.css">

    <style type="text/css">

/* 
A background pic for this too
 */


*{
    padding: 0;
    margin: 0;
    text-decoration: none;
    list-style: none;
    box-sizing:border-box;
    font-family: Cambria, Cochin, Georgia, Times, 'Times New Roman', serif;
}

body{
    background: lightgray ;

}
.container{
    display: flex;
    align-items: center;
    justify-content: space-evenly;
    min-height: 90vh;
    margin-top: 2px;
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
    margin: 320px;
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

.navtab{
                display: flex; 
                
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
            .wrapper{
                width: 100%;
            }


    </style>
</head>
<body>
<div class="content">
<div class="box form-box">
    <h2>Edit service</h2>
    <?php if (!empty($errors)) { ?>
        <div class="errors">
            <ul>
                <?php foreach ($errors as $error) { ?>
                    <li><?php echo $error; ?></li>
                <?php } ?>
            </ul>
        </div>
    <?php } ?>


    <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
        <input type="hidden" name="service_id" value="<?php echo $service->service_id; ?>">
        <table class="styled-table">
            <tr>
                <td><label for="firstname">First Name:</label></td>
                <td><input type="text" name="service_name" value="<?php echo htmlspecialchars($service->service_name); ?>"></td>
            </tr>
            <tr>
                <td><label for="email">Email:</label></td>
                <td><input type="text" name="price" value="<?php echo htmlspecialchars($service->price); ?>"></td>
            </tr>

            <tr>
                <td></td>
                <td><input class="btn" type="submit" name="submit" value="Update service" required></td>
            </tr>
        </table>
    </form>
</div>
</div>
</div>
</body>
</html>