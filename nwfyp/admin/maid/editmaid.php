<?php

include('../adminserver.php');
check_login();

// Check if form submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $errors = array();

    // Sanitize input fields
    $maid_id = filter_var($_POST['maid_id'], FILTER_SANITIZE_NUMBER_INT);
    $m_firstname = filter_var($_POST['m_firstname'], FILTER_SANITIZE_STRING);
    $lastname = filter_var($_POST['lastname'], FILTER_SANITIZE_STRING);
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $gender = filter_var($_POST['gender'], FILTER_SANITIZE_STRING);

    // Validate input fields
    if (empty($m_firstname)) {
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

    // If no errors, update the maid in the database
    if (empty($errors)) {
        $maid = array(
            'maid_id' => $maid_id,
            'm_firstname' => $m_firstname,
            'lastname' => $lastname,
            'email' => $email,
            'gender' => $gender,
            // 'image' => $image,
        );
        update_maid($maid);
        header('Location: maidsadmin.php');
        die();
    }
} else {
    // If not submitted, get the maid data from the database
    $maid_id = filter_var($_GET['maid_id'], FILTER_SANITIZE_NUMBER_INT);
    $maid = get_maid_by_id($maid_id);
    if (!$maid) {
        header('Location: maidsadmin.php');
        die();
    }
}
?>
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Edit Maid</title>
    <style type="text/css">
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
    margin: 30px;
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

    </style>

</head>
<body>
<div class="content">
<div class="box form-box">
    <h2>Edit Maid</h2>
    <?php if (!empty($errors)) { ?>
        <div class="errors">
            <ul>
                <?php foreach ($errors as $error) { ?>
                    <li><?php echo $error; ?></li>
                <?php } ?>
            </ul>
        </div>
    <?php } ?>
    <div class="field input">
    <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
        <input type="hidden" name="maid_id" value="<?php echo $maid->maid_id; ?>">
        <table>
            <tr>
                <td><label for="firstname">First Name:</label></td>
                <td><input type="text" name="m_firstname" value="<?php echo htmlspecialchars($maid->m_firstname); ?>"></td>
            </tr>
            <tr>
                <td><label for="lastname">Last Name:</label></td>
                <td><input type="text" name="lastname" value="<?php echo htmlspecialchars($maid->lastname); ?>"></td>
            </tr>
            <tr>
                <td><label for="email">Email:</label></td>
                <td><input type="email" name="email" value="<?php echo htmlspecialchars($maid->email); ?>"></td>
            </tr>
            <tr>
                <td><label for="gender">Gender:</label></td>
                <td>
                    <input type="radio" name="gender" value="M" <?php if ($maid->gender == 'Male') { echo 'checked'; } ?>> Male
                    <input type="radio" name="gender" value="F" <?php if ($maid->gender == 'Female') { echo 'checked'; } ?>> Female
                </td>
            </tr>
            <tr>
                <td></td>
                <td><input class="btn" type="submit" name="submit" value="Update Maid" required></td>
            </tr>
        </table>
    </form>
</div>
</div>
</div>
</body>
            