<?php
$connection = mysqli_connect("localhost", 'root', '', 'final_php_project');
if (!$connection) {
    die("Connection Failed" . mysqli_connect_error());
}
