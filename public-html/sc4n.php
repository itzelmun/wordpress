<?php
$link = mysqli_connect('mysql-wordpress', 'user', 'psswrd-proyecto-user!');
if (!$link) {
die('Could not connect: ' . mysqli_error());
}

echo 'Connected successfully';
mysqli_close($link);
?>