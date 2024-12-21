# Installation du projet
## Configuration Docker
- [ ] Installation de Symfony minimal install
* `git clone https://github.com/dunglas/symfony-docker`
- [ ] Ajouter dans Docker file au niveau des apt-get    
* `make \ npm \ yarn \ bash \`
- [ ] Suivre les indications du readme pour créer les images puis les containers https://github.com/dunglas/symfony-docker
## Configuration Symfony et NPM
- [ ] Dans le container php : 
``` 
composer require symfony/maker-bundle
Composer require symfony/twig
Composer require symfony/webpack-encore-bundle
```
- [ ]	Créer un controller de demo via le maker
* `php bin/console make:controller`
- [ ] Build des sources CSS et JS
```
npm install
npm run build
```
OU
```
npm install
npm run dev
```
- [ ] Installation de bootstrap
* ```npm install bootstrap @popperjs/core –save```
ALTERNATIVE avec sbadmin
* ```npm install startbootstrap-sb-admin --save```
- [ ] Import des dépendances bootstrap dans assets/app.js
```
// Importation des fichiers CSS
import 'startbootstrap-sb-admin/dist/css/styles.css';
// Importation des fichiers JavaScript
import 'startbootstrap-sb-admin/dist/js/scripts.js';
```
- [ ] Build final
* ```npm run build``` ou ```npm run dev```
## Configuration Base de données
- [ ] Installation des dépendences dans le container

```composer require symfony/orm-pack```

Puis dans le terminal on rebuild les container

```
docker compose down --remove-orphans
docker compose build --no-cache
docker compose up --pull always -d --wait
```
## Création entité et controller
Les attributs de l'entité sont titre (string), texte (text), publie (boolean), date (datetime_immutable)
```
php bin/console make:entity
php bin/console make:migration
php bin/console doctrine:migrations:migrate
php bin/console make:controller ArticleController
```
* Création d'une route pour ajouter un article
* Création d'une route pour lire la liste des articles
* Création d'une route pour mettre à jour des articles
* Création d'une route pour supprimer des articles

- [ ] Installation des dépendences dans le container

```composer require symfony/web-profiler-bundle```
## Création des formulaires

- [ ] Installation des dépendences dans le container

```composer require symfony/form```
```
php bin/console make:form
```
Une fois le formulaire créé, il faut l'instancier dans le controller d'article dans la route de création et dans le template associé.  
Intégrer le formulaire dans la route de modification de l'article  
Refondre la page qui liste les articles pour intégrer les liens vers la modification et la suppression  
Sources : 
* https://symfony.com/doc/current/forms.html
* https://getbootstrap.com/docs/5.3/components/card/
* https://twig.symfony.com/doc/3.x/tags/for.html

### Implémentation de addFlash pour la confirmation
Dans le controller et dans le twig  
Sources : 
* https://symfonycasts.com/screencast/symfony-forms/flash-messages

## Création user et sécurité

- [ ] Installation des dépendences dans le container

```composer require symfony/security-bundle```

Création de l'entité User
```
php bin/console make:user
php bin/console make:migration
php bin/console doctrine:migrations:migrate
composer require symfonycasts/verify-email-bundle
composer require form validator
php bin/console make:registration-form
```
Personnaliser le registration form

## Création du formulaire de connexion
```php bin/console make:security:form-login```

Mettre en forme le formulaire  
Créer la route par defaut si besoin / vers le home controller  
Rediriger le logout  
Personnaliser le menu  
Restreindre l'accès aux routes create, edit et delete aux utilisateurs connectés  

## Traitement de l'image d'un article
```composer require symfony/mime```

Ajouter au formulaire le traitement de l'article la gestion de l'image  
Mettre à jour l'entité pour inclure le nom du fichier  
Ajout de l’image dans la liste des articles  
Détail de l’article sur page dédiée  


Sources :  
https://symfony.com/doc/current/controller/upload_file.html  

## Exposer les entités en API

### Création de l'entité Catégorie

Créer une entité catégorie qui a une relation avec l'article (une catégorie est attachée à X articles)  
La relation se fait dans l'entité article (https://symfony.com/doc/current/doctrine/associations.html#saving-related-entities)  
Créer le CRUD des catégories  
Modifier le CRUD article pour associer une catégorie à un article  

### Exposition de la catégorie via les API
``` composer require api ```  
En cas d'erreur il faut downgrade phpstan/phpdoc-parser:^1.0  
Mise en place de l'auth jwt

## BONUS - Un moteur de recherche
Créer un formulaire de recherche qui cherche une expression dans les titres et textes des articles 