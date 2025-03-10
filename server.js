import express from "express";
import fs from "fs";
import cors from "cors";

const PORT = process.env.PORT;

const app = express(); // ✅ Vispirms izveidojam 'app'

app.use(cors({ origin: "*" })); // ✅ Pēc tam izmantojam cors
app.use(express.json());

app.listen(PORT, () => {
    console.log(`✅ Serveris darbojas uz porta ${PORT}`);
});


// Pārbaudīt, vai pieprasījums pienāk ar pareizo `Content-Type`
app.use((req, res, next) => {
    console.log("🔹 Headers:", req.headers);
    console.log("🔹 Body:", req.body);
    next();
});

const resultsFile = "results.txt";
const cookieFile = "cookies_results.txt";

// Funkcija pārbauda, vai fails eksistē
const ensureFileExists = (file) => {
    if (!fs.existsSync(file)) {
        fs.writeFileSync(file, "", { flag: "w" });
        console.log(`📄 Izveidots fails: ${file}`);
    }
};

ensureFileExists("results.txt");
ensureFileExists("cookies_result.txt");

ensureFileExists(resultsFile);
ensureFileExists(cookieFile);

// ✅ PAREIZI definēts "/save" maršruts
app.post("/save", (req, res) => {
    if (!req.body) {
        return res
            .status(400)
            .json({ message: "❌ Pieprasījumam trūkst datu!" });
    }

    const {
        vecums,
        izpratne,
        vertesana,
        attieksme,
        privatums,
        noluki,
        kontrole,
        informacija,
        informacija_uznemumi,
        preferences,
        lasisana,
        komentari,
    } = req.body;

    if (!vecums || !vertesana || !privatums) {
        return res
            .status(400)
            .json({ message: "❌ Trūkst nepieciešamo datu!" });
    }

    const age = parseInt(vecums, 10);
    if (isNaN(age) || age <= 0) {
        return res
            .status(400)
            .json({ message: "❌ Vecumam jābūt pozitīvam skaitlim!" });
    }

    const safeKomentari = komentari
        ? komentari.replace(/(\r\n|\n|\r)/gm, " ")
        : "Nav komentāru";

    const surveyData = `${new Date().toISOString()};${age};${izpratne};${vertesana};${attieksme};${privatums};${noluki ? noluki.join(", ") : "Nav izvēles"};${kontrole};${informacija};${informacija_uznemumi};${preferences};${lasisana};"${safeKomentari}"\n`;

    console.log("📩 Saglabāju aptaujas rezultātus...");

    fs.appendFile("results.txt", surveyData, (err) => {
        if (err) {
            console.error("❌ Kļūda saglabājot aptauju:", err);
            return res
                .status(500)
                .json({ message: "❌ Neizdevās saglabāt datus!" });
        }
        res.json({ message: "✅ Paldies par dalību aptaujā!" });
    });
});

app.use((req, res, next) => {
    console.log("📩 Saņemts pieprasījums:", req.method, req.url);
    console.log("🔹 Headers:", req.headers);
    console.log("🔹 Body:", req.body);
    next();
});

// PAREIZI definēts "/cookies" maršruts
app.post("/cookies", (req, res) => {
    if (!req.body || !req.body.choice) {
        return res.status(400).json({ message: "❌ Nepareiza izvēle!" });
    }

    const { choice } = req.body;
    if (choice !== "agree" && choice !== "decline") {
        return res.status(400).json({ message: "❌ Nepareiza izvēle!" });
    }

    console.log(`📩 Sīkdatņu izvēle: ${choice}`);

    fs.appendFile("cookies-result.txt", `Choice: ${choice}\n`, (err) => {
        if (err) {
            console.error("❌ Kļūda saglabājot sīkdatņu izvēli:", err);
            return res
                .status(500)
                .json({ message: "❌ Kļūda saglabājot datus!" });
        }
        res.json({ message: "✅ Sīkdatņu izvēle saglabāta!" });
    });
});

// Pareiza servera startēšana
app.listen(PORT, () => {
    console.log(`✅ Serveris darbojas uz porta ${PORT}`);
}).on("error", (err) => {
    if (err.code === "EADDRINUSE") {
        console.error("❌ Ports jau tiek izmantots! Serveris netika palaists.");
    } else {
        console.error("❌ Nezināma kļūda:", err);
    }
});

