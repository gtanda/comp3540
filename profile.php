<?php
if(!isset($_SESSION)) session_start();
if (!isset($_SESSION['SignIn'])) {
include('index.php');
exit();
}
?>

<!doctype html>
<html lang="en">

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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
</head>

<body>

<!-- Header -->
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="#">FitTracker Profile</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item"><a class="nav-link" href="mainpage.php">MainPage</a></li>
            <li class="nav-item"><a class="nav-link" href="controller.php" id="logoutProfile">Logout</a></li>
        </ul>
    </div>

    <!-- Signout form -->
    <form style="display: inline-block" action="controller.php" method="post" id="profileSignOut">
        <input type='hidden' name='page' value='ProfilePage'>
        <input type='hidden' name='command' value='SignOut'>
    </form>

</nav>

<div class="container">
    <h1><?php echo 'Hello ' . $_SESSION['username'];?></h1>
</div>

<div class="container" style="padding-top: 2.5vh; border: 1px solid black;">

<img src="" alt="" id="profile" style="display: none; border: 1px solid black; border-radius: 50%;">

<button class="btn btn-danger" data-target="#modalUnsub" data-toggle="modal" style="margin: 1.2vh">Unsubscribe</button>
    <!-- Modal to join user -->
    <div class='modal fade' id='modalUnsub'>
        <div class='modal-dialog'>
            <div class='modal-content'>
                <form method='post' action='controller.php'>
                    <div class='modal-header'>
                        <h2 class='modal-title'>Unsubscribe?</h2>
                    </div>
                    <div class='modal-body'>
                        <input type='hidden' name='page' value='ProfilePage'>
                        <input type='hidden' name='command' value='Unsubscribe'>
                        <div class='form-group'>
                            <p>Are you sure you want to unsubscribe?</p>
                        </div>
                    </div>
                    <div class='modal-footer'>
                        <div class="form-group">
                            <button type="button" class="btn btn-primary" data-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <form action="controller.php" method="post" style="margin: 1.3vh">
        <input type='hidden' name='page' value='ProfilePage'>
        <input type='hidden' name='command' value='ChangeUsername'>
        <input type="text" name="newName" placeholder="Enter New Name" aria-label="Enter New Name" required>
        <button type="submit" class="btn btn-primary btn-sm">Submit new Name</button>
        <?php if(!empty($profile_error_username)) echo $profile_error_username;?>
    </form>

    <form action="controller.php" method="post" style="margin: 1.3vh">
        <input type='hidden' name='page' value='ProfilePage'>
        <input type='hidden' name='command' value='ChangePassword'>
        <input type="password" name="newPassword" placeholder="Enter New Password" aria-label="Enter New Password" required>
        <button type="submit" class="btn btn-primary btn-sm">Submit new Password</button>
    </form>

    <form action="controller.php" method="post" style="margin: 1.3vh" enctype="multipart/form-data">
        <input type='hidden' name='page' value='ProfilePage'>
        <input type='hidden' name='command' value='UploadProfileImage'>
        <input type="file" name="profileImage" style="display: inline-block">
        <button type="submit" class="btn btn-primary btn-sm">Upload Image</button>
    </form>
</div>



<script src="https://code.jquery.com/jquery-3.5.1.min.js"
        integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx"
        crossorigin="anonymous"></script>



<script>
    $('#logoutProfile').click(function(){
        $('#profileSignOut').submit();
    })


    $(document).ready(function() {
        $.post('controller.php', {
            page: 'ProfilePage',
            command: 'GetImage'
        }, function(data) {
            if(data.length > 2) {
                let row = JSON.parse(data);
                let imagePath = row[0].i_name;
                let image = 'images/' + imagePath;
                $('#profile').css('display', 'block').attr({'src': image, 'width': 250 + 'px', 'height': 250 + 'px'});
            }
        })
    });

</script>



</body>
</html>

