<!DOCTYPE html>
<html>
<head>
    <title>Liste des Étudiants</title>
</head>
<body>
    <h1>Liste des Étudiants</h1>
    <form method="get" action="<?= base_url('admin/listetudiant') ?>">
        <label for="id_prom">Promotion:</label>
        <input type="text" name="id_prom" id="id_prom" value="<?= isset($id_prom) ? $id_prom : '' ?>"><br>

        <label for="name">Nom ou Prénom:</label>
        <input type="text" name="name" id="name" value="<?= isset($name) ? $name : '' ?>"><br>

        <input type="submit" value="Filtrer">
    </form>
    <br>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Promotion ID</th>
            <th>ETU</th>
            <th>Nom</th>
            <th>Prénom</th>
            <th>Date de Naissance</th>
        </tr>
        <?php if (isset($etudiants) && count($etudiants) > 0): ?>
            <?php foreach($etudiants as $etudiant): ?>
            <tr>
                <td><?= $etudiant['id_etudiant']; ?></td>
                <td><?= $etudiant['id_prom']; ?></td>
                <td><?= $etudiant['etu']; ?></td>
                <td><?= $etudiant['nom']; ?></td>
                <td><?= $etudiant['prenom']; ?></td>
                <td><?= $etudiant['dtn']; ?></td>
            </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="6">Aucun étudiant trouvé.</td>
            </tr>
        <?php endif; ?>
    </table>
</body>
</html>
