<?php
require_once("indexmodel.php");
require_once("mainpagemodel.php");
require_once("profilemodel.php");

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
            session_unset();
            session_destroy();
            include('index.php');
        break;
        case 'AddMeal':
            $mealName = $_POST['meal'];
            $calories = $_POST['calories'];
            add_meal($_SESSION['userID'], $mealName,$calories);
            include('mainpage.php');
        break;
        case 'GetMeals':
            get_meals($_SESSION['username']);
        break;
        case 'AddExercise':
            $exercise = $_POST['exercise'];
            $sets = $_POST['sets'];
            $reps = $_POST['reps'];
            $weight = $_POST['weight'];
            add_exercise($exercise,$sets,$reps,$weight,$_SESSION['userID']);
            include('mainpage.php');
        break;
        case 'GetExercises':
            get_exercises($_SESSION['username']);
        break;
        case 'AddSleep':
            $sleep = $_POST['sleep'];
            add_sleep($_SESSION['userID'], $sleep);
            include('mainpage.php');
        break;
        case 'GetSleep':
            get_sleep($_SESSION['username']);
        break;
        case 'AddResource':
            $title = $_POST['title'];
            $link = $_POST['link'];
            add_resource($title, $link, $_SESSION['userID']);
            include('mainpage.php');
        break;
        case 'GetResources':
            get_resources_list($_SESSION['username']);
        break;
        case 'DeleteItem':
            $resource_id = $_POST['r_id'];
            delete_item($resource_id);
        break;
        case 'SearchResources':
            search_resources($_POST['searchTerm'], $_SESSION['username']);
        break;
    }

} else if($_POST['page'] == 'ProfilePage') {
    $command = $_POST['command'];

    switch ($command) {
        case 'SignOut':
            session_unset();
            session_destroy();
            include('index.php');
            break;
        case 'Unsubscribe':
            unsubscribe($_SESSION['userID']);
            include('index.php');
        break;
        case 'ChangePassword':
            $newPassword = $_POST['newPassword'];
            change_password($_SESSION['username'], $newPassword);
            session_unset();
            session_destroy();
            include('index.php');
        break;
        case 'ChangeUsername':
            $newUsername = $_POST['newName'];
            if(!username_taken($newUsername)) {
                change_username($_SESSION['username'], $newUsername);
                session_unset();
                session_destroy();
                include('index.php');
            } else {
                $profile_error_username = 'Username [' . $newUsername . '] is already taken';
                include ('profile.php');
            }
    }
}

