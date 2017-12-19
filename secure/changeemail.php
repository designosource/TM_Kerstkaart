<?php
session_start();

if( isset($_GET['email']) ){
    $_SESSION['savesender']['changeemail'] = $_GET['email'];
}

if(isset($_SESSION['savesender']['changeemail'])){
    header("Location: index.php");
}
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Change email</title>
    <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet">
    <link rel="stylesheet" href="css/changeemail.css">
</head>

<body>

<div class="container">
    <?php include('../includes/header.inc.php'); ?>

    <form class="elementFlex" action="#" method="get">
        <div>
            <label class="elementLabel" for="email">E-mail:</label>
            <input type="text" id="username" name="email">
        </div>
        <div>
            <input class="login" type="submit" name="Inloggen" value="Pas e-mail aan">
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