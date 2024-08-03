<?php

// Function to log messages
function logMessage($message, $logFile)
{
    file_put_contents($logFile, date('Y-m-d H:i:s') . " - " . $message . PHP_EOL, FILE_APPEND);
}

function getPageURL()
{
    $protocol = 'http://';
    if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on') {
        $protocol = 'https://';
    }

    $host = $_SERVER['HTTP_HOST'];
    $uri = $_SERVER['REQUEST_URI'];

    return $protocol . $host . $uri;
    return $protocol . $host;
}

function getBaseURL()
{
    // Determine the protocol
    $protocol = 'http://';
    if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on') {
        $protocol = 'https://';
    }

    // Get the host name
    $host = $_SERVER['HTTP_HOST'];

    // Get the path to the script
    $script = $_SERVER['SCRIPT_NAME'];

    // Get the directory of the script
    $path = dirname($script);

    // Ensure the path ends with a slash
    if (substr($path, -1) !== '/') {
        $path .= '/';
    }

    // Combine protocol, host, and path to form the base URL
    return $protocol . $host . '/innovins';
}
