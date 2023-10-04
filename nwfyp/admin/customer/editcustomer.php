<?php

include('../adminserver.php');
check_login();

// Check if form submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $errors = array();

    // Sanitize input fields
    $customer_id = filter_var($_POST['customer_id'], FILTER_SANITIZE_NUMBER_INT);
    $firstname = filter_var($_POST['firstname'], FILTER_SANITIZE_STRING);
    $lastname = filter_var($_POST['lastname'], FILTER_SANITIZE_STRING);
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $gender = filter_var($_POST['gender'], FILTER_SANITIZE_STRING);

    // Validate input fields
    if (empty($firstname)) {
        $errors[] = 'First name is required';
    }
    if (empty($lastname)) {
        $errors[] = 'Last name is required';
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = 'Please enter a valid email address';
    }
    if (empty($gender)) {
        $errors[] = 'Gender is required';
    }

    // If no errors, update the customer in the database
    if (empty($errors)) {
        $customer = array(
            'customer_id' => $customer_id,
            'firstname' => $firstname,
            'lastname' => $lastname,
            'email' => $email,
            'gender' => $gender,
        );
        update_customer($customer);
        header('Location: custadmin.php');
        die();
    }
} else {
    // If not submitted, get the customer data from the database
    $customer_id = filter_var($_GET['customer_id'], FILTER_SANITIZE_NUMBER_INT);
    $customer = get_customer_by_id($customer_id);
    if (!$customer) {
        header('Location: custadmin.php');
        die();
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Edit Customer</title>
    <!-- <link rel="stylesheet" href="style.css"> -->

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
    justify-content: center;
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

    </style>
</head>
<body>
<div class="content">
<div class="box form-box">
    <h2>Edit Customer</h2>
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
        <input type="hidden" name="customer_id" value="<?php echo $customer->customer_id; ?>">
        <table class="styled-table">
            <tr>
                <td><label for="firstname">First Name:</label></td>
                <td><input type="text" name="c_firstname" value="<?php echo htmlspecialchars($customer->c_firstname); ?>"></td>
            </tr>
            <tr>
                <td><label for="lastname">Last Name:</label></td>
                <td><input type="text" name="lastname" value="<?php echo htmlspecialchars($customer->lastname); ?>"></td>
            </tr>
            <tr>
                <td><label for="email">Email:</label></td>
                <td><input type="email" name="email" value="<?php echo htmlspecialchars($customer->email); ?>"></td>
            </tr>
            <tr>
                <td><label for="gender">Gender:</label></td>
                <td>
                    <input type="radio" name="gender" value="M" <?php if ($customer->gender == 'Male') { echo 'checked'; } ?>> Male
                    <input type="radio" name="gender" value="F" <?php if ($customer->gender == 'Female') { echo 'checked'; } ?>> Female
                </td>
            </tr>
            <tr>
                <td></td>
                <td><input class="btn" type="submit" name="submit" value="Update Customer" required></td>
            </tr>
        </table>
    </form>
</div>
