<?php
// DB credentials.
define('DB_HOST','sql103.byetcluster.com');
define('DB_USER','b9_22737707');
define('DB_PASS','bamsbams');
define('DB_NAME','b9_22737707_comac');
// Establish database connection.
try
{
$dbh = new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME,DB_USER, DB_PASS,array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
}
catch (PDOException $e)
{
exit("Error: " . $e->getMessage());
}
?>
