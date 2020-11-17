<?php
require_once('db.php');


// Meal Functions
function add_meal($uid, $mealname, $calories){
    global $conn;

    $date = date('Ymd');
    $query = "INSERT INTO meal_project VALUES(NULL, '$mealname', $calories, $uid, $date)";
    $result = mysqli_query($conn, $query);

    if($result) {
        echo "<div class='alert alert-success' role='alert'><strong>Meal Has Been Added!</strong>
                  <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                    <span aria-hidden='true'>&times;</span>
                  </button>
              </div>";
    } else {
        echo "<div class='alert alert-danger' role='alert'><strong>Meal Not Added</strong>
                  <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                    <span aria-hidden='true'>&times;</span>
                  </button>
              </div>";
    }
}

function get_meals($username){
    global $conn;

    $userID = get_user_id($username);

    $query = "SELECT m_name, m_calories, m_date FROM meal_project WHERE DATEDIFF(SYSDATE(), m_date) < 365 AND m_user_id = $userID";
    $result = mysqli_query($conn, $query);

    $data = [];
    while($row = mysqli_fetch_assoc($result)) {
        $data[] = $row;
    }

    echo json_encode($data);
}

// Exercise functions
function add_exercise($exercise, $sets, $reps, $weight, $uid){
    global $conn;

    $date = date('Ymd');
    $total = $sets * $reps * $weight;
    $query = "INSERT INTO weight_project VALUES (NULL,'$exercise',$sets,$reps,$weight, $total, $uid,$date)";
    $result = mysqli_query($conn, $query);

    if($result) {
        echo "<div class='alert alert-success' role='alert'><strong>Exercise Has Been Added!</strong>
                  <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                    <span aria-hidden='true'>&times;</span>
                  </button>
              </div>";
    } else {
        echo "<div class='alert alert-danger' role='alert'><strong>Exercise Not Added</strong>
                  <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                    <span aria-hidden='true'>&times;</span>
                  </button>
            </div>";
    }
}

function get_exercises($username){
    global $conn;

    $userID = get_user_id($username);

    $query = "SELECT w_exercise, w_sets, w_reps, w_weight, w_total, w_date FROM weight_project 
WHERE DATEDIFF(SYSDATE(), w_date) < 365 AND w_user_id = $userID";
    $result = mysqli_query($conn, $query);

    $data = [];
    while($row = mysqli_fetch_assoc($result)) {
        $data[] = $row;
    }
    echo json_encode($data);
}


// Sleep functions
function add_sleep($uid, $sleep){
    global $conn;

    $date = date('Ymd');
    $query = "INSERT INTO sleep_project VALUES(NULL, $sleep, $uid, $date)";
    $result = mysqli_query($conn, $query);

    if($result) {
        echo "<div class='alert alert-success' role='alert'><strong>Sleep Added!</strong>
                  <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                    <span aria-hidden='true'>&times;</span>
                  </button>
              </div>";
    } else {
        echo "<div class='alert alert-danger' role='alert'><strong>Sleep Not Added</strong>
                  <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                    <span aria-hidden='true'>&times;</span>
                  </button>
              </div>";
    }
}

function get_sleep($username){
    global $conn;

    $userID = get_user_id($username);

    $query = "SELECT s_sleep, s_date FROM sleep_project WHERE DATEDIFF(SYSDATE(), s_date) < 365 AND s_user_id = $userID";
    $result = mysqli_query($conn, $query);

    $data = [];
    while($row = mysqli_fetch_assoc($result)) {
        $data[] = $row;
    }
    echo json_encode($data);
}

function add_resource($title, $link, $id){
    global $conn;

    $query = "INSERT INTO resource_project VALUES(NULL, '$title', '$link', $id)";
    $result = mysqli_query($conn, $query);

    if($result) {
        echo "<div class='alert alert-success' role='alert'><strong>Resource Added!</strong>
                  <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                    <span aria-hidden='true'>&times;</span>
                  </button>
              </div>";
    } else {
        echo "<div class='alert alert-danger' role='alert'><strong>Resource Not Added</strong>
                  <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                    <span aria-hidden='true'>&times;</span>
                  </button>
              </div>";
    }
}

function get_resources_list($username) {
    global $conn;

    $userID = get_user_id($username);

    $query = "SELECT r_title, r_link, r_id FROM resource_project WHERE r_user_id = $userID ";
    $result = mysqli_query($conn, $query);

    $data = [];
    while($row = mysqli_fetch_assoc($result)) {
        $data[] = $row;
    }
    echo json_encode($data);
}

function delete_item($item_id) {
    global $conn;

    $query = "DELETE FROM resource_project WHERE r_id = $item_id";
    return mysqli_query($conn, $query);
}

function search_resources($term, $username) {
    global $conn;

    $userID = get_user_id($username);

    $query  = "SELECT r_title, r_link, r_id FROM resource_project WHERE r_user_id = $userID AND r_title LIKE '%$term%'";
    $result = mysqli_query($conn, $query);

    $data = [];
    while($row = mysqli_fetch_assoc($result))
        $data[] = $row;
    echo json_encode($data);
}
