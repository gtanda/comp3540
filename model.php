<?php
require_once ('db.php');

function join_user($username, $password, $email) {
    global $conn;

    $date = date('Y/m/d');
    $query = "INSERT INTO users values(NULL, '$username', '$password', '$email', '$date')";
    return mysqli_query($conn,$query);
}

function username_taken($username) {
    global $conn;

    $query = "SELECT u_username FROM users WHERE u_username = '$username'";
    $result = mysqli_query($conn,$query);
    return mysqli_num_rows($result) > 0;
}

function valid_user($username, $password) {
    global $conn;

    $query = "SELECT u_username, u_password FROM Users WHERE u_username = '$username' AND u_password = '$password'";
    $result = mysqli_query($conn, $query);
    return mysqli_num_rows($result) > 0;
}