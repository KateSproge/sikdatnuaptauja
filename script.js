function showCookiePopup() {
    if (!localStorage.getItem("cookieConsent")) {
        document.getElementById("cookie-popup").style.display = "block";
    }
}

function handleCookieConsent(choice) {
    localStorage.setItem("cookieConsent", choice); // Saglabā izvēli pārlūkā

    fetch("http://localhost:3000/cookies", {  // Nosūta izvēli uz Node.js serveri
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify({ choice })
    }).then(() => {
        document.getElementById("cookie-popup").style.display = "none";
    }).catch(error => console.error("Kļūda:", error));
}

window.onload = () => {
    showCookiePopup();
};
