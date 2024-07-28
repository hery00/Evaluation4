<main id="main" class="main">
    <div class="col-lg-6">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Insertion de notes</h5>
                <!-- Vertical Form -->
                <?php if (session()->getFlashdata('success')): ?>
                    <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
                <?php elseif (session()->getFlashdata('error')): ?>
                    <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
                <?php endif; ?>

                <form action="<?= base_url('/addnote') ?>" method="post" class="row g-3">
                    <div class="col-12">
                        <label for="id_etudiant" class="form-label">ETU</label>
                        <input type="text" name="id_etudiant" class="form-control" id="id_etudiant" required>
                    </div>
                    <div class="col-12">
                        <label for="id_matiere" class="form-label">Matière</label>
                        <select name="id_matiere" class="form-control" id="id_matiere" required>
                            <?php foreach ($matieres as $matiere): ?>
                                <option value="<?= esc($matiere['id_matiere']) ?>"><?= esc($matiere['intitule']) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="col-12">
                        <label for="notes" class="form-label">Notes</label>
                        <input type="number" step="0.01" name="notes" class="form-control" id="notes" required>
                    </div>
                    <div class="col-12">
                        <label for="session" class="form-label">Session</label>
                        <input type="date" name="session" class="form-control" id="session" required>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary">Inserer</button>
                    </div>
                </form><!-- Vertical Form -->
            </div>
        </div>
    </div>
</main>
