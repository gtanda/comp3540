<?php

$conn = mysqli_connect('localhost', 'root', 'mysql', 'project');
// 'localhost', 'gtandaf20' , 'gtandaf20424', 'C354_gtandaf20'
// 'localhost', 'root', 'mysql', 'project'
if(!$conn) {
    die("Error " . mysqli_error($conn));
}
