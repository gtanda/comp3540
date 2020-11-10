<?php
session_start();
if (!isset($_SESSION['SignIn'])) {
    include('index.php');
    exit();
}
?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>FitTracker</title>
    <style>
        a:hover {
            cursor: pointer;
        }
    </style>

    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css"
          integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">

</head>
<body>
<!-- Header -->
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="index.php">FitTracker Main</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item"><a class="nav-link" href="profile.php">Profile</a></li>
            <li class="nav-item"><a class="nav-link" href="controller.php" id="logoutProfile">
                    <form style="display: inline-block" action="controller.php" method="post">
                        <input type='hidden' name='page' value='MainPage'>
                        <input type='hidden' name='command' value='SignOut'>
                    </form>
                    Logout</a></li>
        </ul>
    </div>
</nav>

<form action="controller.php" method="post" class="form-horizontal" style="margin: 0.8vh auto; border: 0.6vh solid black; width: 40%; text-align: center;">

    <input type="hidden" name="page" value="MainPage">
    <input type="hidden" name="command" value="AddMeal">

    <div style="margin: 1vh 0.5vh;">
        <input type="text" placeholder="Enter Meal Name" name="meal" aria-label="Enter Meal Name">
    </div>

    <div style="margin: 1vh 0.5vh;text-align: center;">
            <input type="text" placeholder="Enter Calories" name="calories" aria-label="Enter Calories">
    </div>

    <button type="submit" class="btn btn-danger" style="margin: 1vh auto;">Submit</button>
</form>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
        crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx"
        crossorigin="anonymous"></script>
</body>
