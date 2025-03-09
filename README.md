# 🐦 Twitter Clone – Réseau Social en PHP & MySQL  

Ce projet est un clone simplifié de Twitter, permettant aux utilisateurs de publier des tweets, suivre d'autres utilisateurs et interagir avec le contenu. Il est développé en **PHP** avec une base de données **MySQL**, offrant une expérience fluide et dynamique.

---

## 📂 Structure du projet  
```
wicoco-wicoco-twitter-clone-iim-php-mysql/
├── config/
│   └── config.php               # Configuration de la base de données
├── public/
│   ├── about.php                # Page "À propos"
│   ├── add_tweet.php            # Ajout d'un tweet
│   ├── follow_user.php          # Suivre un utilisateur
│   ├── index.php                # Page d'accueil (fil d'actualité)
│   ├── login.php                # Connexion utilisateur
│   ├── logout.php               # Déconnexion utilisateur
│   ├── register.php             # Inscription utilisateur
│   ├── unfollow_user.php        # Ne plus suivre un utilisateur
│   ├── user.php                 # Page de profil utilisateur
│   └── user_list.php            # Liste des utilisateurs
├── ressources/
│   ├── css/
│   │   └── style.css            # Styles CSS du projet
│   ├── data/
│   │   └── init.sql             # Script SQL d'initialisation de la base de données
│   └── templates/
│       ├── footer.html          # Pied de page
│       └── header.php           # En-tête
└── src/
    ├── common.php               # Fonctions et logique communes
    └── install.php              # Script d'installation du projet
```

---

## ✨ Fonctionnalités  
- 📝 **Publication de tweets** avec texte  
- 👥 **Système de followers/following**  
- 🔐 **Authentification sécurisée (inscription/connexion)**  
- 🏠 **Fil d’actualité affichant les tweets des utilisateurs suivis**  
- 🔍 **Recherche et consultation des profils utilisateurs**  

---

## 🛠️ Technologies utilisées  
- **Langage Backend :** PHP (PDO pour la connexion à la base de données)  
- **Base de données :** MySQL  
- **Frontend :** HTML, CSS (avec `ressources/css/style.css`)  
- **Sessions PHP** pour la gestion des utilisateurs connectés  

---

## 📜 Installation et utilisation  

### 📌 Prérequis  
- Un serveur local (**XAMPP, WAMP, Laragon**)  
- **PHP 7+**  
- **MySQL**  

### 🔧 Installation  
1. **Cloner le projet**  
   ```bash
   git clone https://github.com/utilisateur/twitter-clone.git
   cd twitter-clone
   ```

2. **Importer la base de données**  
   - Ouvrir **phpMyAdmin**  
   - Créer une base de données nommée `twitter_clone`  
   - Importer le fichier `ressources/data/init.sql`  

3. **Configurer la connexion à la base de données**  
   Modifier `config/config.php` avec vos paramètres :  
   ```php
   define('DB_HOST', 'localhost');
   define('DB_NAME', 'twitter_clone');
   define('DB_USER', 'root');
   define('DB_PASS', '');
   ```

4. **Lancer le serveur local**  
   - Démarrer Apache et MySQL sur **XAMPP/WAMP/Laragon**  
   - Accéder au projet via `http://localhost/wicoco-wicoco-twitter-clone-iim-php-mysql/public/index.php`  

---
