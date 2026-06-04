<?php

$url = getenv('SitemapUrl');

// Parse .env manually since this script is executed outside the framework context
if (!$url && file_exists(__DIR__ . '/.env')) {
    $envLines = file(__DIR__ . '/.env', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($envLines as $line) {
        if (strpos(trim($line), '#') === 0) {
            continue;
        }
        if (strpos($line, '=') !== false) {
            list($key, $value) = explode('=', $line, 2);
            $key = trim($key);
            $value = trim($value);
            // Remove surrounding quotes
            $value = trim($value, "\"'");
            if ($key === 'SitemapUrl') {
                $url = $value;
                break;
            }
        }
    }
}

if (!$url) {
    header("HTTP/1.1 404 Not Found");
    header("Content-Type: text/plain; charset=utf-8");
    echo "Sitemap URL not configured in .env";
    exit;
}

// Log directly to server error log instead of standard output to avoid corrupting XML
error_log('URL do Sitemap: ' . $url);

$ch = curl_init();

// Support local development bypass for XAMPP DNS issues on Windows
if (stripos($url, 'localhost') !== false) {
    $curlUrl = str_ireplace('localhost', '127.0.0.1', $url);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Host: localhost'));
} else {
    $curlUrl = $url;
}

curl_setopt($ch, CURLOPT_URL, $curlUrl);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
curl_setopt($ch, CURLOPT_TIMEOUT, 10);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

$response = curl_exec($ch);
$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

curl_close($ch);

if ($httpCode === 200 && $response !== false) {
    // Strip CodeIgniter debug view comments if present
    $response = preg_replace('/<!-- DEBUG-VIEW[\s\S]*?-->/', '', $response);
    
    // Find the start of the XML content to strip any leading characters or comments
    $xmlStart = strpos($response, '<urlset xmlns=');
    if ($xmlStart !== false) {
        $response = substr($response, $xmlStart);
    } else {
        $urlsetStart = strpos($response, '<urlset');
        if ($urlsetStart !== false) {
            $response = '<?xml version="1.0" encoding="UTF-8"?>' . "\n" . substr($response, $urlsetStart);
        }
    }
    
    $response = trim($response);

    header("Content-Type: application/xml; charset=utf-8");
    echo $response;
} else {
    header("HTTP/1.1 500 Internal Server Error");
    header("Content-Type: text/plain; charset=utf-8");
    echo "Erro ao carregar o sitemap da API. HTTP Code: " . $httpCode;
}
