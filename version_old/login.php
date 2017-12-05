<?php
    session_start();
    if(isset($_SESSION['authTrue'])){
        header("Location: gegevens.php");
    }
?><!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
    <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet">
    <style>
        body {
            font-family:'Lato', sans-serif;
        }

        label {
            background-color:#f04c25;
            color:white;
            padding:16px;
            display: inline-block;
            width:75px;
        }
    </style>
</head>
<body>
<?php
    if(isset($_SESSION['loginFailed'])):
?>
<div class="loginFailed">U gebruikt verkeerde login gegevens</div>
<?php
    unset($_SESSION['loginFailed']);
    endif;
?>
<form action="gegevens.php" method="post">
    <div class="oneElement">
        <label for="username">Username</label>
        <input type="text" id="username" name="username">
    </div>

    <div class="oneElement">
        <label for="password">Password</label>
        <input type="password" id="password" name="password">
    </div>

    <div class="oneElement">
        <input type="submit" name="Inloggen" value="Inloggen">
    </div>
</form>
</body>
</html>