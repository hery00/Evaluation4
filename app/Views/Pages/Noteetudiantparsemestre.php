<main id="main" class="main">
        <section class="section">
            <div class="row">
                <div class="col-lg-12">

                    <div class="card">
                        <div class="card-body">
                            <div class="col-lg-6">
                                <h5 class="card-title">Notes Semestre <?= esc($semestre)?> de l'Étudiant</h5>
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
                            <!-- Table with stripped rows -->
                            <table class="table datatable">
                                <thead>
                                    <tr>
                                        <th>UE</th>
                                        <th>Intitulé</th>
                                        <th>Crédits</th>
                                        <th>Note/20</th>
                                        <th>Résultat</th>
                                        <th>Session</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($notes as $note): ?>
                                        <tr>
                                            <td><?= esc($note['ue']) ?></td>
                                            <td><?= esc($note['intitule_matiere']) ?></td>
                                            <td><?= esc($note['credits']) ?></td>
                                            <td><?= number_format($note['notes'], 2) ?></td>
                                            <td><?= esc($note['resultat']) ?></td>
                                            <td><?= esc($note['session']) ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                            <!-- End Table with stripped rows -->
                            <h4 class="mt-3">Total Crédits Obtenus: <?= esc($sumCredits) ?></h4>
                            <h4 class="mt-3">Moyenne : <?= esc($moyenne) ?></h4>
                        </div>
                    </div>

                </div>
            </div>
        </section>
    </main><!-- End Main -->
