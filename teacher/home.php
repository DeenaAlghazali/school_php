<?php
require_once('../database/connection.php');
if (!isset($_COOKIE['user'])) {
    header('Location:../error/error.php');
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="../style/style.css">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</head>

<body>
    <?php
    include_once('../navbar.php');
    ?>
    <h1 class="text">TEACHER - HOME</h1>

    <?php
    $id = $_COOKIE['id'];
    $sql = "select id, name from course where teacherID = " . $id;
    $result = mysqli_query($connection, $sql);
    if (mysqli_num_rows($result) > 0) {
        echo '<div class="home">';
        while ($row = mysqli_fetch_assoc($result)) {
            echo '<a href="addStudentGrade.php?corseid=' . $row['id'] . '" class="btn btn-secondary btn-lg btn-block">';
            echo '<h5 >' . $row['name'] . "</h5>";
            echo '<p >' . $row['id'] . "</p>";
            echo '</a>';
        }
        echo "</div>";
    } else {
        echo '<h3 style="text-align: center; color: #007bff">NO DATA</h3>';
    }
    ?>

    <?php mysqli_close($connection); ?>
</body>

</html>