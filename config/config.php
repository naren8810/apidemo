<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require 'functions.php';

// Define the path to the directory
$dirPath = 'uploads';

// Log file path
$logFile = 'logfile.log';

//create database variables
$servername = 'localhost';
$dbname = 'innovins_db';
$username = 'root';
$password = '';

//create connection object
try {
    //code...
    $conn = new mysqli($servername, $username, $password, $dbname);
    //check connection status
    if ($conn->connect_error) {
        $message = "Message: Database connection failed: " . $conn->connect_error;
        logMessage($message, $logFile);
        die("Message: Database connection failed: " . $conn->connect_error);
    }
} catch (Exception $e) {
    $message = "Message: Database connection failed: " . $e->getMessage();
    logMessage($message, $logFile);
    die("Message: Database connection failed: " . $e->getMessage());
}

// Get the full URI
$uri = $_SERVER['REQUEST_URI'];

// Remove the query string if it exists
$uri = strtok($uri, '?');

// Split the URI into segments
$segments = explode('/', trim($uri, '/'));