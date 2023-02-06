<?php
$password = "admin";
$hashed_password = "$2y$10$.g51Nedq5tx3uPRKnqQnreD5RL.Fxud/47lwe4SXT.OdheuRKm2Yq";

echo password_verify($password, $hashed_password);

?>
<br><br><br>
<?php
$admin_password = "r0yston#8**";
$salt = 'SUPER_SALTY';
$hash = md5($admin_password . $salt);
echo $hash;
