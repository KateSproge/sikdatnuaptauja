const express = require("express");
const fs = require("fs");
const cors = require("cors");
const app = express();
const PORT = 3000;

app.use(express.json());
app.use(cors()); // Atļauj pieprasījumus no cita domēna

const resultsFile = "results.txt";
const ipFile = "ips.txt";

function hasSubmitted(ip) {
    if (fs.existsSync(ipFile)) {
        const ips = fs.readFileSync(ipFile, "utf8").split("\n");
        return ips.includes(ip);
    }
    return false;
}

app.post("/save", (req, res) => {
    const userIP = req.headers["x-forwarded-for"] || req.socket.remoteAddress;

    if (hasSubmitted(userIP)) {
        return res.json({ message: "Jūs jau esat aizpildījis aptauju. Paldies!" });
    }

    const { vecums, vertesana, privatums, komentari } = req.body;
    const data = `Vecums: ${vecums}\nVērtējums: ${vertesana}\nPrivātums: ${privatums}\nKomentāri: ${komentari}\n---\n`;

    fs.appendFileSync(resultsFile, data);
    fs.appendFileSync(ipFile, userIP + "\n");

    res.json({ message: "Paldies par dalību aptaujā!" });
});

app.listen(PORT, () => {
    console.log(`Serveris darbojas: http://localhost:${PORT}`);
});
