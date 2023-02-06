<?php
include 'inc/header.php';
?>

<div id="page-content-wrapper" style="margin-top:20px;">

    <h1 class="page-header">Admin Panel</h1>
    <hr color="#fff" style="height:2px;">

    <h2>Post Delete</h2>
    <p>All | Published | <a href="" class="active">Deleted</a></p>
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12"  style="background:#fff;">

                <br>
<?php

$db->change_status('deleted', $_GET['id']);
?>