<?php
$DB_HOST = 'localhost';
$DB_USER = 'root';
$DB_PASS = '';
$DB_NAME = 'exam_system';

$conn = new mysqli($DB_HOST, $DB_USER, $DB_PASS, $DB_NAME);
if ($conn->connect_error) { die('DB connection failed: ' . $conn->connect_error); }
$conn->set_charset('utf8mb4');

// Ensure the allow_retake column exists on the exams table
$res = $conn->query("SHOW COLUMNS FROM `exams` LIKE 'allow_retake'");
if ($res && $res->num_rows == 0) {
    $conn->query("ALTER TABLE `exams` ADD `allow_retake` TINYINT(1) NOT NULL DEFAULT 1");
}

// Ensure the time_adjustment column exists on the attempts table
$res2 = $conn->query("SHOW COLUMNS FROM `attempts` LIKE 'time_adjustment'");
if ($res2 && $res2->num_rows == 0) {
    $conn->query("ALTER TABLE `attempts` ADD `time_adjustment` INT NOT NULL DEFAULT 0");
}
?>
