<main id="main" class="main">
        <section class="section">
            <div class="row">
                <div class="col-lg-12">

                    <div class="card">
                        <div class="card-body">
                            <div class="col-lg-6">
                                <h5 style="font-weight:bold;color:#283a97;" class="card-title">NOTES SEMESTRE <?= esc($semestre)?> DE L'ETUDIANT</h5>
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <p><strong style="color:#283a97;">ÉTUDIANT:</strong> <?= esc($etudiant['nom']) ?></p>
                                        </div>
                                        <div class="col-lg-4">
                                            <p><strong style="color:#283a97;">ETU:</strong> 00<?= esc($etudiant['etu']) ?></p>
                                        </div>
                                        <div class="col-lg-4">
                                            <p><strong style="color:#283a97;">PROMOTION:</strong> <?= esc($etudiant['nom_promotion']) ?></p>
                                        </div>
                                    </div>
                                
                            </div>
                            <!-- Table with stripped rows -->
                            <table class="table datatable">
                                <thead>
                                    <tr>
                                        <th style="background-color:#283a97;color:#d0dce7">UE</th>
                                        <th style="background-color:#283a97;color:#d0dce7">Intitulé</th>
                                        <th style="background-color:#283a97;color:#d0dce7">Crédits</th>
                                        <th style="background-color:#283a97;color:#d0dce7">Note/20</th>
                                        <th style="background-color:#283a97;color:#d0dce7">Résultat</th>
                                        <th style="background-color:#283a97;color:#d0dce7">Session</th>
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
                            <h4 style="font-weight:bold;color:#283a97;" class="mt-3">Total Crédits Obtenus: <?= esc($sumCredits) ?></h4>
                            <h4 class="mt-3" style="color: <?= esc($Color) ?>; font-weight: bold;">
                                mention : <?= esc($mention) ?>
                            </h4>
                            <h4 class="mt-3" style="color: <?= esc($Color) ?>; font-weight: bold;">
                                Moyenne : <?= esc($moyenne) ?>
                            </h4>
                        </div>
                    </div>

                </div>
            </div>
        </section>
    </main><!-- End Main -->
