<?php
$filename = 'results.txt';
$ip_filename = 'ips.txt';
$user_ip = $_SERVER['REMOTE_ADDR'];

if (file_exists($ip_filename) && strpos(file_get_contents($ip_filename), $user_ip) !== false) {
    echo "<p>Jūs jau esat aizpildījis šo aptauju. Paldies par dalību!</p>";
} else {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $vecums = htmlspecialchars($_POST['vecums']);
        $vertesana = htmlspecialchars($_POST['vertesana']);
        $privatums = htmlspecialchars($_POST['privatums']);
        $noluki = !empty($_POST['noluki']) ? implode(', ', array_map('htmlspecialchars', $_POST['noluki'])) : 'Nav norādīti';
        $komentari = !empty($_POST['komentari']) ? nl2br(htmlspecialchars($_POST['komentari'])) : 'Nav norādīti';

        $data = "Vecums: $vecums\nVērtējums: $vertesana\nPrivātums: $privatums\nPieņemamie nolūki: $noluki\nKomentāri: $komentari\n---\n";
        file_put_contents($filename, $data, FILE_APPEND);
        file_put_contents($ip_filename, $user_ip . "\n", FILE_APPEND);

        echo "<p>Paldies par dalību aptaujā!</p>";
    } else {
        echo "<p>Kļūda! Lūdzu, mēģiniet vēlreiz.</p>";
    }
}
?>
