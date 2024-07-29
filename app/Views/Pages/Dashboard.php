<main id="main" class="main">
    <section class="section">
      <div class="row">
            <div class="col-lg-4">
              <div class="card info-card sales-card">
                <div class="card-body">
                  <h5 class="card-title">Nombre total des étudiants</h5>
                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-cart"></i>
                    </div>
                    <div class="ps-3">
                      <h1><?= esc($nb_etudiant) ?></h1>

                    </div>
                  </div>
                </div>

              </div>
            </div><!-- End Sales Card -->

            <!-- Revenue Card -->
            <div class="col-lg-4">
              <div class="card info-card revenue-card">
                <div class="card-body">
                  <h5 class="card-title">Nombre des étudiants admis en Licence</h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-currency-dollar"></i>
                    </div>
                    <div class="ps-3">
                    <h1><?= esc($nb_admis) ?></h1>

                    </div>
                  </div>
                </div>

              </div>
            </div><!-- End Revenue Card -->

            <!-- Customers Card -->
            <div class="col-lg-4">

              <div class="card info-card customers-card">

                <div class="card-body">
                  <h5 class="card-title">Nombre des étudiants ajournée en Licence</h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-people"></i>
                    </div>
                    <div class="ps-3">
                    <h1><?= esc($nb_ajournee) ?></h1>
                    </div>
                  </div>

                </div>
              </div>

            </div><!-- End Customers Card -->
        </div>
    </section>
</main>