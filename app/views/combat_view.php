<link rel="stylesheet" href="/DungeonXplorer/public/css/css_combat.css">
<script src="/DungeonXplorer/public/js/inventory.js" defer></script>
<script src="/DungeonXplorer/public/js/combat.js" defer></script>

<h1>Combat !</h1>

<div class="arena">
    
<div class="card monster-card">
        <h2 id="monster-name">Monstre</h2>
        
        <div id="monster-container" class="char-image-container" style="position: relative;">
            <img id="monster-img" 
                 class="char-img" 
                 src="" 
                 alt="Monstre" 
                 onerror="this.style.display='none'">
        </div>

        <div class="stats-box">
            <div class="bar-container">
                <div id="monster-hp-bar" class="bar-fill hp-fill" style="width: 100%;"></div>
                <span id="monster-hp-text" class="bar-text">--/--</span>
            </div>
        </div>
    </div>

    <div class="card hero-card">
        <h2 id="hero-name">Héros</h2>
        
        <div id="hero-container" class="char-image-container" style="position: relative;">
            <img id="hero-img" class="char-img" src="/DungeonXplorer/public/images/hero_back.png" alt="Héros" onerror="this.style.display='none'">
        </div>

        <div class="stats-box">
            <div class="bar-container">
                <div id="hero-hp-bar" class="bar-fill hp-fill" style="width: 100%;"></div>
                <span id="hero-hp-text" class="bar-text">--/--</span>
            </div>

            <div class="bar-container">
                <div id="hero-mana-bar" class="bar-fill mana-fill" style="width: 100%;"></div>
                <span id="hero-mana-text" class="bar-text">--/--</span>
            </div>
        </div>
    </div>

</div>

<div id="combat-logs" class="log-container">
    <div class="log-entry log-info">Le combat commence... Préparez-vous !</div>
</div>

<div class="controls">
    <button id="btn-attack-phys" class="btn">⚔️ Attaque</button>
    <button id="btn-attack-mag" class="btn magic">✨ Magie (-5 MP)</button>
    <button id="btn-inventory" class="btn btn-potion" onclick="openHeroModal()">🎒 Inventaire</button>
</div>

<div id="heroModal" class="modal">
    <div class="modal-content">
        <span class="close" onclick="closeHeroModal()">&times;</span>
        <div id="heroContent">Chargement...</div>
    </div>
</div>

<div id="notification" style="display:none; position: fixed; top: 20px; right: 20px; padding: 15px; background: #333; color: white; border-radius: 5px; z-index: 1000; border: 1px solid #555;"></div>