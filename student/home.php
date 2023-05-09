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
    <title>home</title>
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
    <h1 class="text">HOME - STUDENT</h1>
    <?php
    $id = $_COOKIE['id'];
    $sql = "select courseID, name, grade from grade inner join course on courseID = id where studentID = $id And grade != ''";
    $result = mysqli_query($connection, $sql);
    if (mysqli_num_rows($result) > 0) {
        echo '<table class="table table-striped table-dark" border="1">';
        echo "<tr>";
        echo "<th scope='col'>course number</th>";
        echo "<th scope='col'>course name</th>";
        echo "<th scope='col'>grade</th>";
        echo "</tr>";
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>" . $row['courseID'] . "</td>";
            echo "<td>" . $row['name'] . "</td>";
            echo "<td>" . $row['grade'] . "</td>";
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo '<h3 style="text-align: center; color: #007bff">NO DATA</h3>';
    }
    ?>
    <div class="add-btn">
        <a href="addStudentCourse.php" class="btn btn-outline-dark" name="addBtn">Add Course</a>
    </div>
    <?php mysqli_close($connection); ?>
</body>

</html>