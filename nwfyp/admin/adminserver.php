<?php 

session_start();

function database_run($query,$vars = array())
{
	$string = "mysql:host=localhost;dbname=maidserves";
	$con = new PDO($string,'root','');

	if(!$con){
		return false;
	}

	$stm = $con->prepare($query);
	$check = $stm->execute($vars);

	if($check){
		
		$data = $stm->fetchAll(PDO::FETCH_OBJ);
		
		if(count($data) > 0){
			return $data;
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


	$check = database_run("select * from admin where email = :email limit 1",['email'=>$data['email']]);
	if(is_array($check)){
		$errors[] = "That email already exists";
	}

	//save
	if(count($errors) == 0){
		$arr['firstname'] = $data['firstname'];
		$arr['lastname'] = $data['lastname'];
		$arr['email'] = $data['email'];
		$arr['username'] = $data['username'];
		$arr['password'] = $data['password'];
		$arr['gender'] = $data['gender'];



		$query = "insert into admin (firstname,lastname,email,username,password,gender) values 
		(:firstname,:lastname,:email,:username,:password,:gender)";

		database_run($query,$arr);
	}
	return $errors;
}

function login($data)
{
	$errors = array();
 
	//validate 
	if(!filter_var($data['email'],FILTER_VALIDATE_EMAIL)){
		$errors[] = "Please enter a valid email";
	}

	if(strlen(trim($data['password'])) < 6){
		$errors[] = "Password must be atleast 6 chars long";
	}
 
	//check
	if(count($errors) == 0){

		$arr['email'] = $data['email'];
		$password =  $data['password'];

		$query = "select * from admin where email = :email limit 1";

		$row = database_run($query,$arr);

		if(is_array($row)){
			$row = $row[0];

			if($password === $row->password){
				
				$_SESSION['USER'] = $row;
				$_SESSION['LOGGED_IN'] = true;
			}else{
				$errors[] = "wrong email or password";
			}

		}else{
			$errors[] = "wrong email or password";
		}
	}
	return $errors;
}


function check_login($redirect = true){

	if(isset($_SESSION['USER']) && isset($_SESSION['LOGGED_IN'])){

		return true;
	}

	if($redirect){
		header("Location: adminlog.php");
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

// function to delete a maid from the database
function delete_maid($maid_id)
{
	$query = "delete from maid where maid_id= :maid_id";
	return database_run($query, array('maid_id' => $maid_id));
}

// function to update a maid
function update_maid($maid)
{
    $query = "UPDATE maid SET m_firstname = :m_firstname, lastname = :lastname, email = :email, gender = :gender WHERE maid_id = :maid_id";
    return database_run($query, array(
        'maid_id' => $maid['maid_id'],
        'm_firstname' => $maid['m_firstname'],
        'lastname' => $maid['lastname'],
        'email' => $maid['email'],
        'gender' => $maid['gender'],
		// 'image' => $maid['image']
    ));
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

// function to delete a customer from the database
function delete_customer($customer_id)
{
	$query = "delete from customer where customer_id= :customer_id";
return database_run($query, array('customer_id' => $customer_id));
}

// function to update a customer
function update_customer($customer)
{
    $query = "UPDATE customer SET firstname = :firstname, lastname = :lastname, email = :email, gender = :gender WHERE customer_id = :customer_id";
    return database_run($query, array(
        'customer_id' => $customer['customer_id'],
        'firstname' => $customer['firstname'],
        'lastname' => $customer['lastname'],
        'email' => $customer['email'],
        'gender' => $customer['gender']
    ));
}




function get_all_services()
{
	$query = "select * from service";
	return database_run($query);
}

// function to retrieve a single service by ID from the database
function get_service_by_id($service_id)
{
	$query = "select * from service where service_id = :service_id limit 1";
	$result = database_run($query, array('service_id' => $service_id));
	return isset($result[0]) ? $result[0] : null;
}

function delete_service($service_id)
{
	$query = "delete from service where service_id= :service_id";
return database_run($query, array('service_id' => $service_id));
}

// function to update a customer
function update_service($service)
{
    $query = "UPDATE service SET service_name = :service_name, price = :price WHERE service_id = :service_id";
    return database_run($query, array(
        'service_id' => $service['service_id'],
        'service_name' => $service['service_name'],
        'price' => $service['price']

    ));
}


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