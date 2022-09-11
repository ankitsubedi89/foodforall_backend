<?php

include 'DatabaseConfig.php';
include 'helper_functions/authentication_functions.php';

$isAdmin = checkIfAdmin($_POST['token'] ?? null);
if ($isAdmin) {
    if (isset($_POST['NAME']) && isset($_POST['description'])) {
        $name = $_POST['NAME'];
        $description = $_POST['description'];

        $addCategory = "INSERT INTO categories (NAME, description) VALUES ('$name', '$description')";
        $result = mysqli_query($connection, $addCategory);
        if ($result) {
            echo json_encode(
                [
                    'success' => true,
                    'message' => 'Category added'
                ]
            );
        } else {
            echo json_encode(
                [
                    'success' => false,
                    'message' => 'Error adding category'
                ]
            );
        }
    } else {
        echo json_encode(
            [
                'success' => false,
                'message' => 'Please fill all the fields.'
            ]
        );
    }
} else {
    echo json_encode(
        [
            'success' => false,
            'message' => 'Access denied'
        ]
    );
}