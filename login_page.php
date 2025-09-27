<?php
require_once __DIR__ . '/config.php';

$name = isset($_POST['eml']) ? $_POST['eml'] : '';
$pswrd = isset($_POST['pass']) ? $_POST['pass'] : '';

if ($name === '' || $pswrd === '') {
    echo("<font size='5' color='red'>Missing credentials.</font>");
    exit;
}

$querry = "SELECT * FROM user__details WHERE email='$name' AND password='$pswrd'";
$result = mysqli_query($db, $querry);
if (!$result) {
    echo("<font size='5' color='red'>Could not execute query</font>");
    exit;
}

if (mysqli_num_rows($result) == 1) {
    header('location: landing_page.php');
    exit;
} else {
    echo("<font size='5' color='red'>Invalid user id or password</font>");
}
