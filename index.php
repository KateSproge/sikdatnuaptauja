<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aptauja par sīkdatnēm</title>
    <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aptauja par sīkdatnēm</title>
    <link rel="stylesheet" href="stils.css">
</head>
<body>
    <h1>Aptauja par sīkdatnēm un izsekošanas tehnoloģijām</h1>
    <p>Sveiki! Esmu Ventspils Augstskolas datorzinātņu 3. kursa studente, un šī aptauja ir daļa no mana bakalaura darba. 
       Es vēlos noskaidrot cilvēku viedokli par sīkdatņu un izsekošanas tehnoloģiju izmantošanu tīmekļa vietnēs. 
       Jūsu atbildes palīdzēs labāk izprast sabiedrības attieksmi pret šīm tehnoloģijām un to ietekmi uz privātumu. 
       Aptaujas aizpildīšana aizņems tikai dažas minūtes, un visi dati tiks apkopoti anonīmi. Paldies par jūsu dalību!</p>
    <?php
        $filename = 'results.txt'; // Fails, kurā tiek saglabāti aptaujas rezultāti
        //$ip_filename = 'ips.txt'; // Fails, kurā tiek glabātas aizpildītāju IP adreses
        //$user_ip = $_SERVER['REMOTE_ADDR']; // Lietotāja IP adrese

        // Pārbaude, vai lietotājs jau ir aizpildījis aptauju
        if (file_exists($ip_filename) && strpos(file_get_contents($ip_filename), $user_ip) !== false) {
            echo "<p>Jūs jau esat aizpildījis šo aptauju. Paldies par dalību!</p>";
        } else {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                // Apkopojam un saglabājam rezultātus
                $vecums = htmlspecialchars($_POST['vecums']);
                $vertesana = htmlspecialchars($_POST['vertesana']);
                $privatums = htmlspecialchars($_POST['privatums']);
                $noluki = !empty($_POST['noluki']) ? implode(', ', array_map('htmlspecialchars', $_POST['noluki'])) : 'Nav norādīti';
                $komentari = !empty($_POST['komentari']) ? nl2br(htmlspecialchars($_POST['komentari'])) : 'Nav norādīti';

                // Rezultātu formatēšana un saglabāšana
                $data = "Vecums: $vecums\nVērtējums: $vertesana\nPrivātums: $privatums\nPieņemamie nolūki: $noluki\nKomentāri: $komentari\n---\n";
                file_put_contents($filename, $data, FILE_APPEND); // Pievieno rezultātus failā
                file_put_contents($ip_filename, $user_ip . "\n", FILE_APPEND); // Pievieno lietotāja IP failā

                echo "<p>Paldies par dalību aptaujā!</p>";
            } else {
                // Parādām aptaujas formu
                echo '<form action="" method="post">
                    <label>Jūsu vecums:</label><br>
                    <input type="text" name="vecums" required><br><br>

                    <label>Kā Jūs vērtējat sīkdatņu izmantošanu tīmekļa vietnēs?</label><br>
                    <input type="radio" name="vertesana" value="Pozitīvi" required> Pozitīvi<br>
                    <input type="radio" name="vertesana" value="Neitrāli"> Neitrāli<br>
                    <input type="radio" name="vertesana" value="Negatīvi"> Negatīvi<br><br>

                    <label>Vai Jūs uztraucaties par privātumu, ko ietekmē izsekošanas tehnoloģijas?</label><br>
                    <input type="radio" name="privatums" value="Jā" required> Jā<br>
                    <input type="radio" name="privatums" value="Nē"> Nē<br>
                    <input type="radio" name="privatums" value="Nezinu"> Nezinu<br><br>

                    <label>Kādiem nolūkiem, Jūsuprāt, ir pieņemami izmantot sīkdatnes? (Var izvēlēties vairākus):</label><br>
                    <input type="checkbox" name="noluki[]" value="Reklāmas"> Reklāmas<br>
                    <input type="checkbox" name="noluki[]" value="Lietotāju pieredzes uzlabošana"> Lietotāju pieredzes uzlabošana<br>
                    <input type="checkbox" name="noluki[]" value="Analītika"> Analītika<br>
                    <input type="checkbox" name="noluki[]" value="Cits"> Cits<br><br>

                    <label>Jūsu komentāri vai ieteikumi:</label><br>
                    <textarea name="komentari" rows="4" cols="50"></textarea><br><br>

                    <input type="submit" value="Iesniegt">
                </form>';
            }
        }
    ?>
</body>
</html>