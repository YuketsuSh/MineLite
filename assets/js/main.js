document.addEventListener('DOMContentLoaded', () => {
    const copyBtn = document.querySelector('.copy-server-ip');

    if (!copyBtn) return;

    copyBtn.addEventListener('click', () => {
        const ip = copyBtn.getAttribute('data-server-ip');
        if (!ip) return;

        if (navigator.clipboard && navigator.clipboard.writeText) {
            navigator.clipboard.writeText(ip).then(() => {
                showStatusMessage('Adresse IP copiée dans le presse-papier !');
            }).catch(err => {
                console.error("Erreur lors de la copie de l'IP :", err);
                fallbackCopyText(ip);
            });
        } else {
            fallbackCopyText(ip);
        }
    });
});

function fallbackCopyText(text) {
    const textarea = document.createElement("textarea");
    textarea.value = text;
    textarea.setAttribute('readonly', '');
    textarea.style.position = 'absolute';
    textarea.style.left = '-9999px';
    document.body.appendChild(textarea);
    textarea.select();

    try {
        const success = document.execCommand('copy');
        showStatusMessage(success ? 'Adresse IP copiée !' : 'Échec de la copie.');
    } catch (err) {
        console.error("Fallback copy failed :", err);
    }

    document.body.removeChild(textarea);
}

function showStatusMessage(message) {
    const statusContainer = document.createElement('div');
    statusContainer.id = 'status-message';
    statusContainer.className = 'alert alert-success';
    statusContainer.textContent = message;

    document.body.appendChild(statusContainer);

    setTimeout(() => {
        statusContainer.classList.add('show');
    }, 10);

    setTimeout(() => {
        statusContainer.classList.remove('show');
        statusContainer.addEventListener('transitionend', () => statusContainer.remove());
    }, 3000);
}
