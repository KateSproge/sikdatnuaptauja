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

        <label>Vai zināt, kas ir sīkdatnes un kā tās darbojas tīmekļa vietnēs?</label><br>
        <input type="radio" name="izpratne" value="Jā" required> Jā<br>
        <input type="radio" name="izpratne" value="Nē"> Nē<br><br>

        <label>Kā Jūs vērtējat sīkdatņu izmantošanu tīmekļa vietnēs?</label><br>
        <input type="radio" name="vertesana" value="Pozitīvi" required> Pozitīvi<br>
        <input type="radio" name="vertesana" value="Neitrāli"> Neitrāli<br>
        <input type="radio" name="vertesana" value="Negatīvi"> Negatīvi<br><br>

        <label>Vai jums šķiet, ka izsekošana tīmekļa vietnēs ir pieņemama?</label><br>
        <input type="radio" name="attieksme" value="Pieņemama" required> Pieņemama<br>
        <input type="radio" name="attieksme" value="Nepieņemama"> Nepieņemama<br><br>

        <label>Vai Jūs uztraucaties par privātumu, ko ietekmē izsekošanas tehnoloģijas?</label><br>
        <input type="radio" name="privatums" value="Jā" required> Jā<br>
        <input type="radio" name="privatums" value="Nē"> Nē<br>
        <input type="radio" name="privatums" value="Nezinu"> Nezinu<br><br>

        <label>Kādiem nolūkiem, Jūsuprāt, ir pieņemami izmantot sīkdatnes? (Var izvēlēties vairākus):</label><br>
        <input type="checkbox" name="noluki[]" value="Reklāmas"> Reklāmas<br>
        <input type="checkbox" name="noluki[]" value="Lietotāju pieredzes uzlabošana"> Lietotāju pieredzes uzlabošana<br>
        <input type="checkbox" name="noluki[]" value="Analītika"> Analītika<br>
        <input type="checkbox" name="noluki[]" value="Cits"> Cits<br><br>

        <label>Vai jums ir svarīgi, lai jūs varētu kontrolēt, kādas sīkdatnes tiek izmantotas?</label><br>
        <input type="radio" name="kontrole" value="Jā" required> Jā<br>
        <input type="radio" name="kontrole" value="Nē"> Nē<br><br>

        <label>Vai esat informēti par to, kādas informācijas tiek vāktas, izmantojot sīkdatnes?</label><br>
        <input type="radio" name="informacija" value="Jā" required> Jā<br>
        <input type="radio" name="informacija" value="Nē"> Nē<br><br>

        <label>Vai jums šķiet, ka uzņēmumiem būtu jāsniedz vairāk informācijas par to, kā tiek izmantotas jūsu dati?</label><br>
        <input type="radio" name="informacija_uznemumi" value="Jā" required> Jā<br>
        <input type="radio" name="informacija_uznemumi" value="Nē"> Nē<br><br>

        <label>Vai jūs izmantojat iespējas mainīt sīkdatņu preferences, kad apmeklējat tīmekļa vietnes?</label><br>
        <input type="radio" name="preferences" value="Jā" required> Jā<br>
        <input type="radio" name="preferences" value="Nē"> Nē<br><br>

        <label>Vai jūs lasāt privātuma politiku vai sīkdatņu izmantošanas nosacījumus, kad apmeklējat tīmekļa vietnes?</label><br>
        <input type="radio" name="lasisana" value="Jā" required> Jā<br>
        <input type="radio" name="lasisana" value="Nē"> Nē<br><br>
        
        <label>Jūsu komentāri vai ieteikumi:</label><br>
        <textarea name="komentari" rows="4" cols="50"></textarea><br><br>

        <input type="submit" value="Iesniegt">
    </form>

    <script src="script.js"></script>
</body>
</html>
