<?php
    session_start();
    if(isset($_SESSION['authTrue'])){
        header("Location: respond.php");
    }
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
    <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet">
    <link rel="stylesheet" href="css/login-gegevens.css">
</head>

<body>

    <div class="container">
        <?php include('includes/header.inc.php'); ?>

        <form class="elementFlex" action="respond.php" method="post">
            <div>
                <label class="elementLabel" for="username">Username:</label>
                <input type="text" id="username" name="username">
            </div>
            <div>
                <label class="elementLabel" for="password">Password:</label>
                <input type="password" id="password" name="password">
            </div>
            <div>
                <input class="login" type="submit" name="Inloggen" value="Inloggen">
            </div>
            <?php
                if(isset($_SESSION['loginFailed'])):
            ?>
                <div class="loginFailed">U gebruikt verkeerde login gegevens</div>
            <?php
                unset($_SESSION['loginFailed']);
                endif;
            ?>
        </form>
    </div>
</body>

</html>