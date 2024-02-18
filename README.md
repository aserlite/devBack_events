# Projet
- Leblond Romain
- Cuvillon Arthur

Notre projet est normalement complet, le seul point manquant étant la gestion de l'administration selon si l'utilisateur est admin de l'event ou pas qui marche a moitié (pop up bloquante affichant une erreur 403), l'admin est accessible a toutes les adresses mail @gmail.com
### Voici des screens des pages: 

<img src="https://cdn.discordapp.com/attachments/977904279559999539/1208896222266654731/screencapture-127-0-0-1-8000-2024-02-18-22_58_17.png?ex=65e4f357&is=65d27e57&hm=2c182f3470d922f397493a2b44213abe9c10b368759db11bc78c38f88ccdb855&">
<img src="https://cdn.discordapp.com/attachments/977904279559999539/1208896222694342766/screencapture-127-0-0-1-8000-events-2024-02-18-22_59_11.png?ex=65e4f357&is=65d27e57&hm=02b651978bfc5d70af69290221788cc9e2f365368e782054b225d456cadd72bf&">
<img src="https://cdn.discordapp.com/attachments/977904279559999539/1208896223147466783/screencapture-127-0-0-1-8000-events-55-2024-02-18-22_59_24.png?ex=65e4f357&is=65d27e57&hm=f5a6d6a3cbe9a5a1c8378f67ae3d4931c43997d58c275e7a8b107cc0193ff5cf&">

<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

# Installation

Assurez-vous d'avoir Composer et Node.js installés sur votre machine avant de procéder.

### <u> Cloner le référentiel : </u>

```bash
git clone https://github.com/aserlite/lib_arthur.git
```

### <u> Installer les dépendances PHP : </u>

```bash
composer install
```

### <u> Installer les dépendances JavaScript : </u>

```bash
npm install
```
### <u> Configurer l'environnement : </u>

Copier le fichier .env.example en tant que .env et configurer les informations de base de données et autres paramètres si nécessaire.

```bash
cp .env.example .env
```

Générer la clé d'application Laravel :

```bash
php artisan key:generate
```

### <u> Migrations et Seeders : </u>

```bash
php artisan migrate --seed
```

### <u> Lancer le serveur node (CSS/JS) : </u>


```bash
npm run dev
```

### <u> Lancer le serveur de développement : </u>

```bash
php artisan serve
```

### <u> Installation de filamaent </u>

```bash
composer require filament/filament:"^3.1" -W
php artisan filament:install --panels
```


# Utilisation

### <u> Run des seeders </u>
```bash
php artisan db:seed
```

N'executer que certains seeders:
```bash
php artisan db:seed --class=UserSeeder
```

### <u> Run des migrations </u>
```bash
php artisan migrate
```

Run toutes les migrations avec tous les seeders:
```bash
php artisan migrate:fresh --seed
#:fresh sert a repartir a 0, il supprime toute la base actuelle execute ensuite les migrations 
```
## <u> Filament </u>

Créer un utilisateur filament:
```bash
php artisan make:filament-user
```

Créer une Ressource (afficher une table dans le dashboard):
```bash
php artisan make:filament-resource Event
```

# Creation 

### <u> Créer des migrations </u>

```bash
php artisan make:model 
#sans nom pour avoir toutes les options a cocher, 
#mettre le nom au singulier ex: Test
``` 



Démarche complète
```bash
php artisan make:model Test
php artisan make:migration create_tests_migration
php artisan make:factory TestFactory
php artisan make:seeders TestSeeder
```
