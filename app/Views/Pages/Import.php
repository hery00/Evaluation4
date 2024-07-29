<main id="main" class="main">
    <section class="section">
      <div class="row">
        <div class="card">
          <h3 class="card-header">Importation de données</h3>
          <div class="card-body">
            <form method="post" action="<?= base_url('importcsv') ?>" enctype="multipart/form-data">
              <div class="row g-3">
              <div class="col-md-6">
                    <label for="inputNumber" class="col-sm-2 col-form-label">Config_note</label>
                    <div class="col-sm-10">
                      <input class="form-control" type="file" name="config_note" id="csv_file" required accept=".csv">
                    </div>
                </div>
              <div class="col-md-6">
                    <label for="inputNumber" class="col-sm-2 col-form-label">Notes</label>
                    <div class="col-sm-10">
                      <input class="form-control" type="file" name="note" id="csv_file" required accept=".csv">
                    </div>
                  </div>
              <div class="col-12">
                <button class="btn btn-primary" type="submit">Submit form</button>
              </div>
                  </div>
                </div>
              </div>
            </form><!-- End General Form Elements -->
          </div>
        </div>
      </div>
    </section>
</main>
