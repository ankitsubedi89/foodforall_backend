<?php 
include 'DatabaseConfig.php';
include 'helper_functions/authentication_functions.php';

$tokenCheck = checkIdValidUser($_POST['token']??null);
if(isset($_POST['token']) && $tokenCheck != null){
    $userID = $tokenCheck;
    $getUserDetails = "SELECT * FROM users WHERE id = '$userID'";
    $result = mysqli_query($connection, $getUserDetails);
    $data = mysqli_fetch_assoc($result);
    
    echo json_encode(
        [
            'success' => true,
            'message' => 'User found',
            'data' => $data
        ]
        );
}else{
    echo json_encode(
        [
            'success' => false,
            'message' => 'Access denied'
        ]
        );
}