<?php

// Check if the directory already exists
if (!is_dir($dirPath)) {
    // Attempt to create the directory
    if (mkdir($dirPath, 0777, true)) {
        $message = "$dirPath Directory created successfully.";
        logMessage($message, $logFile);
    } else {
        $message = "Failed to create $dirPath directory.";
        logMessage($message, $logFile);
    }
} else {
    $message = "Directory already exists.";
    logMessage($message, $logFile);
}

// Set full access permissions (optional, if mkdir does not set them correctly)
if (!chmod($dirPath, 0777)) {
    $message = "Failed to set permissions.";
    logMessage($message, $logFile);
} else {
    $message = "Permissions set successfully.";
    logMessage($message, $logFile);
}
