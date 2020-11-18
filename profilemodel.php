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

function upload_image($username) {
    global $conn;

    $userID = get_user_id($username);
    $file = 'images/' . basename($_FILES['profileImage']['name']);

    if (move_uploaded_file($_FILES["profileImage"]["tmp_name"], $file)) {
        echo "<div class='alert alert-success' role='alert'><strong>Your Image has been added!</strong>
                  <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                    <span aria-hidden='true'>&times;</span>
                  </button>
              </div>";
    } else {
        echo "<div class='alert alert-danger' role='alert'><strong>Problem Uploading Image</strong>
                  <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                    <span aria-hidden='true'>&times;</span>
                  </button>
              </div>";
    }

    $image = basename( $_FILES["profileImage"]["name"]);
    $query = "INSERT INTO image_project VALUES(NULL, '$image', $userID)";
    return mysqli_query($conn, $query);
}

function get_image($username) {
    global $conn;

    $userID = get_user_id($username);

    $query = "SELECT i_name FROM image_project WHERE i_user_id = $userID";
    $result = mysqli_query($conn, $query);


    $data = [];
    while($row = mysqli_fetch_assoc($result)) {
        $data[] = $row;
    }
    echo json_encode($data);
}