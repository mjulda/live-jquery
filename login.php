<?php
session_start();
require 'function.php';

if(isset ($_COOKIE['id']) && isset($_COOKIE['key'])){
    $id  = $_COOKIE['id'];
    $key  = $_COOKIE['key'];

    $result = mysqli_query($connecdb, "SELECT username FROM users WHERE id = $id");
    $row = mysqli_fetch_assoc($result);

    // cek kesamaan coockie dan username
    if ($key === hash('sha256', $row['username'])){
        $_SESSION['login'] = true;
    }
}

if (isset($_SESSION["login"])) {
    header("Location: index.php");
    exit;
}
if (isset($_POST["login"])) {
    $username = $_POST["username"];
    $password = $_POST["password"];

    $result = mysqli_query($connecdb, "SELECT * FROM users WHERE username='$username' ");

    // cek username
    // mysqli_num_rows == utk menghitung brp baris yang di kembalikan dari fungsi SELECT * FROM
    if (mysqli_num_rows($result) === 1) {

        // cek password
        $row = mysqli_fetch_assoc($result);
        if (password_verify($password, $row["password"])) {
            // set session
            $_SESSION ["login"] = true;

            // cek coockie
            if (isset ($_POST["remember"])){
                // buat coockie
                // contoh ===== setcookie('login', 'true', time()+60);
                setcookie('id', $row['id'], time()+60);
                setcookie('key', hash('sha256', $row['username']),time()+60);
            }

            header("Location: index.php");
            exit;
        }
    }
    $error =  true;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

</head>

<body>    
    <h1>Halaman Login</h1>
    <?php
    if (isset($error)) : ?>
        <p style="color :red; font-style :italic;">username / password salah!</p>
        <?php endif; ?>
        
        <form action="" method="post">
        <ul>
            <li>
                <label for="username">Username :</label>
                <input type="text" name="username" id="username">
            </li>
            <li>
                <label for="password">Password :</label>
                <input type="password" name="password" id="password">
            </li>
            <li>
                <input type="checkbox" name="remember" id="remember">
                <label for="remember">Remember Me</label>
            </li>
            <li>
                <button type="submit" name="login">Login!</button>
            </li>
            <li>
                <button type="submit" name="register">Registrasi!</button>
            </li>
        </ul>
    </form>
</body>

</html>