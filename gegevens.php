<?php
session_start();

if(!isset($_SESSION['authTrue'])){
    if(!empty($_POST['username']) && !empty($_POST['password'])) {
        if($_POST['username'] == "tmecards" && $_POST['password'] == 'tm2016card'){
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

include_once('class/db.class.php');
$db = new Db();
$sql = "SELECT count(*) FROM receiver";
$result = $db->conn->query($sql);

if($result)
{
    $countReceivers = $result->fetch_row();
}

$sql = "SELECT count(*) FROM receiver WHERE receiver_viewed = 1";
$result = $db->conn->query($sql);

if($result)
{
    $countViewedReceivers = $result->fetch_row();
}

$responseRatio = ($countViewedReceivers[0] / $countReceivers[0]) * 100;
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Dashboard</title>
    <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet">
    <style>
        body {
            font-family:'Lato', sans-serif;
        }

        .typeNumbers {
            background-color:#f04c25;
            color:white;
            padding:16px;
            display: inline-block;
            width:150px;
        }

        .counting {
            line-height:48px;
            display:inline-block;
        }
    </style>
</head>
<body>
<div class="oneElement">
    <div class="typeNumbers">Aantal ontvangers:</div>
    <div class="counting"><?php echo $countReceivers[0]; ?></div>
</div>

<div class="oneElement">
    <div class="typeNumbers">Aantal geopend:</div>
    <div class="counting"><?php echo $countViewedReceivers[0]; ?></div>
</div>

<div class="oneElement">
    <div class="typeNumbers">Responsratio</div>
    <div class="counting"><?php echo round($responseRatio, 3) . ' %'; ?></div>
</div>

<a href="logout.php">Logout</a>
</body>
</html>
