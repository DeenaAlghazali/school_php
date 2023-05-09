<?php
session_start();

require_once('database/connection.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="style/style.css">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</head>

<body>
    <?php
    $msg = "";
    $user_type = $_COOKIE['user-type'];
    if ($_SERVER['REQUEST_METHOD'] === "POST") {
        if (isset($_POST['submitBtn'])) {
            $email = validate_input($_POST['email']);
            $password = $_POST['password'];
            if (!empty($email) && !empty($password)) {
                $sql = "SELECT * FROM $user_type WHERE email='" . $email . "' And password = '" . $password . "';";
                $result = mysqli_query($connection, $sql);
                if (mysqli_num_rows($result) == 1) {
                    $row = mysqli_fetch_assoc($result);
                    setcookie("id", $row['id'], time() + (86400 * 30), "/finalProject/$user_type");
                    setcookie("user", $row['name'], time() + (86400 * 30), "/finalProject/$user_type");
                    setcookie("image", $row['image'], time() + (86400 * 30), "/finalProject/$user_type");
                    $_SESSION['user'] = $row['name'];
                    header("Location:$user_type/home.php");
                } else {
                    $msg = "Login Failed";
                }
            } else {
                $msg = "Login Failed";
            }
        }
    }

    function validate_input($input)
    {
        $input = trim($input);
        $input = stripslashes($input);
        $input = htmlspecialchars($input);
        return $input;
    }

    ?>

    <div class="gray-background">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="card mb-5 p-5  bg-dark bg-gradient text-white col-md-4">
                    <div class="card-header text-center">
                        <h3>WELCOME <?php echo strtoupper($user_type) ?></h3>
                        <img src="images/login4.png" alt="" width="100px" height="100px"><br>
                    </div>
                    <div class="card-body mt-3">
                        <form name="login" action="<?php $_SERVER['PHP_SELF'] ?>" method="POST">
                            <div class="input-group form-group mt-3">
                                <input type="email" class="form-control text-center p-3" placeholder="Email" name="email">
                            </div>
                            <div class="input-group form-group mt-3">
                                <input type="password" class="form-control text-center p-3" placeholder="Password" name="password">
                            </div>
                            <div class="text-center">
                                <input type="submit" value="Login" class="btn btn-primary mt-3 w-100 p-2" name="submitBtn">
                            </div>
                        </form>
                    </div>
                    <div class="card-footer p-3">
                        <div class="d-flex justify-content-center">
                            <div class="text-primary">If you are a registered user,
                                login here.
                                <br>
                                <p style="text-align: center; color: red;"><?php echo isset($_POST['submitBtn']) ? $msg : '' ?></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>