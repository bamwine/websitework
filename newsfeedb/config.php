<?php
                


/*
 * Config file
 * First create the database before initiating @SiteMine
 * Include all db_connection details in this file
 * db_connection @params
 * @db_host
 * @db_username
 * @db_ pass
 * @db_name
 */


$db_host = "sql305.byetcluster.com ";

$db_username = "b7_21684927";

$db_pass = "bamsbams";

$db_name = "b7_21684927_football";


/*
 * We connect to the database
 * using the given @params
 *
 */

$con = new PDO("mysql:host={$db_host};dbname={$db_name}", $db_username, $db_pass);

$con -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

/**
 * Here we include the class that is going to use
 * this config file to operate
 *
 * The class that has all the processes which is the db class
 */

require_once 'inc/class.SM.php';

/**
 * Then we instantiate a new object of the class db
 * with null @params
 */

$db = new SM($con);
