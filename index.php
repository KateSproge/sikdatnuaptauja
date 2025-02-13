<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aptauja par sīkdatnēm</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Aptauja par sīkdatnēm un izsekošanas tehnoloģijām</h1>
    <p>Sveiki! Esmu Ventspils Augstskolas datorzinātņu 3. kursa studente, un šī aptauja ir daļa no mana bakalaura darba. 
       Es vēlos noskaidrot cilvēku viedokli par sīkdatņu un izsekošanas tehnoloģiju izmantošanu tīmekļa vietnēs. 
       Jūsu atbildes palīdzēs labāk izprast sabiedrības attieksmi pret šīm tehnoloģijām un to ietekmi uz privātumu. 
       Aptaujas aizpildīšana aizņems tikai dažas minūtes, un visi dati tiks apkopoti anonīmi. Paldies par jūsu dalību!</p>

    <div id="cookie-popup" style="display: none;">
        <p>Mēs izmantojam sīkdatnes, lai uzlabotu jūsu pieredzi. Vai jūs piekrītat sīkdatņu izmantošanai?</p>
        <button onclick="handleCookieConsent('agree')">Piekrītu</button>
        <button onclick="handleCookieConsent('decline')">Nepiekrītu</button>
    </div>

    <form action="process_form.php" method="post">
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
    </form>

    <script src="script.js"></script>
</body>
</html>
