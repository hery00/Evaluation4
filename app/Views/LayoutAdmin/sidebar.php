<aside id="sidebar" class="sidebar">
    <ul class="sidebar-nav" id="sidebar-nav">
        <li class="nav-item">
            <a class="nav-link " href="<?= base_url('admin/listetudiant') ?>">
                <i class="bi bi-grid"></i>
                <span>Liste des Etudiants</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link " href="<?=base_url('admin/formulairelocation') ?>">
            <i class="bi bi-menu-button-wide"></i>
                <span>Insertions notes</span>
            </a>
        </li>
        <li class="nav-item">
        <a class="nav-link " href="<?= base_url('admin/import') ?>">
            <i class="bi bi-menu-button-wide"></i>
            <span>Import de données</span>
        </a>
        </li>
        <li class="nav-item">
            <center> 
                <form action="<?= base_url('admin/resetables') ?>" method="get">
                    <button type="submit" class="btn btn-primary">Réinitialiser la base</button>
                </form>
            </center>
        </li>
        <li class="nav-item">
            <center> 
                <form action="<?= site_url('admin/logout') ?>" method="post">
                    <button type="submit" class="btn btn-primary">Logout</button>
                </form>
            </center>
        </li>
    </ul>
</aside><!-- End Sidebar-->
