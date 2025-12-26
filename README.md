# 🏰 DungeonXplorer
## *Une épopée interactive du Val Perdu*

> "Bienvenue sur DungeonXplorer, l'univers de dark fantasy où se mêlent aventure, stratégie et immersion totale dans les récits interactifs."

---

## 📖 Présentation du Projet
Ce projet a été réalisé par un groupe de **5 étudiants**. **DungeonXplorer** est une application Web de type "Livre dont vous êtes le héros" développée pour l'association **« Les Aventuriers du Val Perdu »**. 

L'aventure propose un scénario unique débutant dans une atmosphère de Dark Fantasy classique avant de basculer brutalement dans un univers **Cyberpunk** dystopique en l'an **2077**. Le joueur doit naviguer entre les époques pour déjouer les plans du Suprême Leader Andres Nigales et retrouver notre bien aimée, l'elfe Lucy.

---

## 🛠️ Socle Technique
L'application repose sur une architecture robuste développée en **PHP natif** sans framework CSS externe :
* **Langages :** PHP, MySQL, JavaScript, HTML5 et CSS3.
* **Architecture :** Design Pattern **MVC** (Modèle-Vue-Contrôleur).
* **Base de données :** MySQL gérée via l'interface **PDO**.
* **Conformité :** Interface responsive respectant les standards du W3C.

---

## 📜 Règles du Jeu
Le gameplay est régi par des statistiques évolutives et une gestion d'inventaire stratégique :
* **❤️ Santé (PV) :** Le héros commence avec 100 PV. Si les PV tombent à 0, c'est le Game Over.
* **📊 Statistiques :**
    * **💪 Force/Combat :** Capacité physique lors des affrontements.
    * **⚡ Tech/Mana :** Utilisation d'implants cybernétiques ou de magie résiduelle.
* **🎒 Inventaire :** Capacité maximale de **3 objets clés** par personnage.

---

## 🎨 Charte Graphique
L'immersion visuelle respecte les codes de la Dark Fantasy et du Cyberpunk :

### Palette de couleurs
* **Fond principal :** `#1A1A1A` (Noir doux).
* **Accents interactifs :** `#C4975E` (Or médiéval).
* **Alertes / Erreurs :** `#8B1E1E` (Rouge sombre).

### Typographies
* **Titres :** *Pirata One* (Style gothique).
* **Contenu :** *Roboto* (Moderne et lisible).

---

## 🚀 Fonctionnalités
### Interface Joueur
* Création de compte, gestion de profil et suppression de compte.
* Création de personnage parmi les trois classes emblématiques.
* Système de sauvegarde pour **Démarrer** ou **Reprendre** une aventure.

### Interface Administrateur
* Gestion complète (**CRUD**) des contenus : chapitres, monstres, trésors et images.
* Modération et suppression des comptes joueurs.

---

## 📂 Installation
1. **Clonez** le repository distant.
2. **Importez** le fichier `BDD.sql` dans votre environnement MySQL.
3. **Configurez** vos accès base de données dans le fichier de connexion PDO.
4. **Lancez** l'application via un serveur local (WAMP/MAMP/XAMPP).

---
*Projet réalisé par Quentin Affholder, Milène Pellerin, Antoine Pelletier, Gaspard Dectot et Adrien Barbet*
