<?php
require_once('db.php');

function unsubscribe($uid) {
    global $conn;

    $query = "DELETE FROM user_project WHERE u_id = $uid";
    return mysqli_query($conn, $query);
}