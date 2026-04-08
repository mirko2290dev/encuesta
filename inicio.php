<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] !== 'POST' || empty($_POST['curso'])) {
    header("Location: index.html");
    exit;
}

$_SESSION['curso'] = $_POST['curso'];
$_SESSION['started_at'] = date('Y-m-d H:i:s');

header("Location: sexualidad.html");
exit;
?>
