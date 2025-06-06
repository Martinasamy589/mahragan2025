<?php
$host = "localhost";
$user = "root";
$password = "";
$db = "patriarchs"; // غيره حسب اسم قاعدة البيانات

$conn = new mysqli($host, $user, $password, $db);

if ($conn->connect_error) {
    die("فشل الاتصال بقاعدة البيانات: " . $conn->connect_error);
}

session_start();
?>
