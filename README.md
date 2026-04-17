# Inter-Knot

Inter-Knot est un réseau social web développé en PHP/MySQL, librement inspiré de l’Inter-Knot présent dans Zenless Zone Zero. Ce projet vise à recréer une plateforme sociale interactive dans laquelle les utilisateurs peuvent créer un compte, publier du contenu avec ou sans image, commenter, liker des posts et personnaliser leur profil. L’interface et l’ambiance générale s’appuient sur l’esthétique du jeu, avec un thème sombre, une mise en page moderne et une expérience utilisateur immersive.

---

## Prérequis

Avant de lancer le projet, assure-toi d'avoir installé :

- [XAMPP](https://www.apachefriends.org/) ou [MAMP](https://www.mamp.info/) (Apache + MySQL + PHP)
- PHP 8.0 ou supérieur
- MySQL 5.7 ou supérieur
- Un navigateur web moderne (Chrome, Firefox, Edge)

---

## Installation

**1.** Clone le dépôt :
```bash
git clone https://github.com/Number6272/EFREI-B2-Projet_fil_rouge.git
```

**2.** Place le dossier dans `htdocs/` (XAMPP) ou `htdocs/` (MAMP)

**3.** Importe `database.sql` dans phpMyAdmin

**4.** Configure `config/db.php` avec tes identifiants MySQL :
```php
$pdo = new PDO("mysql:host=localhost;dbname=social_app;charset=utf8", "root", "");
```

---

## Lancer le projet

**1.** Lance Apache et MySQL depuis le panneau XAMPP ou MAMP

**2.** Ouvre ton navigateur et accède à :
```
http://localhost/social-app/pages/register.php
```

**3.** Crée un compte et commence à utiliser Inter-Knot

---

## Fonctionnalités

- Inscription et connexion utilisateur
- Modifier sa photo de profil
- Publier un post (titre, contenu, image optionnelle)
- Supprimer ses propres posts
- Liker / unliker un post
- Commenter un post
- Supprimer ses propres commentaires
- Affichage des posts en grille cliquable avec modal
- Musique de fond avec bouton mute

---

## Technologies utilisées

- PHP (sans framework)
- MySQL
- HTML / CSS / JavaScript
- PDO pour les requêtes SQL

---

## Structure du projet

```
social-app/
│
├── assets/
│   ├── css/style.css
│   ├── js/script.js
│   ├── images/
│   └── music/bg.mp3
│
├── config/
│   └── db.php
│
├── includes/
│   ├── header.php
│   ├── navbar.php
│   ├── footer.php
│   └── auth_check.php
│
├── actions/
│   ├── register_action.php
│   ├── login_action.php
│   ├── logout.php
│   ├── add_post.php
│   ├── delete_post.php
│   ├── add_comment.php
│   ├── delete_comment.php
│   ├── like_post.php
│   ├── unlike_post.php
│   └── update_avatar.php
│
├── pages/
│   ├── login.php
│   ├── register.php
│   └── profile.php
│
├── index.php
└── database.sql
```

---

## Base de données

| Table    | Description                       |
|----------|-----------------------------------|
| users    | Comptes utilisateurs              |
| posts    | Posts publiés                     |
| comments | Commentaires sur les posts        |
| likes    | Likes des posts (unique par user) |

---

## Front-end + Back-end

**Back-end (PHP + MySQL)**
- Authentification complète : inscription, connexion, déconnexion
- CRUD complet sur les posts, commentaires et profil
- Architecture séparée : pages / actions / includes / config
- Sessions PHP pour gérer l'état de connexion

**Front-end (HTML + CSS + JS)**
- Interface responsive en grille avec modal interactive
- CSS personnalisé sans framework
- JavaScript vanilla pour les interactions (modale, musique)

---

## Fonctionnel & Ergonomique

- Posts en grille avec image, avatar, titre et extrait du contenu
- Modal au clic : image + contenu + likes + commentaires
- Like en ❤️, suppression en 🗑️ pour une interface intuitive
- Navbar fixe avec lien actif surligné
- Footer avec logo
- Musique de fond avec bouton activer/désactiver
- Thème sombre avec accent jaune fluo

---

## Sécurité

**Injections SQL**
Toutes les requêtes utilisent des requêtes préparées PDO :
```php
$stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
$stmt->execute([$email]);
```

**XSS**
Toutes les données affichées sont échappées avec `htmlspecialchars()` :
```php
<?= htmlspecialchars($post['titre']) ?>
```

**Vérification des droits**
Un utilisateur ne peut supprimer que ses propres ressources :
```php
$stmt = $pdo->prepare("DELETE FROM posts WHERE id = ? AND user_id = ?");
$stmt->execute([$id, $_SESSION['user_id']]);
```

**Mots de passe hashés**
```php
$hash = password_hash($password, PASSWORD_DEFAULT);
password_verify($password, $hash);
```

**Contrôle d'accès**
Toutes les pages protégées incluent `auth_check.php` qui redirige si l'utilisateur n'est pas connecté.

---

## Améliorations possibles

- Système de follow / abonnement entre utilisateurs
- Page de recherche de posts et d'utilisateurs
- Notifications en temps réel
- Pagination du feed
- Modification d'un post après publication
- Réponses aux commentaires
- Mode clair / sombre au choix
- Upload de vidéos en plus des images
- API REST pour une future application mobile

---

## Auteur & Contact

- **GitHub** : [github.com/Number6272](https://github.com/Number6272)
- **Dépôt** : [EFREI-B2-Projet_fil_rouge](https://github.com/Number6272/EFREI-B2-Projet_fil_rouge.git)

---

## Licence

Ce projet est réalisé dans le cadre d'un cours à l'EFREI.
Il est libre d'utilisation à des fins éducatives.
