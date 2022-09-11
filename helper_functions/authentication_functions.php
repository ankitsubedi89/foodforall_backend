<?php
function signUp($name, $user_name, $phone_number,$email, $password)
{
    global $connection;
    // To encrypt the password declaring the variable and encrypting the password  
    $encrypted_password = password_hash($password, PASSWORD_DEFAULT);
    $insert_user = "INSERT INTO users (NAME, user_name, phone_number,email, PASSWORD) VALUES ('$name', '$user_name', '$phone_number','$email', '$encrypted_password')";
    $result = mysqli_query($connection, $insert_user);

    if ($result) {
        echo json_encode(
            [
                'success' => true,
                'message' => "User created successfully"
            ]
        );
    } else {
        echo json_encode(
            [
                'success' => false,
                'message' => 'User creation failed'
            ]
        );
    }
}


function login($password, $databasePassword, $userID)
{
    if (password_verify($password, $databasePassword)) {

        // Creating personal access token
        $token = bin2hex(openssl_random_pseudo_bytes(16));

        // Inserting the token into the database
        global $connection;
        $insert_token  = "INSERT INTO personal_access_tokens (user_id, token) VALUES ('$userID', '$token' )";
        $result = mysqli_query($connection, $insert_token);

        if ($result) {
            echo json_encode(
                [
                    'success' => true,
                    'message' => 'User logged in successfully',
                    'token' => $token
                ]
            );
        } else {


            echo json_encode(
                [
                    'success' => true,
                    'message' => 'User logged in failed'
                ]
            );
        }
    } else {
        echo json_encode(
            [
                'success' => false,
                'message' => 'Password is incorrect'
            ]
        );
    }
}


function checkIdValidUser($token)
{
    global $connection;
    if ($token != null) {
      
        $check_token = "SELECT * FROM personal_access_tokens WHERE token = '$token'";
        $result = mysqli_query($connection, $check_token);
        $count = mysqli_num_rows($result);
        if ($count > 0) {
            $userID = mysqli_fetch_assoc($result)['user_id'];
            return $userID;
        } else {
            return null;
        }
    } else {
        return null;
    }
}

                       
function checkIfAdmin($token)
{   
    $userId=checkIdValidUser($token);
    if($userId!=null){ 
        global $connection;
        $check_admin = "SELECT * FROM users WHERE id = '$userId'";
        $result = mysqli_query($connection, $check_admin);
        $count = mysqli_num_rows($result);
        if ($count > 0) {
            $user = mysqli_fetch_assoc($result);
            if ($user['isAdmin'] == 1) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }else{
        return false;
    }
}
