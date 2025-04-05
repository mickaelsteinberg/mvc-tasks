# MVC Simple en PHP - Gestion de tâches

## Architecture du projet

Création des dossiers et fichiers de base

```
/mvc-tasks
|- /controllers
|  |- TaskController.php 
|- /lib
|  |- database.php
|- /models
|  |- /repositories
|  |  |- TaskRepository.php
|  |- Task.php
|- /views
|  |- /templates
|  |  |- footer.php
|  |  |- header.php
|  |- 404.php
|  |- create.php
|  |- edit.php
|  |- home.php
|  |- view-tasks.php
|- index.php
|- README.md
```

## Création du modèle Task

- un modèle qui représente un enregistrement de la table `task`
- un repository qui permet d'accéder aux fonctions du CRUD
    - getTasks : la liste de toutes les tâches
    - getTask(id) : récupère une seule tâche
    - create
    - update
    - delete


Explication du bindParam
```php
/**
* 
* $task = {
*    id: 1
*    title: 'Suivre le cours'
*    description: 'Cours php mvc et dao'
*    status: 'Terminé'
* }
* $task->title ===>>>> 'Suivre le cours'
* 
* UPDATE 
*  tasks 
* SET 
*  title = :title, 
*  description = :description, 
*  status = :status 
* WHERE 
*  id = :id
* 
* bindParam(':title', $task->title);
* bindParam(':description', $task->description);
* 
* UPDATE 
*  tasks 
* SET 
*  title = 'Suivre le cours', 
*  description = 'Cours php mvc et dao', 
*  status = Terminé
* WHERE 
*  id = 1
* 
*/
```

- Ecrire les getters et les setters de la classe `Task`
   - passer les attributs de la classe en privé
   - créer les getters et setters de chaque attribut de la classe `Task`
   - dans le `TaskRepository`, modifier l'appel attributs pour passer aux getters et setters
   - dans les setters de `title`, `description` et `status`, mettre les `htmlspecialchars` pour sécuriser les données en paramètre
- Déplacer la classe `TaskRepository` dans son propre dossier (`models/repositories`)
   - nouveau fichier `models/repositories/TaskRepository.php`
- Créer la vue qui affiche toutes les tâches sur la page index.php.
   - nouveau fichier `views/home.php` qui boucle sur les `$tasks` de l'`index.php`
- Créer le `routeur` qui va permettre de se déplacer de page en page. 
   - Défini un paramètre d'URL ($_GET) `action` et qui a comme valeur `view` et paramètre `id`
- Créer la vue qui affiche une seule tâche
   - nouveau fichier `views/view-task.php` qui affiche le détail d'une tâche
- Ajouter un système de templates avec `header.php` et `footer.php`
- Ajouter la classe `TaskController` dans le dossier `controllers`
- Modifier le routeur pour le rendre disponible aux `action`
   - `view` affiche une tâche
   - `create` affiche le formulaire de création
   - `index` affiche la liste des tâches
   - `store` enregistre la tâche dans la base de données 

### Authentification 

- Créer une table `users`
- Créer un model `User` avec getters et setters
- Créer le repository `UserRepository` qui va récupérer les infos d'un utilisateur
   - Créer la fonction `getUserByUsername`
- Créer le controller `AuthController` qui va gérer les routes de l'authentification
- Dans `index.php`, utiliser le `AuthController` pour appeler la première vue `login.php`
- Dans le formulaire de connexion de la vue `login.php`, mettre l'action vers `doLogin`
- Dans `index.php`, créer la nouvelle route vers doLogin 
- Dans `AuthController.php`, créer la méthode pour connecter l'utilisateur 


# **Sessions vs Cookies : Les différences et applications**  

| Critère | **Sessions (`$_SESSION`)** | **Cookies (`$_COOKIE`)** |
|---------|-----------------------------|---------------------------|
| 📍 **Lieu de stockage** | Serveur (mémoire/RAM ou fichier) | Navigateur de l’utilisateur |
| ⏳ **Durée de vie** | Jusqu’à la fermeture du navigateur (par défaut) | Définie par l’expiration du cookie |
| 🔒 **Sécurité** | Plus sécurisé (pas accessible directement depuis JS) | Moins sécurisé (JS peut les lire) |
| 🎯 **Utilisation typique** | Authentification, panier, préférences temporaires | Suivi utilisateur, préférences persistantes |
| 🎭 **Personnalisation** | Basé sur l’utilisateur (stocké côté serveur) | Utilisé pour des réglages sur plusieurs sessions |
