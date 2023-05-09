<?php
require_once("../../database/connection.php");
$id = $_GET['id'];
$sql = "DELETE FROM teacher WHERE id = $id";

$result = mysqli_query($connection, $sql);
if ($result) {
    header("Location:adminTeachers.php");
}
