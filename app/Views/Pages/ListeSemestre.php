<main id="main" class="main">
    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-6">
                                <h5 style="font-weight:bold;color:#283a97;" class="card-title">LISTE DES SEMESTRES</h5>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <p><strong style="color:#283a97;">ÉTUDIANT:</strong> <?= esc($etudiant['nom']) ?> <?= esc($etudiant['prenom']) ?></p>
                                    </div>
                                    <div class="col-lg-3">
                                        <p><strong style="color:#283a97;">ETU:</strong> 00<?= esc($etudiant['etu']) ?></p>
                                    </div>
                                    <div class="col-lg-3">
                                        <p><strong style="color:#283a97;">PROMOTION:</strong> <?= esc($etudiant['nom_promotion']) ?></p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Table pour les semestres -->
                        <div class="row">
                            <div class="col-lg-12">
                                <table class="table">
                                    <tbody>
                                    <?php if (!empty($semestres) && is_array($semestres)): ?>
                                        <tr>
                                            <th style="text-align:center;color:#283a97;">Semestre</th>
                                            <th style="text-align:center;color:#283a97;">Moyenne</th>
                                        </tr>
                                        <?php foreach ($semestres as $semestre): ?>
                                            <tr>
                                                <td style="text-align:center">
                                                    <a style="background-color:#b2d235;border:none;" class="btn btn-primary" href="<?= base_url('note/semestre')?>?etu=<?= esc($etudiant['etu']); ?>&id_semestre=<?= esc($semestre['id_semestre']) ?>">Voir résultat <?= esc($semestre['nom_semestre']) ?></a>
                                                </td>
                                                <td style="text-align:center">
                                                    Moyenne : <?= number_format($moyenne[$semestre['id_semestre']] ?? 0, 2) ?>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <tr>
                                            <td colspan="2">Aucun semestre trouvé.</td>
                                        </tr>
                                    <?php endif ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
