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
    if ($_SERVER['REQUEST_METHOD'] === "POST") {
        if (isset($_REQUEST['submitSave'])) {
            $name = $_POST['name'];
            $email = $_POST['email'];
            $phone = $_POST['phone'];
            $password = $_POST['password'];
            $image  = "";
            if (
                !empty($name)
                && !empty($email)
                && !empty($phone)
                && !empty($password)
            ) {
                if (isset($_FILES["image"]) && $_FILES["image"]["error"] == 0) {
                    $target_dir = "../../images/";
                    $target_file = $target_dir . basename($_FILES["image"]["name"]);
                    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
                    $allowed_types = array("jpg", "jpeg", "png", "gif");
                    if (in_array($imageFileType, $allowed_types)) {
                        // Upload file to server
                        if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
                            $image = basename($_FILES["image"]["name"]);
                            // echo "The file " . basename($_FILES["image"]["name"]) . " has been uploaded.";
                        } else {
                            echo "Sorry, there was an error uploading your file.";
                        }
                    } else {
                        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
                    }
                }
                $sql2 = "SELECT * FROM student WHERE email = '$email'";
                $result2 = mysqli_query($connection, $sql2);
                if (mysqli_num_rows($result2) == 0) {
                    $sql = "INSERT INTO student (name, email, password, phone, image) VALUES ('$name', '$email', '$password', '$phone', '$image');";
                    $result = mysqli_query($connection, $sql);
                    if ($result == true) {
                        $msg = '<div style="color: green; text-align: center;">added successful</div>';
                    }
                } else {
                    $msg = '<div style="color: red; text-align: center;">Email is used please try another one</div>';
                }
            } else {
                $msg = '<div style="color: red; text-align: center;">added Failed</div>';
            }
        }
    }
    ?>
    <h1 class="text">Admin - Home - Add Student</h1>
    <form action="<?php $_SERVER['PHP_SELF'] ?>" method="POST" class="admin-add-teacher" enctype="multipart/form-data">
        <label for="name">Name: </label>
        <input type="text" name="name" id="name" placeholder="Enter student name...">
        <br>
        <label for="email">Email: </label>
        <input type="text" name="email" id="email" placeholder="Enter student Email...">
        <br>
        <label for="phone">Phone: </label>
        <input type="text" name="phone" id="phone" placeholder="Enter student Phone...">
        <br>
        <label for="password">Password: </label>
        <input type="text" name="password" id="password" placeholder="Enter student Password...">
        <br>
        <label for="image">Image: </label>
        <input type="file" name="image" id="image">
        <br>
        <?php
        echo $msg
        ?>
        <br>
        <input type="submit" class="btn btn-outline-dark" value="Save" name="submitSave">
    </form>
</body>

</html>