<main id="main" class="main">
    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-6"><br/><br/><h5 class="card-title">LISTE DES ÉTUDIANTS</h5></div>
                            <div class="col-lg-6">
                            </div>  
                        </div>
                        <form id="choixForm" action="<?= base_url('admin/listetudiant') ?>" method="GET">
                            <div class="row">
                                <div class="col-md-1"></div>
                                <div class="col-md-4">
                                    <div class="input-group col-md-4">
                                        <span class="input-group-text" id="inputGroupPrepend">Promotion</span>
                                        <input type="text" name="prom" class="form-control" id="id_prom" value="<?= isset($id_prom) ? $id_prom : '' ?>">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="input-group col-md-4">
                                        <span class="input-group-text" id="inputGroupPrepend">Nom</span>
                                        <input type="text" name="name" class="form-control" id="name" value="<?= isset($name) ? $name : '' ?>">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <button type="submit" class="btn btn-primary">Filtrer</button>
                                </div>
                            </div>
                        </form>
                    </div>

                    <?php if (isset($etudiants) && count($etudiants) > 0): ?>
                    <table class="table">
                        <thead>
                            <tr>
                                <th style="text-align:right">#</th>
                                <th style="text-align:center">Promotion</th>
                                <th style="text-align:left">ETU</th>
                                <th style="text-align:left">Nom</th>
                                <th style="text-align:left">Prénom</th>
                                <th style="text-align:center">Date de Naissance</th>
                                <th style="text-align:center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php foreach($etudiants as $etudiant): ?>
                            <tr>
                                <td style="text-align:right"><?= esc($etudiant['id_etudiant']); ?></td>
                                <td style="text-align:center"><?= esc($etudiant['nom_promotion']); ?></td>
                                <td style="text-align:left"><?= esc($etudiant['etu']); ?></td>
                                <td style="text-align:left"><?= esc($etudiant['nom']); ?></td>
                                <td style="text-align:left"><?= esc($etudiant['prenom']); ?></td>
                                <td style="text-align:center"><?= esc($etudiant['dtn']); ?></td>
                                <td style="text-align:center"><a class="btn btn-primary" href="#">Voir note</a></td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                    <?php else: ?>
                        <p>Aucun étudiant trouvé.</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </section>
</main>
