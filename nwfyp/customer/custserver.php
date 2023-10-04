<?php 

session_start();

function database_run($query, $vars = array(), $fetch = true)
{
    $string = "mysql:host=localhost;dbname=maidserves";
    $con = new PDO($string, 'root', '');
    $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if (!$con) {
        echo "Database connection failed.";
        return false;
    }

    $stm = $con->prepare($query);

    try {
        $check = $stm->execute($vars);

        if ($check) {
            // For SELECT queries, fetch and return the result set
            if ($fetch) {
                $data = $stm->fetchAll(PDO::FETCH_OBJ);

                if (count($data) > 0) {
                    return $data;
                } 
            }
            // For INSERT queries, return the success status
            else {
                return true;
            }
        } else {
            // Display the error message if execution fails
            $error_info = $stm->errorInfo();
            echo "Database error: " . $error_info[2];
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }

    return false;
}






//...........checks if emailexists and if the password is 6 characters and all that shananigan ting

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


	$check = database_run("select * from customer where email = :email limit 1",['email'=>$data['email']]);
	if(is_array($check)){
		$errors[] = "That email already exists";
	}
//........................the whole inserting registration data into the database ya customer....................................
	//save
	if(count($errors) == 0){
		$arr['c_firstname'] = $data['c_firstname'];
		$arr['lastname'] = $data['lastname'];
		$arr['email'] = $data['email'];
		$arr['birthdate'] = $_POST['birthdate'];
		$arr['username'] = $data['username'];
		$arr['password'] = $data['password'];
		$arr['phone_number'] = $data['phone_number'];
		$arr['address'] = $data['address'];
		$arr['gender'] = $data['gender'];
        // $arr['img'] = $data['img'];


		$query = "insert into customer (c_firstname,lastname,email,birthdate,username,password,phone_number,address,gender) values 
		(:c_firstname,:lastname,:email,:birthdate,:username,:password,:phone_number,:address,:gender)";

		database_run($query,$arr);
	}
	return $errors;
}
//...........................end ya inserting data za customer kwa registration ting..............................................
function login($data)
{
    $errors = array();
 
    // Validate
    if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL) && strlen(trim($data['email'])) < 6) {
        $errors[] = "Please enter a valid email or username";
    }
// tells em that the password should be more than 6 characters
    if (strlen(trim($data['password'])) < 6) {
        $errors[] = "Password must be at least 6 characters long";
    }
 
    // Check
    if (count($errors) == 0) {
        $identifier = $data['email'];
        $password = $data['password'];

        // Check if the input is an email or username
        if (filter_var($identifier, FILTER_VALIDATE_EMAIL)) {
            $query = "SELECT * FROM customer WHERE email = :identifier LIMIT 1";
        } else {
            $query = "SELECT * FROM customer WHERE username = :identifier LIMIT 1";
        }

        $arr['identifier'] = $identifier;
        $row = database_run($query, $arr);

        if (is_array($row)) {
            $row = $row[0];
//checks if thats the correct email and password..........................................................
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



//log in stuff...........................................................................................

function check_login($redirect = true){

	if(isset($_SESSION['USER']) && isset($_SESSION['LOGGED_IN'])){

		return true;
	}
	$customer_id = $_SESSION['USER']->customer_id;


	if($redirect){
		header("Location: custlogphp.php");
		die;
	}else{
		return false;
	}
}

// getting all maids from the database
function get_all_maids()
{
	$query = "select * from maid";
	return database_run($query);
}

// getting a single maid by ID from the database
function get_maid_by_id($maid_id) 
{
	$query = "select * from maid where maid_id = :maid_id limit 1";
	$result = database_run($query, array('maid_id' => $maid_id));
	return isset($result[0]) ? $result[0] : null;
}

//getting the laundry id which is basically 1 for laundry category
function get_laundry_maids(){
    $query = "SELECT * FROM `maid` WHERE service_id = 1";
    return database_run($query);
}

//getting the cooking id which is basically 2 for cooking category
function get_cooking_maids(){
    $query = "SELECT * FROM `maid` WHERE service_id = 2";
    return database_run($query);
}

//getting the cooking id which is basically 3 for cleaning category
function get_cleaning_maids(){
    $query = "SELECT * FROM `maid` WHERE service_id = 3";
    return database_run($query);
}

//getting the cooking id which is basically 4 for gardening category
function get_gardening_maids(){
    $query = "SELECT * FROM `maid` WHERE service_id = 4";
    return database_run($query);
}
?>