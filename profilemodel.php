<?php
require_once('db.php');

function unsubscribe($uid) {
    global $conn;

    $query = "DELETE FROM user_project WHERE u_id = $uid";
    return mysqli_query($conn, $query);
}

function change_password($username, $newPassword) {
    global $conn;

    $userID = get_user_id($username);

    $query = "UPDATE user_project SET u_password = '$newPassword' WHERE u_id = $userID";
    return mysqli_query($conn, $query);
}

function change_username($username, $newUsername) {
    global $conn;

    $userID = get_user_id($username);
    $query = "UPDATE user_project SET u_username = '$newUsername' WHERE u_id = $userID";
    return mysqli_query($conn, $query);
}