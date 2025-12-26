// Toggle du menu déroulant du héros
function toggleHeroMenu() {
    const menu = document.getElementById('heroMenu');
    if (menu) {
        menu.classList.toggle('active');
    }
}

// Fermer le menu si on clique ailleurs
document.addEventListener('click', function(event) {
    const heroContainer = document.querySelector('.hero-avatar-container');
    const menu = document.getElementById('heroMenu');
    
    if (menu && heroContainer) {
        if (!heroContainer.contains(event.target) && !menu.contains(event.target)) {
            menu.classList.remove('active');
        }
    }
});

// Ouvrir la modal de profil - Injecter dans le bon conteneur
function openProfileModal() {
    const modal = document.getElementById('profileModal');
    const modalContent = document.getElementById('profileModalContent');
    const content = document.getElementById('profileContent');
    
    if (modal && content) {
        modal.classList.add('active');
        
        // Réinitialiser le contenu avec juste le loader
        content.innerHTML = '<div class="loader"></div>';
        
        // Charger le contenu du profil depuis ProfileController.php
        fetch('/DungeonXplorer/app/controllers/ProfileController.php', {
            method: 'GET'
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Erreur réseau');
            }
            return response.text();
        })
        .then(html => {
            content.innerHTML = html;
        })
        .catch(error => {
            console.error('Erreur lors du chargement du profil:', error);
            content.innerHTML = '<p class="error-message">Erreur lors du chargement du profil. Veuillez réessayer.</p>';
        });
    }
    
    // Fermer le menu déroulant
    const heroMenu = document.getElementById('heroMenu');
    if (heroMenu) {
        heroMenu.classList.remove('active');
    }
}

// Fermer la modal de profil
function closeProfileModal() {
    const modal = document.getElementById('profileModal');
    if (modal) {
        modal.classList.remove('active');
    }
}

// Sauvegarder le profil
function saveProfile(event) {
    event.preventDefault();
    
    const form = event.target;
    const formData = new FormData(form);
    const submitBtn = form.querySelector('.btn-save');
    
    // Désactiver le bouton pendant l'envoi
    if (submitBtn) {
        submitBtn.disabled = true;
        submitBtn.textContent = 'Sauvegarde...';
    }
    
    fetch('/DungeonXplorer/app/controllers/ProfileController.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // Afficher un message de succès
            const successMsg = document.createElement('div');
            successMsg.className = 'success-message';
            successMsg.textContent = '✓ Profil sauvegardé avec succès !';
            
            const existingMsg = form.querySelector('.success-message, .error-message');
            if (existingMsg) {
                existingMsg.remove();
            }
            
            form.insertBefore(successMsg, form.firstChild);
            
            // Recharger la page après 1.5 secondes pour mettre à jour le header
            setTimeout(() => {
                window.location.reload();
            }, 1500);
        } else {
            throw new Error(data.error || 'Erreur lors de la sauvegarde');
        }
    })
    .catch(error => {
        console.error('Erreur:', error);
        
        const errorMsg = document.createElement('div');
        errorMsg.className = 'error-message';
        errorMsg.textContent = error.message || 'Erreur lors de la sauvegarde du profil.';
        
        const existingMsg = form.querySelector('.success-message, .error-message');
        if (existingMsg) {
            existingMsg.remove();
        }
        
        form.insertBefore(errorMsg, form.firstChild);
        
        // Réactiver le bouton
        if (submitBtn) {
            submitBtn.disabled = false;
            submitBtn.textContent = 'Sauvegarder les modifications';
        }
        
        // Supprimer le message après 5 secondes
        setTimeout(() => {
            errorMsg.remove();
        }, 5000);
    });
}

// Mettre à jour l'aperçu de l'image
function updateImagePreview(url) {
    const preview = document.getElementById('profileImagePreview');
    if (preview && url) {
        preview.src = url;
    }
}

// Fermer les modals avec la touche Échap
document.addEventListener('keydown', function(event) {
    if (event.key === 'Escape') {
        closeProfileModal();
    }
});

// Fermer les modals en cliquant sur le fond
document.addEventListener('click', function(event) {
    if (event.target.id === 'profileModal') {
        closeProfileModal();
    }
});