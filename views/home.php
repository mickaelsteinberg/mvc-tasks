<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des tâches</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="?">📋 Gestion des Tâches</a>
            <div class="" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="?">🏠 Accueil</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-5">
        <h2 class="mb-4">📋 Liste des tâches</h2>

        <table class="table table-striped table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Titre</th>
                    <th>Description</th>
                    <th>Statut</th>
                    <th>Créé le</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($tasks as $task): ?>

                    <tr>

                        <td><?php echo $task->getId(); ?></td>
                        <td><a href="?action=view&id=<?php echo $task->getId() ?>"><?php echo $task->getTitle(); ?></a></td>
                        <td><?php echo $task->getDescription(); ?></td>
                        <td><?php echo $task->getStatus(); ?></td>
                        <td><?php echo $task->getCreatedAt() ?></td>

                    </tr>

                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

</body>
</html>
