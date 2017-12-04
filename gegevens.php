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
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/login-gegevens.css">
</head>
<body>
    <div class="container">
        <?php include('includes/header.inc.php'); ?>
        
        <div class="elementFlex">
            <div>
                <div class="elementLabel"><p>Aantal ontvangers:</p></div>
                <div class="elementLabel"><p><?php echo $countReceivers[0]; ?></p></div>
            </div>
            <div>
                <div class="elementLabel"><p>Aantal geopend:</p></div>
                <div class="elementLabel"><p><?php echo $countViewedReceivers[0]; ?></p></div>
            </div>
            <div>
                <div class="elementLabel"><p>Responsratio:</p></div>
                <div class="elementLabel"><p><?php echo round($responseRatio, 3) . ' %'; ?></p></div>
            </div>
            <div>
                <a class="logout" href="logout.php">Logout</a>
            </div>
        </div>
    </div>
</body>
</html>
