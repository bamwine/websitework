<?php
session_start();

require_once 'config.php';

if($db->is_logged())
{
    $db->redirect('index.php');
}


if($db->is_logged() !="")
{

    $db->logout();

    $db->redirect('index.php');
}
?>