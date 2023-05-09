<?php
require_once('../../database/connection.php');
if (!isset($_COOKIE['user'])) {
    header('Location:../../error/error.php');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../../style/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</head>

<body>
    <?php
    $msg = "";

    if (isset($_GET["id"])) {
        $sql = "SELECT * FROM course where id = '" .  $_GET["id"] . "'";
        $result = mysqli_query($connection, $sql);
        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
        }
    }



    if ($_SERVER['REQUEST_METHOD'] === "POST") {
        if (isset($_REQUEST['submitEdit'])) {
            $id = $_GET['id'];
            $name = $_POST['name'];
            $teacher = $_POST['teacher'];

            if (
                !empty($id)
                && !empty($name)
                && !empty($teacher)
            ) {
                echo "<br>";
                $sql = "UPDATE course SET name='" . $name . "', teacherID=" . $teacher . " WHERE id='" . $id . "' ";
                echo $sql;
                $result = mysqli_query($connection, $sql);
                if ($result == true) {
                    $msg = '<div style="color: green; text-align: center;">Edited successful</div>';
                }
            } else {
                $msg = '<div style="color: red; text-align: center;">Edited Failed</div>';
            }
        }
    }
    ?>
    <h1 class="text">Admin - Home - Edit Course</h1>
    <form action="<?php $_SERVER['PHP_SELF'] . "?id=" . $_GET["id"] ?>" method="POST" class="container-custom">
        <label for="id">Number: </label>
        <input type="text" name="id" id="id" value="<?= ((isset($row)) ? $row['id'] : '') ?>" <?php echo ((isset($row)) ? 'disabled' : '') ?> placeholder="Enter Course Number...">
        <br>
        <label for="name">Name: </label>
        <input type="text" name="name" id="name" value="<?= ((isset($row)) ? $row['name'] : '') ?>" placeholder="Enter student name...">
        <br>
        <select name="teacher" id="teacher" class="custom-select">
            <?php
            $sql = "SELECT * FROM teacher";
            $result = mysqli_query($connection, $sql);
            while ($row2 = mysqli_fetch_assoc($result)) {
                $selected = $row['teacherID'] ==  $row2['id'] ? "selected" : "";
                echo '<option value="' . $row2['id'] . '" ' . $selected . ' >' . $row2['name'] . '</option>';
            }
            ?>
        </select>
        <br>
        <?php
        echo $msg
        ?>
        <br>
        <input type="submit" class="btn btn-outline-dark" value="Edit" name="submitEdit">
    </form>
    <?php mysqli_close($connection); ?>
</body>

</html>