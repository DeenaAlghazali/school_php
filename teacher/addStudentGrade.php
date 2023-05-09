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
    <h1 class="text">Add - Student - Grade</h1>
    <form action="<?php $_SERVER['PHP_SELF'] . "?corseid=" . $_GET['corseid'] ?>" method="POST" class="grade-form">
        <label for="student">Student: </label>

        <?php
        $id = $_COOKIE['id'];
        $sql = "SELECT *, student.name, course.id as courseName, grade.grade
            FROM grade
            join student  on studentID = student.id
            join course on courseID = course.id
            WHERE teacherID = $id AND courseID ='" . $_GET['corseid'] . "' And grade = ''";
        $result = mysqli_query($connection, $sql);
        if (mysqli_num_rows($result) == 0) {
            echo "All students were evaluated";
        } else {
            echo '<select name="selectStudent" id="student" class="custom-select">';
            while ($row = mysqli_fetch_assoc($result)) {
                echo '<option value="' .  $row['studentID'] . '">' . $row['name'] . '</option>';
            }
            echo '</select>';
        }

        ?>

        <br>
        <label for="grade">Grade: </label>
        <input type="text" name="grade" id="grade">
        <input class="btn btn-outline-dark" type="submit" value="Save" name="saveBtn">
    </form>

    <?php
    if ($_SERVER['REQUEST_METHOD'] === "POST") {
        if (isset($_REQUEST['saveBtn'])) {
            $selectStudent = $_REQUEST['selectStudent'];
            $grade = $_REQUEST['grade'];
            if (!empty($selectStudent) && !empty($grade)) {
                $sql = "UPDATE grade set grade = '" . $grade . "' WHERE courseID = '" . $_GET['corseid'] . "' AND studentID =" . $selectStudent . ";";
                $result = mysqli_query($connection, $sql);
                if ($result == true) {
                    echo '<div style="color: green; margin-left: 5rem;">added successful</div>';
                }
            } else {
                echo '<div style="color: red; margin-left: 5rem;">added Failed</div>';
            }
        }
    }
    mysqli_close($connection);
    ?>

</body>

</html>