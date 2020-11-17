<?php
if (!isset($_SESSION)) session_start();

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
            <li class="nav-item"><a class="nav-link" href="controller.php" id="logoutMainPage">Logout</a></li>
            <li class='nav-item'><a class="nav-link" id='searchResource' data-toggle='modal' data-target='#modal-search-resource'>Search Resource List</a></li>
        </ul>
    </div>
</nav>

<!-- MainPage logout -->
<form style="display: inline-block" action="controller.php" method="post" id="mainpageSignOut">
    <input type='hidden' name='page' value='MainPage'>
    <input type='hidden' name='command' value='SignOut'>
</form>


<!-- Modal Window for SearchResources -->
<div class='modal fade' id='modal-search-resource'>
    <div class='modal-dialog'>
        <div class='modal-content'>
            <form class='' method='post' action='controller.php'>
                <div class='modal-header'>
                    <h2 class='modal-title'>Search Resource List</h2>
                </div>
                <div class='modal-body'>
                    <input type='hidden' name='page' value='MainPage'>
                    <input type='hidden' name='command' value='SearchResources'>
                    <div class='form-group'>
                        <label class="control-label" for="searchTerm">Search term:</label>
                        <input type="text" class="form-control" id="searchTerm" name='searchTerm'
                               placeholder="Search For A Resource">
                    </div>
                </div>
                <div class='modal-footer'>
                    <div class="form-group">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-primary" data-dismiss="modal" id="searchSubmitButton">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- ADD MEALS -->
<form action="controller.php" method="post" class="form-horizontal"
      style="margin: 0.8vh auto; border: 0.4vh solid black; width: 40%; text-align: center;">
    <input type="hidden" name="page" value="MainPage">
    <input type="hidden" name="command" value="AddMeal">

    <div style="margin: 1vh 0.5vh;">
        <input style="display: block; margin: 1.2vh auto" type="text" placeholder="Enter Meal Name" name="meal" aria-label="Enter Meal Name" required>
        <input style="display: block; margin: 1.2vh auto" type="text" placeholder="Enter Calories" name="calories" aria-label="Enter Calories" required>
    </div>

    <button type="submit" class="btn btn-primary" style="margin: 1vh auto;">Submit</button>
    <button type="button" class="btn btn-warning" id="getMealsButton" style="margin: 1vh auto;">Get Meals</button>
</form>

<!-- ADD EXERCISES -->
<form action="controller.php" method="post" class="form-horizontal" style="margin: 0.8vh auto; border: 0.4vh solid black; width: 40%; text-align: center;">
    <input type="hidden" name="page" value="MainPage">
    <input type="hidden" name="command" value="AddExercise">

    <div style="margin: 1vh 0.5vh;">
        <input style="display: block; margin: 1.2vh auto" type="text" placeholder="Enter Exercise name" name="exercise" aria-label="Enter Exercise Name" required>
        <input style="display: block; margin: 1.2vh auto" type="text" placeholder="Enter Sets" name="sets" aria-label="Enter Sets" required>
        <input style="display: block; margin: 1.2vh auto" type="text" placeholder="Enter Reps" name="reps" aria-label="Enter Reps" required>
        <input style="display: block; margin: 1.2vh auto" type="text" placeholder="Enter Weight" name="weight" aria-label="Enter Weight" required>
    </div>

    <button type="submit" class="btn btn-primary" style="margin: 1vh auto;">Submit</button>
    <button type="button" class="btn btn-warning" id="getExercisesButton" style="margin: 1vh auto;">View Lifts</button>
</form>


<!-- ADD SLEEP -->
<form action="controller.php" method="post" class="form-horizontal" style="margin: 0.8vh auto; border: 0.4vh solid black; width: 40%; text-align: center;">
    <input type="hidden" name="page" value="MainPage">
    <input type="hidden" name="command" value="AddSleep">

    <div style="margin: 1vh 0.5vh;">
        <input style="display: block; margin: 1.2vh auto" type="text" placeholder="Enter Hours of Sleep" name="sleep" aria-label="Enter Sleep" required>
    </div>

    <button type="submit" class="btn btn-primary" style="margin: 1vh auto;">Submit</button>
    <button type="button" class="btn btn-warning" id="getSleepButton" style="margin: 1vh auto;">View Sleep</button>
</form>


