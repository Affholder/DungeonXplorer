// Variables globales
let currentTab = 'chapters';
let currentMode = 'add'; // 'add' ou 'edit'
let currentEditId = null;

// Chargement initial
document.addEventListener('DOMContentLoaded', () => {
    loadChapters();
});

// GESTION DES TABS
function switchTab(tabName) {
    currentTab = tabName;
    
    // Mise à jour des boutons
    document.querySelectorAll('.tab-btn').forEach(btn => btn.classList.remove('active'));
    event.target.classList.add('active');
    
    // Mise à jour du contenu
    document.querySelectorAll('.tab-content').forEach(content => content.classList.remove('active'));
    document.getElementById(`tab-${tabName}`).classList.add('active');
    
    // Charger les données appropriées
    switch(tabName) {
        case 'chapters':
            loadChapters();
            break;
        case 'monsters':
            loadMonsters();
            break;
        case 'treasures':
            loadTreasures();
            break;
        case 'users':
            loadUsers();
            break;
    }
}

// === CHARGEMENT DES DONNÉES ===

async function loadChapters() {
    const list = document.getElementById('chapters-list');
    list.innerHTML = '<div class="loader"></div>';
    
    try {
        const response = await fetch('/DungeonXplorer/admin/getChapters');
        const chapters = await response.json();
        
        list.innerHTML = '';
        chapters.forEach(chapter => {
            const card = createChapterCard(chapter);
            list.appendChild(card);
        });
    } catch (error) {
        list.innerHTML = '<p style="color: red;">Erreur lors du chargement des chapitres</p>';
        console.error(error);
    }
}

async function loadMonsters() {
    const list = document.getElementById('monsters-list');
    list.innerHTML = '<div class="loader"></div>';
    
    try {
        const response = await fetch('/DungeonXplorer/admin/getMonsters');
        const monsters = await response.json();
        
        list.innerHTML = '';
        monsters.forEach(monster => {
            const card = createMonsterCard(monster);
            list.appendChild(card);
        });
    } catch (error) {
        list.innerHTML = '<p style="color: red;">Erreur lors du chargement des monstres</p>';
        console.error(error);
    }
}

async function loadTreasures() {
    const list = document.getElementById('treasures-list');
    list.innerHTML = '<div class="loader"></div>';
    
    try {
        const response = await fetch('/DungeonXplorer/admin/getTreasures');
        const treasures = await response.json();
        
        list.innerHTML = '';
        treasures.forEach(treasure => {
            const card = createTreasureCard(treasure);
            list.appendChild(card);
        });
    } catch (error) {
        list.innerHTML = '<p style="color: red;">Erreur lors du chargement des trésors</p>';
        console.error(error);
    }
}

async function loadUsers() {
    const list = document.getElementById('users-list');
    list.innerHTML = '<div class="loader"></div>';
    
    try {
        const response = await fetch('/DungeonXplorer/admin/getUsers');
        const users = await response.json();
        
        list.innerHTML = '';
        users.forEach(user => {
            const card = createUserCard(user);
            list.appendChild(card);
        });
    } catch (error) {
        list.innerHTML = '<p style="color: red;">Erreur lors du chargement des utilisateurs</p>';
        console.error(error);
    }
}

// === CRÉATION DES CARTES ===

function createChapterCard(chapter) {
    const card = document.createElement('div');
    card.className = 'item-card';
    card.innerHTML = `
        <div class="item-info">
            <strong>Chapitre #${chapter.id}</strong>
            <p>${chapter.content.substring(0, 100)}...</p>
            <small>Image: ${chapter.image || 'Aucune'}</small>
        </div>
        <div class="item-actions">
            <button class="btn-edit" onclick="editChapter(${chapter.id})">Modifier</button>
            <button class="btn-delete" onclick="deleteChapter(${chapter.id})">Supprimer</button>
        </div>
    `;
    return card;
}

function createMonsterCard(monster) {
    const card = document.createElement('div');
    card.className = 'item-card';
    card.innerHTML = `
        <div class="item-info">
            <strong>${monster.name}</strong>
            <p>PV: ${monster.pv} | Mana: ${monster.mana} | Initiative: ${monster.initiative}</p>
            <p>Force: ${monster.strength} | Attaque: ${monster.attack} | XP: ${monster.xp}</p>
            <small>Image: ${monster.mon_image || 'Aucune'}</small>
        </div>
        <div class="item-actions">
            <button class="btn-edit" onclick="editMonster(${monster.id})">Modifier</button>
            <button class="btn-delete" onclick="deleteMonster(${monster.id})">Supprimer</button>
        </div>
    `;
    return card;
}

