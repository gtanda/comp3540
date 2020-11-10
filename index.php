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
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#">FitTracker Home</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" data-target="#modalLogin" data-toggle="modal" id="login">Login</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-target="#modalJoin" data-toggle="modal">Sign Up</a>
                </li>
            </ul>
        </div>
    </nav>

    <!-- Modal to login user -->
    <div class='modal fade' id='modalLogin'>
        <div class='modal-dialog'>
            <div class='modal-content'>
                <form method='post' action='controller.php'>
                    <div class='modal-header'>
                        <h2 class='modal-title'>Login</h2>
                    </div>
                    <div class='modal-body'>
                        <input type='hidden' name='page' value='IndexPage'>
                        <input type='hidden' name='command' value='login'>
                        <div class='form-group'>
                            <input type="text" class="form-control" name='username'
                                   placeholder="Enter username" aria-label="username" required>
                            <?php if(!empty($error_message)) echo $error_message;?>
                        </div>
                        <div class='form-group'>
                            <input type="password" class="form-control"  name='password'
                                   placeholder="Enter password" aria-label="password" required>
                        </div>
                    </div>
                    <div class='modal-footer'>
                        <div class="form-group">
                            <button type="button" class="btn btn-primary" id="loginModalClose">Cancel</button>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal to join user -->
    <div class='modal fade' id='modalJoin'>
        <div class='modal-dialog'>
            <div class='modal-content'>
                <form method='post' action='controller.php'>
                    <div class='modal-header'>
                        <h2 class='modal-title'>Join</h2>
                    </div>
                    <div class='modal-body'>
                        <input type='hidden' name='page' value='IndexPage'>
                        <input type='hidden' name='command' value='join'>
                        <div class='form-group'>
                            <input type="text" class="form-control" name='username'
                                   placeholder="Enter username" aria-label="username" required><?php if(!empty($join_error_message)) echo $join_error_message;?>
                        </div>
                        <div class='form-group'>
                            <input type="password" class="form-control" name='password'
                                   placeholder="Enter password" aria-label="password" required>
                        </div>
                        <div class='form-group'>
                            <input type="email" class="form-control" name='email'
                                   placeholder="Enter email" aria-label="email" required>
                        </div>
                    </div>
                    <div class='modal-footer'>
                        <div class="form-group">
                            <button type="button" class="btn btn-primary" id="joinModalClose">Cancel</button>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>

    </body>
</html>

<script>

    <?php
    if(!empty($display_type) && $display_type == 'showJoin') {
        echo 'showJoin();';
    } else if(!empty($display_type) && $display_type == 'showLogin') {
        echo 'showLogin();';
    }
    ?>


    function showJoin() {
        $('#modalJoin').modal('show');
    }

    function showLogin() {
        $('#modalLogin').modal('show');
    }

    $('#joinModalClose').click(function(){
        $('#modalJoin').modal('hide');
    });

    $('#loginModalClose').click(function(){
        $('#modalLogin').modal('hide');
    });

</script>