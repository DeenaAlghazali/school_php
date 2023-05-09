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
    <h1 class="text">Admin - Home - Student profile</h1>
    <?php
    $sql = "SELECT * FROM student Where id =" . $_GET['id'];
    $result = mysqli_query($connection, $sql);
    $row = mysqli_fetch_assoc($result);

    echo '<div class="container-custom profile">';
    echo '<div>';
    echo '<img src="../../images/' . $row['image'] . '" width="100px" height="100px">';
    echo '</div>';
    echo '<div>';
    echo '<p>Name: ' . $row['name'] . '</p>';
    echo '<p>Email: ' . $row['email'] . '</p>';
    echo '<p>Phone: ' . $row['phone'] . '</p>';
    echo '<p>Password: ' . $row['password'] . '</p>';
    echo '</div>';
    echo '</div>';
    mysqli_close($connection);
    ?>
</body>

</html>