<!-- CALC BMI -->
<div style="margin: 0.8vh auto; border: 0.4vh solid black; width: 40%; text-align: center;">
    <h3>Calculate Your BMI</h3>
    <p>Please remember, BMI does not take into account muscle mass, bone density, overall body composition, race or sex differences
        <a href="https://www.medicalnewstoday.com/articles/265215">Medial News Today</a></p>
    <div style="margin: 1vh 0.5vh;">
        <input style="display: block; margin: 1.2vh auto;" type="text" placeholder="Enter Weight (KG)" id="weight" aria-label="Enter Weight">
    </div>
    <div style="margin: 1vh 0.5vh;">
        <input style="display: block; margin: 1.2vh auto;" type="text" placeholder="Enter Height (CM)" id="height" aria-label="Enter Weight">
    </div>
    <div style="margin: 1vh 0.5vh;">
        <p id="displayBMI" style="border: 1px solid black; display: none; padding: 1.2vh;"></p>
    </div>
    <button type="submit" class="btn btn-primary" id="bmiButton" style="margin: 1vh auto; width: 80%;">Submit</button>
    <button type="submit" class="btn btn-primary" id="clearBmiButton" style="margin: 1vh auto; width: 80%;">Clear</button>
</div>

<!-- RESOURCE LIST -->
<form action="controller.php" method="post" style="margin: 0.8vh auto; border: 0.4vh solid black; width: 40%; text-align: center;">
    <input type="hidden" name="page" value="MainPage">
    <input type="hidden" name="command" value="AddResource">

    <div style="margin: 1vh 0.5vh;">
        <input style="display: block; margin: 1.2vh auto" type="text" placeholder="Enter Resource Title" name="title" aria-label="Enter Resource Title" required>
        <input style="display: block; margin: 1.2vh auto" type="text" placeholder="Enter Resource Link" name="link" aria-label="Enter Resource Link" required>
    </div>
    <button type="submit" class="btn btn-primary">Add Resource</button>
    <button type="button" class="btn btn-warning" id="getResourcesList" style="margin: 1vh auto;">View Resources</button>

</form>

<hr>

<!-- Result -->
<div class='container' id='result-pane'>
    <?php
    if (!empty($result)) {
        echo $result;
    }
    ?>
</div>


<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
        crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx"
        crossorigin="anonymous"></script>
</body>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"
        integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
