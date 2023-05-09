<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../style/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</head>

<body>
    <?php
    require_once('../database/connection.php');
    $msg = "";
    if ($_SERVER['REQUEST_METHOD'] === "POST") {
        if (isset($_POST['submitSave'])) {
            $studentCourse = $_POST['studentCourse'];
            $id = $_COOKIE['id'];
            $sql2 = "SELECT * FROM grade WHERE studentID = $id AND courseID = '$studentCourse'";
            $result2 = mysqli_query($connection, $sql2);
            if (mysqli_num_rows($result2) == 0) {
                try {
                    $sql = "INSERT INTO grade (studentID, courseID) VALUES ($id, '$studentCourse')";
                    $result = mysqli_query($connection, $sql);
                    if ($result == true) {
                        $msg = '<div style="color: green; text-align: center;">Added successful</div>';
                    } else {
                        $msg = '<div style="color: red; text-align: center;">Added Failed</div>';
                    }
                } catch (Exception $e) {
                    $msg = '<div style="color: red; text-align: center;">' . $e->getMessage() . '</div>';
                }
            } else {
                $msg = '<div style="color: red; text-align: center;">Added Failed</div>';
            }
        } else {
            $msg = '<div style="color: red; text-align: center;">Added Failed</div>';
        }
    }
    ?>

    <h1 class="text">Add Course</h1>
    <form action="<?php $_SERVER['PHP_SELF'] ?>" method="POST" class="admin-add-teacher">

        <?php
        $sql = "SELECT * FROM course WHERE id NOT IN (SELECT courseID FROM grade WHERE studentID = {$_COOKIE['id']})";
        $result = mysqli_query($connection, $sql);
        if (mysqli_num_rows($result) > 0) {
            echo '<select name="studentCourse" id="studentCourse" class="custom-select">';
            while ($row = mysqli_fetch_assoc($result)) {
                echo '<option value="' . $row['id'] . '">' . $row['name'] . '</option>';
            }
            echo '</select>';
        } else {
            echo '<h3 style="text-align: center; color: #007bff">NO DATA</h3>';
        }
        ?>
        <br>
        <?php
        echo $msg
        ?>
        <br>
        <input type="submit" class="btn btn-outline-dark" value="Save" name="submitSave">
    </form>
    <?php mysqli_close($connection); ?>
</body>

</html>