function createTreasureCard(treasure) {
    const card = document.createElement('div');
    card.className = 'item-card';
    card.innerHTML = `
        <div class="item-info">
            <strong>Trésor #${treasure.id}</strong>
            <p>Chapitre: ${treasure.chapter_id} | Item: ${treasure.item_id} | Quantité: ${treasure.quantity}</p>
        </div>
        <div class="item-actions">
            <button class="btn-edit" onclick="editTreasure(${treasure.id})">Modifier</button>
            <button class="btn-delete" onclick="deleteTreasure(${treasure.id})">Supprimer</button>
        </div>
    `;
    return card;
}

function createUserCard(user) {
    const card = document.createElement('div');
    card.className = 'item-card';
    card.innerHTML = `
        <div class="item-info">
            <strong>${user.username}</strong>
            <p>Email: ${user.email}</p>
            <small>ID: ${user.User_ID} | ${user.admin == 1 ? 'Administrateur' : 'Utilisateur'}</small>
        </div>
        <div class="item-actions">
            <button class="btn-delete" onclick="deleteUser(${user.User_ID})">Supprimer</button>
        </div>
    `;
    return card;
}

// === GESTION DE LA MODAL ===

function openModal(type, editData = null) {
    currentMode = editData ? 'edit' : 'add';
    currentEditId = editData ? editData.id : null;
    
    const modal = document.getElementById('adminModal');
    const title = document.getElementById('modal-title');
    const formFields = document.getElementById('form-fields');
    
    modal.style.display = 'flex';
    
    switch(type) {
        case 'chapter':
            title.textContent = editData ? 'Modifier le chapitre' : 'Ajouter un chapitre';
            formFields.innerHTML = `
                ${editData ? `<input type="hidden" name="id" value="${editData.id}">` : ''}
                <label>Contenu du chapitre *</label>
                <textarea name="content" required>${editData ? editData.content : ''}</textarea>
                
                <label>Image (chemin)</label>
                <input type="text" name="image" value="${editData ? editData.image : ''}">
            `;
            break;
            
        case 'monster':
            title.textContent = editData ? 'Modifier le monstre' : 'Ajouter un monstre';
            formFields.innerHTML = `
                ${editData ? `<input type="hidden" name="id" value="${editData.id}">` : ''}
                <label>Nom du monstre *</label>
                <input type="text" name="name" value="${editData ? editData.name : ''}" required>
                
                <label>Points de vie *</label>
                <input type="number" name="pv" value="${editData ? editData.pv : ''}" required>
                
                <label>Mana *</label>
                <input type="number" name="mana" value="${editData ? editData.mana : ''}" required>
                
                <label>Initiative *</label>
                <input type="number" name="initiative" value="${editData ? editData.initiative : ''}" required>
                
                <label>Force *</label>
                <input type="number" name="strength" value="${editData ? editData.strength : ''}" required>
                
                <label>Attaque *</label>
                <input type="number" name="attack" value="${editData ? editData.attack : ''}" required>
                
                <label>Points d'expérience *</label>
                <input type="number" name="xp" value="${editData ? editData.xp : ''}" required>
                
                <label>Image (chemin)</label>
                <input type="text" name="mon_image" value="${editData ? editData.mon_image : ''}">
            `;
            break;
            
        case 'treasure':
            title.textContent = editData ? 'Modifier le trésor' : 'Ajouter un trésor';
            formFields.innerHTML = `
                ${editData ? `<input type="hidden" name="id" value="${editData.id}">` : ''}
                <label>ID du chapitre *</label>
                <input type="number" name="chapter_id" value="${editData ? editData.chapter_id : ''}" required>
                
                <label>ID de l'item *</label>
                <input type="number" name="item_id" value="${editData ? editData.item_id : ''}" required>
                
                <label>Quantité *</label>
                <input type="number" name="quantity" value="${editData ? editData.quantity : ''}" required>
            `;
            break;
    }
}

