<?php
/**
 * Created by PhpStorm.
 * User: alsmi_000
 * Date: 11/17/2015
 * Time: 1:45 PM
 */

$title = $_GET['title'];

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "Rancid";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $stmt = $conn->prepare("SELECT * FROM  WHERE title LIKE BINARY '%$title%'");
    $stmt->execute();

    // set the resulting array to associative
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode($result);

}
catch(PDOException $e) {
    //  echo "Error: " . $e->getMessage();
}