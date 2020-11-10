<?php
require_once ("model.php");

if (!isset($_POST['page'])) {  // When no page is sent from the client; The initial display
    $error_message = "";
    $display_type = 'none';
    include('index.php');
    exit();
}


session_start();

if($_POST['page'] == 'IndexPage') {
    $command = $_POST['command'];

    switch($command) {
        case 'join':
            if(!username_taken($_POST['username'])) {
                join_user($_POST['username'], $_POST['password'], $_POST['email']);
                $display_type = 'showLogin';
                include('index.php');
            } else {
                $join_error_message = 'Username ' . $_POST['username'] . ' already exists';
                $display_type = 'showJoin';
                include('index.php');
            }
        break;
        case 'login':
            if(!valid_user($_POST['username'], $_POST['password'])) {
                $error_message = '* Wrong Username Or Password';
                $display_type = 'showLogin';
                include('index.php');
            } else {
                $_SESSION['SignIn'] = 'Yes';
                $_SESSION['username'] = $_POST['username'];
                $_SESSION['userID'] = get_user_id($_POST['username']);
                include('mainpage.php');
            }
        break;
    }
}  else if($_POST['page'] == 'MainPage') {
    $command = $_POST['command'];

    switch($command) {
        case 'SignOut':
            sign_out();
            include('index.php');
        break;
        case 'AddMeal':
            $mealName = $_POST['meal'];
            $calories = $_POST['calories'];
            add_meal($_SESSION['userID'], $mealName,$calories);
            include('mainpage.php');
        break;
    }

} else if($_POST['page'] == 'ProfilePage') {
    $command = $_POST['command'];

    switch($command) {
        case 'SignOut':
            sign_out();
            include('index.php');
    }
}

