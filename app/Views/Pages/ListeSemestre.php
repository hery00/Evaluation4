<main id="main" class="main">
    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-6">
                                <h5 class="card-title">Détails de l'Étudiant</h5>
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <p><strong>ÉTUDIANT:</strong> <?= esc($etudiant['nom']) ?></p>
                                        </div>
                                        <div class="col-lg-4">
                                            <p><strong>ETU:</strong> 00<?= esc($etudiant['etu']) ?></p>
                                        </div>
                                        <div class="col-lg-4">
                                            <p><strong>PROMOTION:</strong> <?= esc($etudiant['nom_promotion']) ?></p>
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
                                        <td style="text-align:center"><strong>Semestre</strong></td>
                                        <?php foreach ($semestres as $semestre): ?>
                                            <td style="text-align:center">
                                                <a class="btn btn-primary" href="<?= base_url('note/semestre')?>?etu=<?= esc($etudiant['etu']); ?>&id_semestre=<?= esc($semestre['id_semestre']) ?>">Voir resultat <?= esc($semestre['nom_semestre']) ?></a>
                                            </td>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                            <td colspan="1">Aucun semestre trouvé.</td>
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
