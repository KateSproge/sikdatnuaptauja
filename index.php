<?php
session_start();

// Skaitītājs privātuma politikas skatījumiem
$policy_counter_file = 'policy-counter.txt';
if (isset($_GET["privacy_view"])) {
    $count = file_exists($policy_counter_file) ? (int)file_get_contents($policy_counter_file) : 0;
    file_put_contents($policy_counter_file, $count + 1);
    exit();
}

// Saglabāt aptaujas rezultātus
$results_file = 'results.txt';
if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST) && !isset($_POST['cookie_choice'])) {
    $results = [];
    foreach ($_POST as $key => $value) {
        if (is_array($value)) {
            $results[] = "$key: " . implode(", ", array_map('htmlspecialchars', $value));
        } else {
            $results[] = "$key: " . htmlspecialchars($value);
        }
    }
    file_put_contents($results_file, implode("\n", $results) . "\n---------------------\n", FILE_APPEND);
    echo "thank_you";
    exit();
}

// Saglabāt sīkdatņu izvēli
$cookieFile = "cookies-results.txt";
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['cookie_choice'])) {
    $status = $_POST['cookie_choice'] === "accept" ? "Piekrita" : "Nepiekrita";

    // Uzskaita "Piekrita" un "Nepiekrita"
    $cookie_counts = ["Piekrita" => 0, "Nepiekrita" => 0];
    if (file_exists($cookieFile)) {
        $lines = file($cookieFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        foreach ($lines as $line) {
            if (preg_match('/^Piekrita: (\d+)$/', $line, $matches)) {
                $cookie_counts["Piekrita"] = (int)$matches[1];
            } elseif (preg_match('/^Nepiekrita: (\d+)$/', $line, $matches)) {
                $cookie_counts["Nepiekrita"] = (int)$matches[1];
            }
        }
    }
    $cookie_counts[$status]++;

    // Saglabā atjaunināto rezultātu
    $newContent = "Piekrita: " . $cookie_counts["Piekrita"] . "\nNepiekrita: " . $cookie_counts["Nepiekrita"] . "\n";
    file_put_contents($cookieFile, $newContent);
    echo "success";
    exit();
}
?>

<!DOCTYPE html>
<html lang="lv">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aptauja par sīkdatnēm</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Aptauja par sīkdatnēm un izsekošanas tehnoloģijām</h1>
    
    <form id="surveyForm">

    <p>
      Sveiki! Esmu Ventspils Augstskolas datorzinātņu 3. kursa studente, un šī
      aptauja ir daļa no mana bakalaura darba. Es vēlos noskaidrot cilvēku
      viedokli par sīkdatņu un izsekošanas tehnoloģiju izmantošanu tīmekļa
      vietnēs. Jūsu atbildes palīdzēs labāk izprast sabiedrības attieksmi pret
      šīm tehnoloģijām un to ietekmi uz privātumu. Aptaujas aizpildīšana aizņems
      tikai dažas minūtes, un visi dati tiks apkopoti anonīmi. 
    </p>
        <label for="vecums">Jūsu vecums:</label><br />
        <input type="number" name="vecums" id="vecums" min="1" required /><br /><br />

        <label>Vai zināt, kas ir sīkdatnes un kā tās darbojas tīmekļa vietnēs?</label><br />
        <input type="radio" name="izpratne" value="Jā" required /> Jā<br />
        <input type="radio" name="izpratne" value="Daļēji" /> Daļēji<br />
        <input type="radio" name="izpratne" value="Nē" /> Nē<br /><br />

        <label>Vai jūs uztraucaties par savu datu drošību tīmekļa vietnēs?</label><br />
        <input type="radio" name="drosiba" value="Jā, ļoti" required> Jā, ļoti<br />
        <input type="radio" name="drosiba" value="Nedaudz"> Nedaudz<br />
        <input type="radio" name="drosiba" value="Nē"> Nē<br /><br />

        <label>Kādas bažas jums rodas, izmantojot sīkdatnes? (Var izvēlēties vairākus)</label><br />
        <input type="checkbox" name="bazas[]" value="Personiskās informācijas izsekošana"> Personiskās informācijas izsekošana<br />
        <input type="checkbox" name="bazas[]" value="Datu nodošana trešajām pusēm"> Datu nodošana trešajām pusēm<br />
        <input type="checkbox" name="bazas[]" value="Reklāmu mērķēšana"> Reklāmu mērķēšana<br />
        <input type="checkbox" name="bazas[]" value="Drošības apdraudējumi"> Drošības apdraudējumi<br />
        <input type="checkbox" name="bazas[]" value="Nav bažu"> Nav bažu<br /><br />

        <label>Vai esat informēti par to, kāda informācija tiek vākta, izmantojot sīkdatnes?</label><br />
        <input type="radio" name="informacija" value="Jā" required /> Jā<br />
        <input type="radio" name="informacija" value="Nē" /> Nē<br /><br /><br />

        <label>Vai Jūs izmantojat pārlūkprogrammu paplašinājumus vai rīkus sīkdatņu bloķēšanai?</label><br>
        <input type="radio" name="blokesana" value="Jā" required> Jā<br>
        <input type="radio" name="blokesana" value="Dažreiz"> Dažreiz<br>
        <input type="radio" name="blokesana" value="Nē"> Nē<br>
        <input type="radio" name="blokesana" value="Nezinu par šādām iespējām"> Nezinu par šādām iespējām<br><br>

        <label>Vai jūs izmantojat iespēju mainīt sīkdatņu preferences, kad apmeklējat tīmekļa vietnes?</label><br />
        <input type="radio" name="preferences" value="Jā" required /> Jā<br />
        <input type="radio" name="preferences" value="Nē" /> Nē<br /><br /><br />

        <label>Vai jūs lasāt privātuma politiku vai sīkdatņu izmantošanas nosacījumus, kad apmeklējat tīmekļa vietnes?</label><br />
        <input type="radio" name="lasisana" value="Jā" required /> Jā<br />
        <input type="radio" name="lasisana" value="Nē" /> Nē<br /><br /><br />

        <label>Kas, jūsuprāt, būtu jādara, lai uzlabotu lietotāju izpratni par sīkdatņu izmantošanu?</label><br />
        <textarea name="ieteikumi"></textarea><br />

        <button type="submit">Iesniegt</button>
        
    </form>

    <p id="thank-you-message" style="display: none; font-weight: bold; color: dark-blue">Paldies par dalību!</p>

    <div id="cookie-popup">
        <p>Mēs izmantojam sīkdatnes. Vai piekrītat?</p>
        <p><a href="privatuma-politika.html" onclick="recordPolicyView()">Lasīt privātuma politiku</a></p>
        <button id="accept-btn" onclick="recordCookieConsent('accept')">Piekrist</button>
        <button id="decline-btn" onclick="recordCookieConsent('decline')">Nepiekrist</button>
    </div>

    <script>
        document.getElementById("surveyForm").addEventListener("submit", function(event) {
            event.preventDefault();

            let formData = new FormData(this);
            fetch("index.php", {
                method: "POST",
                body: formData
            })
            .then(response => response.text())
            .then(data => {
                if (data.trim() === "thank_you") {
                    document.getElementById("surveyForm").style.display = "none";
                    document.getElementById("thank-you-message").style.display = "block";
                }
            })
            .catch(error => console.error("Kļūda:", error));
        });

        function recordPolicyView() {
            fetch("index.php?privacy_view=1");
        }

        function recordCookieConsent(status) {
            fetch("index.php", {
                method: "POST",
                headers: { "Content-Type": "application/x-www-form-urlencoded" },
                body: "cookie_choice=" + status
            })
            .then(response => response.text())
            .then(data => {
                if (data.trim() === "success") {
                    document.getElementById('cookie-popup').style.display = 'none';
                }
            })
            .catch(error => console.error("Kļūda:", error));
        }
    </script>
</body>
</html>
