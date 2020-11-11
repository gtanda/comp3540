<?php
require_once('db.php');

function sign_out() {
    session_unset();
    session_destroy();
}


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

    $query = "SELECT m_name, m_calories, m_date FROM meal_project JOIN user_project ON m_user_id = u_id 
    WHERE DATEDIFF(SYSDATE(), m_date) < 365 AND m_user_id = $userID";
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

    $query = "SELECT w_exercise, w_sets, w_sets, w_reps, w_weight, w_total FROM weight_project JOIN user_project ON w_user_id = u_id 
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

    $query = "SELECT s_sleep, s_date FROM sleep_project JOIN user_project ON s_user_id = u_id
WHERE DATEDIFF(SYSDATE(), s_date) < 365 AND s_user_id = $userID";
    $result = mysqli_query($conn, $query);

    $data = [];
    while($row = mysqli_fetch_assoc($result)) {
        $data[] = $row;
    }
    echo json_encode($data);
}