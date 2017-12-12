<?php
    session_start();

    if(!isset($_SESSION['authTrue'])){
        if(!empty($_POST['username']) && !empty($_POST['password'])) {
            if($_POST['username'] == "tmecards" && $_POST['password'] == 'tm2017card'){
                $_SESSION['authTrue'] = true;
            } else {
                $_SESSION['loginFailed'] = true;
                header("Location: login.php");
            }
        } else {
            header("Location: login.php");
        }
    } else {

    }

    include_once('class/dbemail.class.php');
    $conn = DbEmail::getInstance();

    // Check the amount of receivers after 8/12/2017 18.00h or 1512756000
    $statement = $conn->prepare("SELECT count(*) as amount FROM receiver WHERE sender_id IN ( SELECT sender_id FROM sender WHERE sender_timestamp >1512756000)");
    $statement->execute();
    $res = $statement->fetchAll();

    $countReceivers = $res;


    $statement2 = $conn->prepare("SELECT COUNT( * ) AS amount FROM receiver WHERE receiver_viewed = 1 AND sender_id IN ( SELECT sender_id FROM sender WHERE sender_timestamp >1512756000)");
    $statement2->execute();
    $countViewedReceivers = $statement2->fetchAll();

    $responseRatio = round(($countViewedReceivers[0]['amount'] / $countReceivers[0]['amount']) * 100, 3);

?><!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Dashboard</title>
    <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet">
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/login-gegevens.css">

    <style>

        .percentage-bar-inner
        {
            animation-name: fillbar;
            animation-duration: 1s;
            animation-delay: 0.5s;
            animation-fill-mode: forwards;
            -webkit-animation-name: fillbar;
            -webkit-animation-duration: 1s;
            -webkit-animation-delay: 0.5s;
            -webkit-animation-fill-mode: forwards;
            -moz-animation-name: fillbar;
            -moz-animation-duration: 1s;
            -moz-animation-delay: 0.5s;
            -moz-animation-fill-mode: forwards;
            -o-animation-name: fillbar;
            -o-animation-duration: 1s;
            -o-animation-delay: 0.5s;
            -o-animation-fill-mode: forwards;
        }

        @keyframes fillbar
        {
            from {width: 0;}
            to {width: <?php echo $responseRatio; ?>%;}
        }
    </style>

</head>
<body>
    <div class="container">
        <?php include('includes/header.inc.php'); ?>

        <?php include('includes/gegevensbuttons.inc.php'); ?>
        
        <div class="elementFlex">
            <div>
                <div class="elementLabel"><p>Aantal ontvangers:</p></div>
                <div class="elementLabel"><p><?php if(isset($countReceivers)){ echo $countReceivers[0]['amount'];} ?></p></div>
            </div>
            <div>
                <div class="elementLabel"><p>Aantal geopend:</p></div>
                <div class="elementLabel"><p><?php if(isset($countViewedReceivers)){ echo $countViewedReceivers[0]['amount'];} ?></p></div>
            </div>
            <div>
                <div class="elementLabel"><p>Responsratio:</p></div>
                <div class="elementLabel">
                    <div class="percentage-bar-container">

                        <div class="percentage-bar-inner"></div>
                        <p class="percentage-bar-text"><?php if(isset($responseRatio)){echo $responseRatio . '%';} ?></p>

                    </div>
                </div>
            </div>
            <div>
                <a class="logout" href="logout.php">Logout</a>
            </div>
        </div>
    </div>

</body>
</html>