function closeModal() {
    document.getElementById('adminModal').style.display = 'none';
    document.getElementById('adminForm').reset();
    currentEditId = null;
    currentMode = 'add';
}

// === SOUMISSION DU FORMULAIRE ===

async function handleSubmit(event) {
    event.preventDefault();
    
    const formData = new FormData(event.target);
    let endpoint = '';
    
    switch(currentTab) {
        case 'chapters':
            endpoint = currentMode === 'add' ? 'addChapter' : 'updateChapter';
            break;
        case 'monsters':
            endpoint = currentMode === 'add' ? 'addMonster' : 'updateMonster';
            break;
        case 'treasures':
            endpoint = currentMode === 'add' ? 'addTreasure' : 'updateTreasure';
            break;
    }
    
    try {
        const response = await fetch(`/DungeonXplorer/admin/${endpoint}`, {
            method: 'POST',
            body: formData
        });
        
        const result = await response.json();
        
        if (result.success) {
            alert(result.message);
            closeModal();
            
            // Recharger les données
            switch(currentTab) {
                case 'chapters':
                    loadChapters();
                    break;
                case 'monsters':
                    loadMonsters();
                    break;
                case 'treasures':
                    loadTreasures();
                    break;
            }
        } else {
            alert('Erreur: ' + result.message);
        }
    } catch (error) {
        alert('Erreur lors de la requête');
        console.error(error);
    }
}

// === ÉDITION ===

async function editChapter(id) {
    const response = await fetch('/DungeonXplorer/admin/getChapters');
    const chapters = await response.json();
    const chapter = chapters.find(c => c.id == id);
    if (chapter) openModal('chapter', chapter);
}

async function editMonster(id) {
    const response = await fetch('/DungeonXplorer/admin/getMonsters');
    const monsters = await response.json();
    const monster = monsters.find(m => m.id == id);
    if (monster) openModal('monster', monster);
}

async function editTreasure(id) {
    const response = await fetch('/DungeonXplorer/admin/getTreasures');
    const treasures = await response.json();
    const treasure = treasures.find(t => t.id == id);
    if (treasure) openModal('treasure', treasure);
}

// === SUPPRESSION ===

async function deleteChapter(id) {
    if (!confirm('Êtes-vous sûr de vouloir supprimer ce chapitre ?')) return;
    
    const formData = new FormData();
    formData.append('id', id);
    
    try {
        const response = await fetch('/DungeonXplorer/admin/deleteChapter', {
            method: 'POST',
            body: formData
        });
        
        const result = await response.json();
        alert(result.message);
        if (result.success) loadChapters();
    } catch (error) {
        alert('Erreur lors de la suppression');
        console.error(error);
    }
}

async function deleteMonster(id) {
    if (!confirm('Êtes-vous sûr de vouloir supprimer ce monstre ?')) return;
    
    const formData = new FormData();
    formData.append('id', id);
    
    try {
        const response = await fetch('/DungeonXplorer/admin/deleteMonster', {
            method: 'POST',
            body: formData
        });
        
        const result = await response.json();
        alert(result.message);
        if (result.success) loadMonsters();
    } catch (error) {
        alert('Erreur lors de la suppression');
        console.error(error);
    }
}

async function deleteTreasure(id) {
    if (!confirm('Êtes-vous sûr de vouloir supprimer ce trésor ?')) return;
    
    const formData = new FormData();
    formData.append('id', id);
    
    try {
        const response = await fetch('/DungeonXplorer/admin/deleteTreasure', {
            method: 'POST',
            body: formData
        });
        
        const result = await response.json();
        alert(result.message);
        if (result.success) loadTreasures();
    } catch (error) {
        alert('Erreur lors de la suppression');
        console.error(error);
    }
}

async function deleteUser(userId) {
    if (!confirm('Êtes-vous sûr de vouloir supprimer cet utilisateur ?')) return;
    
    const formData = new FormData();
    formData.append('user_id', userId);
    
    try {
        const response = await fetch('/DungeonXplorer/admin/deleteUser', {
            method: 'POST',
            body: formData
        });
        
        const result = await response.json();
        alert(result.message);
        if (result.success) loadUsers();
    } catch (error) {
        alert('Erreur lors de la suppression');
        console.error(error);
    }
}