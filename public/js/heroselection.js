function openHeroSelectionModal() {
    const modal = document.getElementById('heroSelectionModal');
    const content = document.getElementById('heroSelectionContent');
    modal.classList.add('active');
    
    content.innerHTML = '<div class="loader"></div>';
    
    fetch('/DungeonXplorer/app/controllers/HeroSelectionController.php')
        .then(response => response.text())
        .then(data => {
            content.innerHTML = data;
        })
        .catch(error => {
            content.innerHTML = '<p style="color: #ff6b6b; text-align: center; padding: 50px;">Erreur lors du chargement des personnages</p>';
            console.error('Erreur:', error);
        });
}

function closeHeroSelectionModal() {
    document.getElementById('heroSelectionModal').classList.remove('active');
}

function selectHero(heroId) {
    return fetch('/DungeonXplorer/app/controllers/HeroSelectionController.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: 'hero_id=' + heroId
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            closeHeroSelectionModal();
            // Recharger la page pour mettre à jour le header
            window.location.reload();
        } else {
            alert('Erreur lors de la sélection du personnage');
            throw new Error('Selection failed'); 
        }
    })
    .catch(error => {
        console.error('Erreur:', error);
        alert('Erreur lors de la sélection du personnage');
        throw error; 
    });
}

async function selectHeroAndRedirect(heroId) {
    try {
        await selectHero(heroId);
        window.location.href = '/DungeonXplorer/load';
    } catch(error) {
        console.error('Redirection annulée:', error);
    }
}

document.addEventListener('click', function(e) {
    const btn = e.target.closest('.select-hero-btn');
    
    if (btn) {
        e.stopPropagation();
        e.preventDefault(); 
        
        const heroId = btn.dataset.heroId;
        
        if (btn.classList.contains('redirect')) {
            selectHeroAndRedirect(heroId);
        } else {
            selectHero(heroId);
        }
    }
});