<?php
include 'DatabaseConfig.php';
include 'helper_functions/authentication_functions.php';

// $connection = mysqli_connect($HostName, $HostUser, $HostPass, $DatabaseName);

if (isset($_POST['NAME']) && isset($_POST['user_name']) && isset($_POST['phone_number']) && isset($_POST['email']) && isset($_POST['PASSWORD'])){
    $name = $_POST['NAME'];
    $user_name = $_POST['user_name'];
    $phone_number = $_POST['phone_number'];
    $email = $_POST['email'];
    $password = $_POST['PASSWORD'];

    //Check if the email is already in the database
    $check_email = "SELECT * FROM users WHERE email = '$email'";
    $result = mysqli_query($connection, $check_email);
    $count = mysqli_num_rows($result);
    
    if($count > 0){
        echo json_encode(
            [
                'success' => true,
                'message' => 'Email already exist'
            ]
            );
    }else{
        signUp($name, $user_name, $phone_number,$email, $password);
    }}
    else{
                echo json_encode(
                    [
                        'message' => 'Please fill all the fields',
                        'success' => false
                    ]
                    );
}
