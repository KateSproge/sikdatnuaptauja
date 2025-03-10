document.addEventListener("DOMContentLoaded", function () {
    console.log("🔄 Lapa ielādēta, pārbaudu sīkdatņu piekrišanu...");

    if (!localStorage.getItem("cookieConsent")) {
        console.log("⚠️ Sīkdatņu piekrišana nav atrasta, rādu popup.");
        document.getElementById("cookie-popup").style.display = "block";
    } else {
        console.log(
            "✅ Sīkdatņu piekrišana atrasta:",
            localStorage.getItem("cookieConsent"),
        );
    }
});

function handleCookieConsent(choice) {
    if (choice !== "agree" && choice !== "decline") return;
    localStorage.setItem("cookieConsent", choice);
    document.getElementById("cookie-popup").style.display = "none";

    fetch("/cookies", {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify({ choice }),
    }).catch((error) => console.error("❌ Kļūda:", error));
}

localStorage.setItem("cookieConsent", choice);
document.getElementById("cookie-popup").style.display = "none";

fetch("/cookies", {
    method: "POST",
    headers: { "Content-Type": "application/json" },
    body: JSON.stringify({ choice }),
})
    .then((response) => {
        if (!response.ok) {
            throw new Error(`HTTP kļūda! Statuss: ${response.status}`);
        }
        return response.json();
    })
    .then((data) => console.log("✅ Sīkdatņu izvēle saglabāta:", data))
    .catch((error) =>
        console.error("❌ Kļūda saglabājot sīkdatņu izvēli:", error),
    );

document
    .getElementById("surveyForm")
    .addEventListener("submit", function (event) {
        event.preventDefault();
        console.log("📩 Aptauja iesniegta!");

        const formData = new FormData(event.target);
        const data = Object.fromEntries(formData.entries());

        console.log("📩 Nosūtāmie dati:", JSON.stringify(data));

        fetch("/save", {
            method: "POST",
            headers: { "Content-Type": "application/json" },
            body: JSON.stringify(data),
        })
            .then((response) => response.json())
            .then((data) => {
                console.log("✅ Aptauja saglabāta:", data);
                document.getElementById("surveyForm").style.display = "none";
                document.getElementById("thank-you-message").style.display =
                    "block";
            })
            .catch((error) =>
                console.error("❌ Kļūda iesniedzot aptauju:", error),
            );
    });
