function initLootParticles() {
    const particlesContainer = document.getElementById('lootParticles');
    if (!particlesContainer) return;
    
    for (let i = 0; i < 30; i++) {
        const particle = document.createElement('div');
        particle.className = 'particle';
        particle.style.left = Math.random() * 100 + '%';
        particle.style.animationDelay = Math.random() * 2 + 's';
        particle.style.animationDuration = (Math.random() * 2 + 2) + 's';
        particlesContainer.appendChild(particle);
    }
}

// Close loot popup
function closeLootPopup() {
    const overlay = document.getElementById('lootOverlay');
    if (!overlay) return;
    
    overlay.style.animation = 'fadeIn 0.3s reverse';
    setTimeout(() => {
        overlay.remove();
    }, 300);
}

// Close on escape key
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        const overlay = document.getElementById('lootOverlay');
        if (overlay) {
            closeLootPopup();
        }
    }
});

// Initialize particles when page loads
document.addEventListener('DOMContentLoaded', function() {
    initLootParticles();
});