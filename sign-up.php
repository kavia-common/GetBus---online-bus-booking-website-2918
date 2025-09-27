<?php
require_once __DIR__ . '/config.php';

$name   = isset($_POST['usrnam_name']) ? $_POST['usrnam_name'] : '';
$email  = isset($_POST['mail_name']) ? $_POST['mail_name'] : '';
$number = isset($_POST['contct_name']) ? $_POST['contct_name'] : '';
$pswrd  = isset($_POST['pass_name']) ? $_POST['pass_name'] : '';
$cpswrd = isset($_POST['cpass_name']) ? $_POST['cpass_name'] : '';

if ($name === '' || $email === '' || $number === '' || $pswrd === '' || $cpswrd === '') {
    echo("<font color='red' size='5'>All fields are required.</font>");
    exit;
}

$querry = "INSERT into user__details(name, email, password, cont_num) VALUES('$name', '$email', '$pswrd', $number)";
if (!mysqli_query($db, $querry)) {
    echo("Could not execute query");
    exit;
}

header('location: login_page.html');
exit;
?>
