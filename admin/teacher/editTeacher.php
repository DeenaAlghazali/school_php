<?php
require_once("../../database/connection.php");
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
</head>

<body>
    <?php
    $msg = "";
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $query = "SELECT * FROM teacher WHERE id = $id";
        $result = mysqli_query($connection, $query);
        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
        }
    }

    if ($_SERVER['REQUEST_METHOD'] === "POST") {
        if (isset($_REQUEST['submitEdit'])) {
            $name = $_POST['name'];
            $email = $_POST['email'];
            $phone = $_POST['phone'];
            $password = $_POST['password'];
            $imageURL  = $_POST['image'];
            $id = $_GET['id'];
            if (
                !empty($name)
                && !empty($email)
                && !empty($password)
                && !empty($phone)
            ) {
                $sql = "UPDATE teacher SET name ='" . $name . "', email='" . $email . "', phone='" . $phone . "', password ='" . $password . "', image = '" . $imageURL . "' WHERE id = $id ";
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
    <h1 class="text">Admin - Home - Edit Teacher</h1>
    <form action="<?php $_SERVER['PHP_SELF'] . "?id=" . $_GET['id'] ?>" method="POST" class="container-custom">
        <label for="name">Name: </label>
        <input type="text" name="name" id="name" value="<?= ((isset($row)) ? $row['name'] : '') ?>">
        <br>
        <label for="email">Email: </label>
        <input type="text" name="email" id="email" value="<?= ((isset($row)) ? $row['email'] : '') ?>">
        <br>
        <label for="phone">Phone: </label>
        <input type="text" name="phone" id="phone" value="<?= ((isset($row)) ? $row['phone'] : '') ?>">
        <br>
        <label for="password">Password: </label>
        <input type="text" name="password" id="password" value="<?= ((isset($row)) ? $row['password'] : '') ?>">
        <br>
        <label for="image">Image: </label>
        <input type="file" name="image" id="image" value="<?= ((isset($row)) ? $row['image'] : '') ?>">
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