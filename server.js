const express = require("express");
const fs = require("fs");
const cors = require("cors");
const app = express();
const PORT = 3000;

app.use(express.json());
app.use(cors()); // Atļauj pieprasījumus no cita domēna

const resultsFile = "results.txt";
const ipFile = "ips.txt";
const cookieFile = "cookies_results.txt";

// Funkcija, lai pārbaudītu, vai IP jau iesniedzis datus
function hasSubmitted(ip) {
    if (fs.existsSync(ipFile)) {
        const ips = fs.readFileSync(ipFile, "utf8").split("\n");
        return ips.includes(ip);
    }
    return false;
}

// Endpoint aptaujas datu saglabāšanai
app.post("/save", (req, res) => {
    const userIP = req.headers["x-forwarded-for"] || req.socket.remoteAddress;

    if (hasSubmitted(userIP)) {
        return res.status(400).json({ message: "Jūs jau esat aizpildījis aptauju. Paldies!" });
    }

    const { vecums, vertesana, privatums, komentari } = req.body;

    if (!vecums || !vertesana || !privatums) {
        return res.status(400).json({ message: "Trūkst nepieciešamo datu!" });
    }

    const data = `Vecums: ${vecums}\nVērtējums: ${vertesana}\nPrivātums: ${privatums}\nKomentāri: ${komentari || "Nav komentāru"}\n---\n`;

    try {
        fs.appendFileSync(resultsFile, data);
        fs.appendFileSync(ipFile, userIP + "\n");
        res.json({ message: "Paldies par dalību aptaujā!" });
    } catch (error) {
        res.status(500).json({ message: "Kļūda saglabājot datus!", error: error.message });
    }
});

// Endpoint sīkdatņu izvēles saglabāšanai
app.post("/cookies", (req, res) => {
    const { choice } = req.body;

    if (!choice) {
        return res.status(400).json({ message: "Trūkst izvēles datu!" });
    }

    const entry = `Choice: ${choice}\nIP: Simulated-IP\n---\n`;

    try {
        fs.appendFileSync(cookieFile, entry);
        res.json({ message: "Sīkdatņu izvēle saglabāta!" });
    } catch (error) {
        res.status(500).json({ message: "Kļūda saglabājot izvēli!", error: error.message });
    }
});

// Servera palaišana
app.listen(PORT, () => {
    console.log(`✅ Serveris darbojas: http://localhost:${PORT}`);
});
