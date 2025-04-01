# MVC Simple en PHP - Gestion de tâches

## Architecture du projet

Création des dossiers et fichiers de base

/mvc-tasks
|- /controllers
   |-
|- /lib
   |- database.php
|- /models
   |- Task.php
|- /views
|- index.php
|- README.md

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
- Déplacer la classe `TaskRepository` dans son propre dossier (`models/repositories`)
- Créer la vue qui affiche toutes les tâches sur la page index.php.
- Créer le `routeur` qui va permettre de se déplacer de page en page. 