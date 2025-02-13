<?php
$cookie_results_file = 'cookies_results.txt';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $choice = htmlspecialchars($_POST['choice']);
    $entry = "Choice: $choice\nIP: {$_SERVER['REMOTE_ADDR']}\n---\n";
    file_put_contents($cookie_results_file, $entry, FILE_APPEND);
}
?>
