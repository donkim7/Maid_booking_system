<?php

session_start();

// Database connection function
function database_run($query, $vars = array())
{
    $string = "mysql:host=localhost;dbname=maidserves";
    $con = new PDO($string, 'root', '');

    if (!$con) {
        return false;
    }

    $stm = $con->prepare($query);
    $check = $stm->execute($vars);
    
    if ($check) {
        $data = $stm->fetchAll(PDO::FETCH_OBJ);
        
        if (count($data) > 0) {
            return $data;
        }
    }

    return $con->lastInsertId();
}

// Check the USSD request and handle the flow
function handleUSSDRequest($phoneNumber, $sessionId, $text)
{
    // Read the variables sent via POST from our API
    if ($text == "") {
        // This is the first request. Note how we start the response with CON
        $response  = "CON Welcome to MaidServes\n";
        $response .= "Please enter your name:";
        
    } elseif (strpos($text, "*") === false) {
        // Check if the maid name is entered
        // Store the maid's name in the session
        $_SESSION['maid_name'] = $text;
        // Store the maid's name in the database
        $maidName = $text;
        $query = "INSERT INTO maids (maid_name) VALUES (?)";
        $result = database_run($query, array($maidName));
 
        // Prompt for service selection
        $response = "CON Hi " . $text . "!\n";
        $response .= "Please select the service you provide:\n";
        $response .= "1. Laundry\n";
        $response .= "2. Cooking\n";
        $response .= "3. Cleaning";
        
    } else {
        $explodedText = explode('*', $text);
        $selectedService = intval(end($explodedText));
        // Validate the selected service
        if ($selectedService >= 1 && $selectedService <= 3) {
            // Get the maid's name from the session
            $maidName = $_SESSION['maid_name'];

            // Get the maid's ID
            $query = "SELECT maid_name FROM maids WHERE maid_name = ?";
            $result = database_run($query, array($maidName));

            if ($result) {
                $maidName = $result[0]->maid_name;

                // Store the maid's selected service in the database
                $query = "INSERT INTO services (service, maid_name) VALUES (?, ?)";
                $result = database_run($query, array($selectedService, $maidName));
            }else if ($text == "1") {
    // Business logic for first level response
    $response = "CON Choose account information you want to view \n";
    $response .= "1. Laundry \n";

                if ($result) {
                    // Generate service code
                    $serviceCode = generateServiceCode($selectedService, $maidName);

                    if ($serviceCode) {
                        // Success message
                        $response = "END Thank you for providing your service!\n";
                        $response .= "Your service code is: " . $serviceCode;
                    } else {
                        // Error occurred, handle accordingly
                        $response = "END Oops! Something went wrong... Please try again later.";
                    }
                } else {
                    // Error occurred, handle accordingly
                    $response = "END Oops! Something went wrong.. Please try again later.";
                }
            } else {
                // Error occurred, handle accordingly
                $response = "END Oops! Something went wrong. Please try again later.";
            }
        } else {
            // Invalid service selected
            $response = "END Invalid service selection. Please try again.";
        }
    }

    header('Content-type: text/plain');
    echo $response;
}

// Generate a service code based on the selected service and maid ID
function generateServiceCode($selectedService, $maidId)
{
    $serviceCode = "";

    switch ($selectedService) {
        case 1:
            $serviceCode = "L1" . $maidId;
            break;
        case 2:
            $serviceCode = "C2" . $maidId;
            break;
        case 3:
            $serviceCode = "G3" . $maidId;
            break;
    }

    return $serviceCode;
}

// Get USSD request data
$sessionId = $_POST['sessionId'];
$phoneNumber = $_POST['phoneNumber'];
$text = $_POST['text'];

// Handle the USSD request
handleUSSDRequest($phoneNumber, $sessionId, $text);
?>
