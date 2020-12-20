<?php

session_start();
require 'funtion.php';

//cek cookie

// if (isset($_COOKIE["login"])) {
//     if ($_COOKIE["login"] == "true") {
//         $_SESSION["login"] = true;
//     }
// }

if (isset($_COOKIE['id']) && isset($_COOKIE['Key'])) {

    $id = $_COOKIE['id'];
    $Key = $_COOKIE['Key'];

    //cek username
    $result = mysqli_query($connectdb, "SELECT Username FROM users WHERE id = $id");
    $row = mysqli_fetch_assoc($result);

    if ($Key === hash('sha256', $row["Username"])){
        $_SESSION['login'] = true; 

    }
}

if (isset($_SESSION["login"])) {
    header("Location: index.php");
    exit;
}

if (isset($_POST['login'])) {

    $username = $_POST["username"];
    $password = $_POST["password"];

    $result = mysqli_query($connectdb, "SELECT * FROM users WHERE Username = '$username'");

    if (mysqli_num_rows($result) === 1) {
        //cekk password
        $row = mysqli_fetch_assoc($result);
        if (password_verify($password, $row["Password"])) {
            //set session
            $_SESSION["login"] = true;

            //cek remember me

            if (isset($_POST["remember"])) {


                setcookie('id', $row['id'], time() + 2592000);
                setcookie('Key', hash('sha256', $row["Username"]), time() + 2592000);
            }

            header("Location: index.php");
            exit;
        }
    }
    $error = true;
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        label {
            display: block;
        }
    </style>
</head>

<body>
    <h1>Halaman Login</h1>

    <?php if (isset($error)) : ?>
        <p style="color: red; font-style: italic">Username/Password Salah!</p>
    <?php endif; ?>

    <form action="" method="post">
        <label for="username">Username</label>
        <input type="text" name="username" id="username">
        <br>
        <label for="password">Password</label>
        <input type="password" name="password" id="password">
        <br>
        <input type="checkbox" name="remember" , id="remember">
        <Label for="remember">Remember me?</Label>
        <br>
        <br>
        <button type="submit" name="login">Login</button>

    </form>

</body>

</html>