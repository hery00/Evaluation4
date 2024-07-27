<!DOCTYPE html>
<html>
<head>
    <title>Liste des Semestres</title>
</head>
<body>
    <h1>Liste des Semestres</h1>
    <table border="1">
        <tr>
            <th>Nom Semestre</th>
        </tr>
        <?php if (!empty($semestres) && is_array($semestres)): ?>
            <?php foreach ($semestres as $semestre): ?>
                <tr>
                    <td><?= esc($semestre['nom_semestre']) ?></td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="2">Aucun semestre trouvé.</td>
            </tr>
        <?php endif ?>
    </table>
</body>
</html>
