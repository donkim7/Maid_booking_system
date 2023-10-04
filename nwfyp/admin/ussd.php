<?php


// Read the variables sent via POST from our API
$sessionId   = $_POST["sessionId"];
$serviceCode = $_POST["serviceCode"];
$phoneNumber = $_POST["phoneNumber"];
$text        = $_POST["text"];

if ($text == "") {
    // This is the first request. Note how we start the response with CON
    $response  = "CON What services do you offer? \n";
    $response .= "1. Laundry \n";
    $response .= "2. Cleaning \n";
    $response .= "3. Gardening \n";
    $response .= "4. Cooking";
    
} else if ($text == "1") {
    // Business logic for first level response
    $response = "CON Choose account information you want to view \n";
    $response .= "1. Laundry \n";

} else if ($text == "2") {
    // Business logic for first level response
    // This is a terminal request. Note how we start the response with END
    $response = "END Your phone number is ".$phoneNumber;

} else if($text == "1*1") { 
    // This is a second level response where the user selected 1 in the first instance
    $accountNumber  = "L1001";

    // This is a terminal request. Note how we start the response with END
    $response = "END Your Laundry code is ".$accountNumber;

}

// Echo the response back to the API
header('Content-type: text/plain');
echo $response;