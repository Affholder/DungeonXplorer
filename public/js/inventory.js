function openHeroModal() {
    const modal = document.getElementById('heroModal');
    const content = document.getElementById('heroContent');
    modal.classList.add('active');
    
    content.innerHTML = '<div class="loader">Chargement...</div>';
    
    fetch('/DungeonXplorer/app/controllers/InventoryController.php')
        .then(response => response.text())
        .then(data => { content.innerHTML = data; })
        .catch(error => { content.innerHTML = '<p>Erreur lors du chargement.</p>'; });
}

function closeHeroModal() {
    const modal = document.getElementById('heroModal');
    if(modal) modal.classList.remove('active');
}

async function useItem(itemId, itemType, event) {
    if (event) event.stopPropagation();
    
    // Vérification tour de jeu
    if (window.game && document.getElementById('combat-logs')) {
        if (window.game.isGameOver) return;
        if (window.game.turn !== 'player' || window.game.isProcessing) {
            showNotification("Ce n'est pas votre tour !", "error");
            return;
        }
    } else {
        if (!confirm('Voulez-vous utiliser cet item ?')) return;
    }
    
    fetch('/DungeonXplorer/app/controllers/ItemActionController.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
        body: 'action=use&item_id=' + itemId
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            showNotification(data.message, 'success');
            
            // 1. Mise à jour de la modale inventaire
            setTimeout(() => { openHeroModal(); }, 200);

            // 2. FORCAGE DE LA MISE A JOUR DU COMBAT
            // On vérifie simplement si 'window.game' existe sur la page
            if (window.game && typeof window.game.syncStatsFromInventory === 'function') {
                console.log("Mise à jour combat via inventaire : ", data.newPv, data.newMana);
                window.game.syncStatsFromInventory(data.newPv, data.newMana, data.message);
                
                if (data.end_turn) {
                    window.game.forceEndTurn();
                }
            }
        } else {
            showNotification(data.error || 'Erreur', 'error');
        }
    })
    .catch(err => {
        console.error(err);
        showNotification("Erreur de communication serveur", "error");
    });
}

// Les fonctions equip/unequip restent inchangées
function equipItem(itemId, event) {
    if (event) event.stopPropagation();
    fetch('/DungeonXplorer/app/controllers/ItemActionController.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
        body: 'action=equip&item_id=' + itemId
    }).then(r => r.json()).then(d => {
        if(d.success) setTimeout(() => openHeroModal(), 200);
        showNotification(d.message || d.error, d.success ? 'success' : 'error');
    });
}

function unequipItem(slot) {
    fetch('/DungeonXplorer/app/controllers/ItemActionController.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
        body: 'action=unequip&slot=' + slot
    }).then(r => r.json()).then(d => {
        if(d.success) setTimeout(() => openHeroModal(), 200);
        showNotification(d.message || d.error, d.success ? 'success' : 'error');
    });
}

function showNotification(message, type = 'info') {
    let notification = document.getElementById('notification');
    if (!notification) {
        notification = document.createElement('div');
        notification.id = 'notification';
        document.body.appendChild(notification);
    }
    notification.className = 'notification notification-' + type;
    notification.textContent = message;
    notification.style.display = 'block';
    setTimeout(() => { notification.style.display = 'none'; }, 3000);
}

window.onclick = function(event) {
    const heroModal = document.getElementById('heroModal');
    if (event.target == heroModal) closeHeroModal();
}