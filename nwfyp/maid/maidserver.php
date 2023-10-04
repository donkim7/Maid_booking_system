<?php 

session_start();

function database_run($query, $vars = array())
{
    $string = "mysql:host=localhost;dbname=maidserves";
    $con = new PDO($string, 'root', '');

    if (!$con) {
        return false;
    }

    $stm = $con->prepare($query);

    if ($stm->execute($vars)) {
        // If it's a SELECT statement, fetch the rows
        if (strtoupper(substr(trim($query), 0, 6)) === 'SELECT') {
            $data = $stm->fetchAll(PDO::FETCH_OBJ);
            if (count($data) > 0) {
                return $data;
            }
        }
        // If it's an INSERT statement, return true
        elseif (strtoupper(substr(trim($query), 0, 6)) === 'INSERT') {
            return true;
        }
    }

    return false;
}




function signup($data)
{
	$errors = array();
 
	//validate 

	if(!filter_var($data['email'],FILTER_VALIDATE_EMAIL)){
		$errors[] = "Please enter a valid email";
	}

	if(strlen(trim($data['password'])) < 6){
		$errors[] = "Password must be atleast 6 chars long";
	}

//we checkin if the email exists or naaaah
	$check = database_run("select * from maid where email = :email limit 1",['email'=>$data['email']]);
	if(is_array($check)){
		$errors[] = "That email already exists";
	}
//basically the beginning of registration ting-----------------------------------------------------------gvtcrwxr---------------------------------------iouibu
	//save
if (count($errors) == 0) {
    $arr['m_firstname'] = $data['m_firstname'];
    $arr['lastname'] = $data['lastname'];
    $arr['email'] = $data['email'];
    $arr['birthdate'] = $_POST['birthdate'];
    $arr['username'] = $data['username'];
    $arr['password'] = $data['password'];
    $arr['phone_number'] = $data['phone_number'];
    $arr['address'] = $data['address'];
    $arr['service_id'] = $data['service_id'];
    $arr['service_name'] = $data['service_name']; // Get the service name
    $arr['gender'] = $data['gender'];

    // // Process the uploaded image
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $image_name = $_FILES['image']['name'];
        $image_tmp = $_FILES['image']['tmp_name'];
        $image_path = 'img/' . $image_name;

        if (move_uploaded_file($image_tmp, $image_path)) {
            $arr['image'] = $image_name;
        } else {
            $errors[] = "Failed to move the uploaded image.";
        }
    } else {
        $arr['image'] = ""; // Set a default value if no image is uploaded
    }


    $query = "INSERT INTO maid (m_firstname, lastname, email, birthdate, username, password, phone_number, address, service_id, service_name, gender, status, image) 
              VALUES (:m_firstname, :lastname, :email, :birthdate, :username, :password, :phone_number, :address, :service_id, :service_name, :gender, 'Available', :image)";

    database_run($query, $arr);
}

return $errors;


}
//kind of the end of registration-----------------------------------------------------------------uhbytnde4bcnxenx-----------------------------------tfcecb4


function login($data)
{
    $errors = array();
 
    // Validate
    if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL) && strlen(trim($data['email'])) < 6) {
        $errors[] = "Please enter a valid email or username";
    }
     //checking the length of the password
    if (strlen(trim($data['password'])) < 6) {
        $errors[] = "Password must be at least 6 characters long";
    }
 
    // Check
    if (count($errors) == 0) {
        $identifier = $data['email'];
        $password = $data['password'];

        // Check if the input is an email or username to be ableto login with the email or youzanem
        if (filter_var($identifier, FILTER_VALIDATE_EMAIL)) {
            $query = "SELECT * FROM maid WHERE email = :identifier LIMIT 1";
        } else {
            $query = "SELECT * FROM maid WHERE username = :identifier LIMIT 1";
        }

        $arr['identifier'] = $identifier;
        $row = database_run($query, $arr);

        if (is_array($row)) {
            $row = $row[0];

            if ($password === $row->password) {
                $_SESSION['USER'] = $row;
                $_SESSION['LOGGED_IN'] = true;
            } else {
                $errors[] = "Wrong email or password";
            }
        } else {
            $errors[] = "Wrong email or password";
        }
    }
    return $errors;
}


function check_login($redirect = true){

	if(isset($_SESSION['USER']) && isset($_SESSION['LOGGED_IN'])){

		return true;
	}
	$maid_id = $_SESSION['USER']->maid_id;

	if($redirect){
		header("Location: Maidlogphp.php");
		die;
	}else{
		return false;
	}
	
}



// function to retrieve all maids from the database
function get_all_maids()
{
	$query = "select * from maid";
	return database_run($query);
}

// function to retrieve a single maid by ID from the database
function get_maid_by_id($maid_id) 
{
	$query = "select * from maid where maid_id = :maid_id limit 1";
	$result = database_run($query, array('maid_id' => $maid_id));
	return isset($result[0]) ? $result[0] : null;
}


// function to retrieve all customers from the database
function get_all_customers()
{
	$query = "select * from customer";
	return database_run($query);
}

// function to retrieve a single customer by ID from the database
function get_customer_by_id($customer_id)
{
	$query = "select * from customer where customer_id = :customer_id limit 1";
	$result = database_run($query, array('customer_id' => $customer_id));
	return isset($result[0]) ? $result[0] : null;
}

//the deny and approve booking thing
function deny_booking($booking_id)
{
    $query = "UPDATE booking SET  status = 'Denied' WHERE booking_id = :booking_id";
    return database_run($query, array(
        'booking_id' => $booking_id
    ));
}

function approve_booking($booking_id)
{
    $query = "UPDATE booking SET  status = 'Approved' WHERE booking_id = :booking_id";
    return database_run($query, array(
        'booking_id' => $booking_id
    ));
}
?>