<script>

    $('#getMealsButton').click(function () {
        $.post('controller.php', {
            page: 'MainPage',
            command: 'GetMeals'
        }, function (data) {
            let row = JSON.parse(data);
            if (row.length) {
                let table = "<table class='table'>";
                table += "<thead class='thead-dark'><th>Meal</th><th>Calories</th><th>Date(YYYYMMDD)</th></thead>";
                for (let index = 0; index < row.length; index++) {
                    table += "<tr>";
                    for (let property in row[index]) {
                        table += "<td>" + (row[index][property]) + "</td>";
                    }
                    table += "</tr>";
                }
                table += "</table>";
                $('#result-pane').html(table);
            } else {
                $('#result-pane').html("<div class='alert alert-danger' role='alert'>No Meals To Show <button type='button' class='close' data-dismiss='alert' aria-label='Close'> <span aria-hidden='true'>&times;</span> </button> </div>");
            }
        })
    })

    $('#getExercisesButton').click(function () {
        $.post('controller.php', {
            page: 'MainPage',
            command: 'GetExercises'
        }, function (data) {
            let row = JSON.parse(data);
            if (row.length) {
                let table = "<table class='table'>";
                table += "<thead class='thead-dark'><th>Exercise</th><th>Sets</th><th>Reps</th><th>Weight</th><th>Total</th><th>Date (YYYYMMDD)</th></thead>";
                for (let index = 0; index < row.length; index++) {
                    table += "<tr>";
                    for (let property in row[index]) {
                        table += "<td>" + (row[index][property]) + "</td>";
                    }
                    table += "</tr>";
                }
                table += "</table>";
                $('#result-pane').html(table);
            } else {
                $('#result-pane').html("<div class='alert alert-danger' role='alert'>No Exercises To Show<button type='button' class='close' data-dismiss='alert' aria-label='Close'> <span aria-hidden='true'>&times;</span> </button> </div>");
            }
        })
    })

    $('#getSleepButton').click(function () {
        $.post('controller.php', {
            page: 'MainPage',
            command: 'GetSleep'
        }, function (data) {
            let row = JSON.parse(data);
            if (row.length) {
                let table = "<table class='table'>";
                table += "<thead class='thead-dark'><th>Hours of Sleep</th><th>Date (YYYYMMDD)</th></thead>";
                for (let index = 0; index < row.length; index++) {
                    table += "<tr>";
                    for (let property in row[index]) {
                        table += "<td>" + (row[index][property]) + "</td>";
                    }
                    table += "</tr>";
                }
                table += "</table>";
                $('#result-pane').html(table);
            } else {
                $('#result-pane').html("<div class='alert alert-danger' role='alert'>No Sleep Tracked<button type='button' class='close' data-dismiss='alert' aria-label='Close'> <span aria-hidden='true'>&times;</span> </button> </div>");
            }
        })
    })

    $('#logoutProfile').click(function(){
        $('#mainpageSignOut').submit();
    })

    $('#bmiButton').click(function() {
        let BMI = Math.floor(($('#weight').val() / Math.pow($('#height').val(),2)) * 10000);
        let bmiCategory;
            if(BMI < 18.5) {
                bmiCategory = 'Underweight'
            } else if(BMI >= 18.5 && BMI < 25) {
                bmiCategory  = 'Normal Weight';
            } else if(BMI >= 25 && BMI < 30) {
                bmiCategory  = 'Overweight';
            } else {
                bmiCategory  = 'Obese';
        }

        $('#displayBMI').css('display','inline-block').html((isNaN(BMI) ? 'Please Enter Values' : `Current BMI: ${BMI}, Category: ${bmiCategory}`));

    })

    $('#clearBmiButton').click(function() {
        $('#weight').val('');
        $('#height').val('');
        $('#displayBMI').css('display','none');
    })

    $('#getResourcesList').click(function () {
        $.post('controller.php', {
            page: 'MainPage',
            command: 'GetResources'
        }, function (data) {
            let row = JSON.parse(data);
            if (row.length) {
                let table = "<table class='table resourceTable'>";
                table += "<thead class='thead-dark'><th>Delete</th><th>Title</th><th>Link</th><th>ID</th></thead>";
                for (let index = 0; index < row.length; index++) {
                    table += "<tr class='rows'>";
                    table += "<td><button class='btn btn-danger deleteItem'>Delete</button></td>";

                    for (let property in row[index]) {
                        table += "<td>" + (row[index][property]) + "</td>";
                    }
                    table += "</tr>";
                }
                table += "</table>";
                $('#result-pane').html(table);
            } else {
                $('#result-pane').html("<div class='alert alert-danger' role='alert'>No Resources in List<button type='button' class='close' data-dismiss='alert' aria-label='Close'> <span aria-hidden='true'>&times;</span> </button> </div>");
            }
        })
    })


    $(document).on('click', '.deleteItem', function() {
        let row= ($('.rows').index($(this).closest('tr')));
        let rowID;

        if($('.rows').length >  1) {
            rowID = $('.rows').siblings()[row].children[3].innerHTML;
        } else {
            rowID = $('.rows').closest('table').children('tbody').children('tr.rows')[0].children[3].innerHTML;
        }

        $.post('controller.php', {
            page: 'MainPage',
            command: 'DeleteItem',
            r_id: rowID
        }, function(){
            $('#result-pane').html("<div class='alert alert-success' role='alert'>Item Removed, Request Resources<button type='button' class='close' data-dismiss='alert' aria-label='Close'> <span aria-hidden='true'>&times;</span> </button> </div>");
        })
    })

    $('button#searchSubmitButton').click(function() {
        $.post('controller.php', {
            page: 'MainPage',
            command: 'SearchResources',
            searchTerm: $('#searchTerm').val()
        }, function(data) {
            let row = JSON.parse(data);
            if (row.length) {
                let table = "<table class='table resourceTable'>";
                table += "<thead class='thead-dark'><th>Delete</th><th>Title</th><th>Link</th><th>ID</th></thead>";
                for (let index = 0; index < row.length; index++) {
                    table += "<tr class='rows'>";
                    table += "<td><button class='btn btn-danger deleteItem'>Delete</button></td>";

                    for (let property in row[index]) {
                        table += "<td>" + (row[index][property]) + "</td>";
                    }
                    table += "</tr>";
                }
                table += "</table>";
                $('#result-pane').html(table);
            } else {
                $('#result-pane').html("<div class='alert alert-danger' role='alert'>No Resources in List<button type='button' class='close' data-dismiss='alert' aria-label='Close'> <span aria-hidden='true'>&times;</span> </button> </div>");
            }
        })
    })


</script>

