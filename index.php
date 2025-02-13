<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $vecums = $_POST['vecums'];
    $izpratne = $_POST['izpratne'];
    $vertesana = $_POST['vertesana'];
    $attieksme = $_POST['attieksme'];
    $privatums = $_POST['privatums'];
    $noluki = isset($_POST['noluki']) ? implode(", ", $_POST['noluki']) : "Nav izvēlēts";
    $kontrole = $_POST['kontrole'];
    $informacija = $_POST['informacija'];
    $informacija_uznemumi = $_POST['informacija_uznemumi'];
    $preferences = $_POST['preferences'];
    $lasisana = $_POST['lasisana'];
    $komentari = $_POST['komentari'];
}
?>
