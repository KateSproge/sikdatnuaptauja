function showCookiePopup() {
    const popup = document.getElementById('cookie-popup');
    popup.style.display = 'block';
}

function handleCookieConsent(choice) {
    fetch('cookie_handler.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: 'choice=' + choice
    }).then(() => {
        document.getElementById('cookie-popup').style.display = 'none';
    });
}

window.onload = () => {
    showCookiePopup();
};
