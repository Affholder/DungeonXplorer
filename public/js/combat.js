class CombatGame {
    constructor() {
        this.hero = null;
        this.monster = null;
        this.turn = 'player';
        this.isGameOver = false;
        this.isProcessing = false;
        
        const pathParts = window.location.pathname.split('/');
        const rootIndex = pathParts.indexOf('DungeonXplorer');
        if (rootIndex !== -1) {
            this.baseURL = '/' + pathParts.slice(1, rootIndex + 1).join('/') + '/';
        } else {
            this.baseURL = '/DungeonXplorer/';
        }

        this.init();
    }

    async init() {
        try {
            const response = await fetch(this.baseURL + 'combat/data');
            const text = await response.text();
            
            try {
                const data = JSON.parse(text);

                if (data.success) {
                    this.hero = data.hero;
                    this.monster = data.monster;
                    
                    this.hero.pv = parseInt(this.hero.pv);
                    this.hero.pv_max = parseInt(this.hero.pv_max);
                    this.hero.mana = parseInt(this.hero.mana);
                    this.hero.mana_max = parseInt(this.hero.mana_max);
                    this.monster.pv = parseInt(this.monster.pv);
                    this.monster.pv_max = parseInt(this.monster.pv_max);

                    this.updateUI();
                    this.log("Un " + this.monster.name + " hostile apparaît !", "info");
                    this.attachListeners();
                } else {
                    this.log("Erreur : " + (data.error || "Problème données"), "dmg");
                }
            } catch (e) {
                console.error(text);
            }
        } catch (error) {
            console.error(error);
        }
    }

    attachListeners() {
        const btnPhys = document.getElementById('btn-attack-phys');
        const btnMag = document.getElementById('btn-attack-mag');
        
        if (btnPhys) {
            btnPhys.onclick = null; 
            btnPhys.onclick = () => this.playerAction('physique');
        }
        if (btnMag) {
            btnMag.onclick = null;
            btnMag.onclick = () => this.playerAction('magique');
        }
    }

    playerAction(type) {
        if (!this.hero || this.isGameOver || this.turn !== 'player' || this.isProcessing) return;

        let actionDone = false;

        if (type === 'physique') {
            this.isProcessing = true;
            const roll = Math.floor(Math.random() * 6) + 1;
            const dmg = Math.max(1, (roll + parseInt(this.hero.strength)) - parseInt(this.monster.armor_bonus || 0));
            
            this.monster.pv -= dmg;
            this.animateDamage('monster', dmg, 'dmg');
            this.log(`Attaque : ${dmg} dégâts !`, "info");
            actionDone = true;

        } else if (type === 'magique') {
            if (this.hero.mana < 5) {
                this.log("Pas assez de mana !", "dmg");
                return;
            }
            this.isProcessing = true;
            this.hero.mana -= 5;
            const dmg = Math.floor(Math.random() * 10) + 5;
            
            this.monster.pv -= dmg;
            this.animateDamage('monster', dmg, 'magic');
            this.log(`Magie : ${dmg} dégâts !`, "magic");
            actionDone = true;
        }

        if (actionDone) {
            this.updateUI();
            
            if (this.monster.pv <= 0) {
                this.monster.pv = 0;
                this.endGame('hero');
                return;
            }

            this.turn = 'monster';
            this.toggleControls(false);
            setTimeout(() => this.monsterTurn(), 1000);
        }
    }

    monsterTurn() {
        if (this.isGameOver) return;

        const roll = Math.floor(Math.random() * 6) + 1;
        const dmg = Math.max(1, (parseInt(this.monster.strength) + roll) - parseInt(this.hero.armor_bonus || 0));

        this.hero.pv = Math.max(0, this.hero.pv - dmg);
        this.animateDamage('hero', dmg, 'dmg');
        this.log(`${this.monster.name} riposte : -${dmg} PV !`, "dmg");

        this.updateUI();

        if (this.hero.pv <= 0) {
            this.hero.pv = 0;
            this.endGame('monster');
        } else {
            this.turn = 'player';
            this.isProcessing = false;
            this.toggleControls(true);
            this.log("C'est à votre tour.", "info");
        }
    }

    syncStatsFromInventory(newPv, newMana, message) {
        this.hero.pv = parseInt(newPv);
        this.hero.mana = parseInt(newMana);
        
        this.animateDamage('hero', 'Soin', 'heal'); 
        this.updateUI();
        this.log("Inventaire : " + message, "heal");
    }

    forceEndTurn() {
        this.turn = 'monster';
        this.toggleControls(false);
        setTimeout(() => this.monsterTurn(), 1000);
    }

    updateUI() {
        if(!this.hero || !this.monster) return;

        const safeSetText = (id, text) => {
            const el = document.getElementById(id);
            if(el) el.innerText = text;
        };
        const safeSetWidth = (id, current, max) => {
            const el = document.getElementById(id);
            const pct = max > 0 ? (parseInt(current) / parseInt(max)) * 100 : 0;
            if(el) el.style.width = Math.max(0, pct) + '%';
        };

        safeSetWidth('hero-hp-bar', this.hero.pv, this.hero.pv_max);
        safeSetText('hero-hp-text', `${this.hero.pv} / ${this.hero.pv_max}`);
        
        safeSetWidth('hero-mana-bar', this.hero.mana, this.hero.mana_max);
        safeSetText('hero-mana-text', `${this.hero.mana} / ${this.hero.mana_max}`);
        
        safeSetWidth('monster-hp-bar', this.monster.pv, this.monster.pv_max);
        safeSetText('monster-hp-text', `${this.monster.pv} / ${this.monster.pv_max}`);
        
        safeSetText('hero-name', this.hero.name);
        safeSetText('monster-name', this.monster.name);

        const mImg = document.getElementById('monster-img');
        
        // CORRECTION ICI : Utilisation de mon_image et vérification du chemin
        const rawImage = this.monster.mon_image || this.monster.image;
        
        if (mImg && rawImage) {
            let imagePath = rawImage;
            
            // Si le chemin ne commence pas par / ni http, on ajoute le dossier par défaut
            if (!imagePath.startsWith('/') && !imagePath.startsWith('http')) {
                imagePath = '/DungeonXplorer/public/images/enemies/' + imagePath;
            }
            // Sinon, on garde le chemin tel quel (cas de ton sanglier)
            
            if (decodeURI(mImg.src).indexOf(imagePath) === -1) {
                mImg.src = imagePath;
                mImg.style.display = 'block';
            }
        }
    }

    animateDamage(target, amount, type) {
        const container = document.getElementById(target + '-container');
        if(!container) return;
        
        const floatText = document.createElement('div');
        floatText.classList.add('floating-text');
        floatText.innerText = (type === 'dmg' ? '-' : '+') + amount;
        
        floatText.style.position = 'absolute';
        floatText.style.left = '50%';
        floatText.style.top = '0';
        floatText.style.transform = 'translate(-50%, -50%)';
        floatText.style.fontWeight = 'bold';
        floatText.style.fontSize = '24px';
        floatText.style.zIndex = '100';
        if (type === 'heal') floatText.style.color = '#2ecc71';
        else if (type === 'magic' && target !== 'hero') floatText.style.color = '#3498db';
        else floatText.style.color = '#e74c3c';

        container.appendChild(floatText);
        
        floatText.animate([
            { top: '0', opacity: 1 },
            { top: '-50px', opacity: 0 }
        ], { duration: 1000, fill: 'forwards' });

        setTimeout(() => floatText.remove(), 1000);
        
        if (type === 'dmg') {
             const img = container.querySelector('img');
             if(img) {
                 img.classList.remove('shake');
                 void img.offsetWidth;
                 img.classList.add('shake');
             }
        }
    }

    log(msg, type) {
        const box = document.getElementById('combat-logs');
        if(box) {
            const color = type==='dmg'?'red':(type==='heal'?'green':'black');
            box.innerHTML = `<div class='log-entry' style='color:${color}; margin-bottom: 5px;'>${msg}</div>` + box.innerHTML;
        }
    }

    toggleControls(enable) {
        const buttons = document.querySelectorAll('.btn-action');
        buttons.forEach(b => b.disabled = !enable);
    }
    
    async endGame(winner) {
        this.isGameOver = true;
        const msg = winner === 'hero' ? "VICTOIRE !" : "DÉFAITE...";
        this.log(`--- ${msg} ---`, winner === 'hero' ? 'heal' : 'dmg');
        
        setTimeout(async () => {
            try {
                const response = await fetch(this.baseURL + 'combat/end', {
                    method: 'POST', 
                    body: JSON.stringify({ winner: winner })
                });
                const data = await response.json();
                
                if (data.success) {
                    if (data.loot && data.loot.length > 0) {
                        data.loot.forEach(itemStr => {
                            this.log("Butin obtenu : " + itemStr, "loot");
                        });
                        alert("Victoire ! Vous avez obtenu :\n" + data.loot.join("\n"));
                        
                    }
                    setTimeout(() => {
                        if (data.redirect) {
                            window.location.href = data.redirect;
                        }
                    }, 2500); 
                }
            } catch (e) {
                console.error(e);
            }
        }, 1000);
    }
}

if (!window.game) {
    document.addEventListener('DOMContentLoaded', () => {
        if(document.getElementById('combat-logs')) {
            window.game = new CombatGame();
        }
    });
}