<?php

$host = 'localhost';
$user = 'root';
$password = '';
$database = 'pos-app';

$conn = new mysqli($host, $user, $password, $database);

if ($conn->connect_error) {
    die("Koneksi database gagal: " . $conn->connect_error);
}
