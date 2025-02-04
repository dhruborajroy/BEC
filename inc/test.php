<?php
header("Content-Type: application/xml; charset=utf-8");

$site_url = "https://bec.ac.bd"; // Change this to your site URL

echo '<?xml version="1.0" encoding="UTF-8"?>';
echo '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';

// Function to scan all files in the directory
function listFiles($dir) {
    $files = [];
    foreach (scandir($dir) as $file) {
        if ($file !== '.' && $file !== '..' && !is_dir($dir . '/' . $file)) {
            if (preg_match('/\.(php|html)$/', $file)) {
                $files[] = $file;
            }
        }
    }
    return $files;
}

// Get all files in the root directory (change '.' to your folder path if needed)
$pages = listFiles('.');

foreach ($pages as $page) {
    echo "<url><loc>$site_url/$page</loc></url>";
}

echo '</urlset>';
?>
