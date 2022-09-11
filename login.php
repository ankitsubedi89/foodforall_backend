<?php
include 'DatabaseConfig.php';
include 'helper_functions/authentication_functions.php';

// $connection = mysqli_connect($HostName, $HostUser, $HostPass, $DatabaseName);

if (isset($_POST['email']) && isset($_POST['PASSWORD'])){
    $email = $_POST['email'];
    $password = $_POST['PASSWORD'];

    //Check if the email is already in the database
    $check_email = "SELECT * FROM users WHERE email = '$email'";
    $result = mysqli_query($connection, $check_email);
    $count = mysqli_num_rows($result);
    
    if($count > 0){
        // Checking if password is correct or not
        $data = mysqli_fetch_assoc($result);
        $databasePassword = $data['PASSWORD'];
        $userID = $data['id'];
        login($password, $databasePassword, $userID);
        
    }else{
        echo json_encode(
            [
                'success' => false,
                'message' => 'User not found'
            ]
            );

    }}
    else{
                echo json_encode(
                    [
                        'message' => 'Please fill all the fields',
                        'success' => false
                    ]
                    );
}
