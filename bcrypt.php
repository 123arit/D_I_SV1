<?php

$password="newpassword";
$options = [
  'cost' => 11
];

$hashed_password= password_hash($password, PASSWORD_DEFAULT,$options);
echo $hashed_password;

?>