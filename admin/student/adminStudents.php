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
    <h1 class="text">Admin - Home - Students</h1>
    <table class="table table-striped table-dark admin-teacher-table">
        <?php
        $sql = "SELECT * FROM student";
        $result = mysqli_query($connection, $sql);
        if (mysqli_num_rows($result) > 0) {
            echo "<tr>
                <th>name</th>
                <th>phone</th>
                <th>edit</th>
                <th>profile</th>
                <th>delete</th>
            </tr>";
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>" . $row['name'] . "</td>";
                echo "<td>" . $row['phone'] . "</td>";
                echo "<td>";
                echo '<a href="editStudent.php?id=' . $row['id'] . '" class="btn btn-secondary btn-lg active"> ' . 'Edit</a>';
                echo "</td>";
                echo "<td>";
                echo '<a href="profileStudent.php?id=' . $row['id'] . '" class="btn btn-primary btn-lg active"> ' . 'profile</a>';
                echo "</td>";
                echo "<td>";
                echo '<a href="deleteStudent.php?id=' . $row['id'] . '" class="btn btn-danger btn-lg active" > ' . 'Delete</a>';
                echo "</td>";
                echo "</tr>";
            }
        } else {
            echo '<h3 style="text-align: center; color: #007bff">NO DATA</h3>';
        }
        ?>
    </table>
    <div class="add-btn">
        <a href="addStudent.php" class="btn btn-outline-dark">Add</a>
    </div>
    <?php mysqli_close($connection); ?>

</body>

</html>