<?php
require 'funtion.php';
if (isset($_POST['login'])) {

    $username = $_POST["username"];
    $password = $_POST["password"];

    $result = mysqli_query($connectdb, "SELECT * FROM users WHERE Username = '$username'");

    if (mysqli_num_rows($result) === 1) {
        //cekk password
        $row = mysqli_fetch_assoc($result);
        if (password_verify($password, $row["Password"])) {

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

    <?php if(isset($error)) :?>
        <p style="color: red; font-style: italic">Username/Password Salah!</p>
    <?php endif; ?>

    <form action="" method="post">
        <label for="username">Username</label>
        <input type="text" name="username" id="username">
        <br>
        <label for="password">Password</label>
        <input type="password" name="password" id="password">
        <br>
        <br>
        <button type="submit" name="login">Login</button>

    </form>

</body>

</html>