<?php
/**
 * Created by PhpStorm.
 * User: Black
 * Date: 3/18/2019
 * Time: 11:52 PM
 */
$servername = "localhost";
$username = "visal";
$password = "visal@123";
$dbname = "examdb";

$conn = new mysqli($servername, $username, $password,$dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}