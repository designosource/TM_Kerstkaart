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

// Check the amount of senders with a specific language after 8/12/2017 18.00h or 1512756000
$statement = $conn->prepare("SELECT count(*) as amount FROM sender WHERE sender_language = 'nl' AND sender_timestamp > 1512756000");
$statement->execute();
$res = $statement->fetchAll();

$nederlands = $res;


$statement2 = $conn->prepare("SELECT count(*) as amount FROM sender WHERE sender_language = 'fr' AND sender_timestamp > 1512756000");
$statement2->execute();
$res2 = $statement2->fetchAll();

$frans = $res2;


$statement3 = $conn->prepare("SELECT count(*) as amount FROM sender WHERE sender_language = 'en' AND sender_timestamp > 1512756000");
$statement3->execute();
$res3 = $statement3->fetchAll();

$engels = $res3;

// http://www.chartjs.org/samples/latest/
// http://www.chartjs.org/samples/latest/charts/pie.html

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

    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.js"></script>
</head>
<body>
<div class="container">
    <?php include('includes/header.inc.php'); ?>

    <?php include('includes/gegevensbuttons.inc.php'); ?>

    <div class="elementFlex">

        <canvas id="chart-area" style="margin: 10px 0 30px 0;"></canvas>

        <div>
            <a class="logout" href="logout.php">Logout</a>
        </div>

    </div>
</div>

<script>

    var nederlands = <?php if(isset($nederlands)){ echo $nederlands[0]['amount'];} ?>;
    var frans = <?php if(isset($frans)){ echo $frans[0]['amount'];} ?>;
    var engels = <?php if(isset($engels)){ echo $engels[0]['amount'];} ?>;

    window.chartColors = {
        blue: '#419AA9',
        orange: '#f04c25',
        gray: '#575757'
    };

    var config = {
        type: 'pie',
        data: {
            datasets: [{
                data: [
                    nederlands,
                    engels,
                    frans,
                ],
                backgroundColor: [
                    window.chartColors.orange,
                    window.chartColors.blue,
                    window.chartColors.gray,
                ],
                label: 'Dataset 1'
            }],
            labels: [
                "Nederlands",
                "Engels",
                "Frans"
            ]
        }
    };

    window.onload = function() {
        var ctx = document.getElementById("chart-area").getContext("2d");
        window.myPie = new Chart(ctx, config);
    };

    var colorNames = Object.keys(window.chartColors);

    document.getElementById('removeDataset').addEventListener('click', function() {
        config.data.datasets.splice(0, 1);
        window.myPie.update();
    });
</script>
</body>
</html>
