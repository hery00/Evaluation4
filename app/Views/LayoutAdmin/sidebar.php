<aside style="background-color:#536ae4; " id="sidebar" class="sidebar">
    <ul class="sidebar-nav" id="sidebar-nav">
        <li class="nav-item">
            <a class="nav-link " href="<?= base_url('admin/dashboard') ?>">
            <img style="max-width: 20px;" src="<?= base_url('assets/icons/PNG/ITU_icon_4.png')?>" alt="icons">
                <span>Dashboard</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link " href="<?= base_url('admin/listetudiant') ?>">
            <img style="max-width: 20px;" src="<?= base_url('assets/icons/PNG/ITU_icon_4.png')?>" alt="icons">
                <span>Liste des Etudiants</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link " href="<?=base_url('admin/formulairenote') ?>">
            <i class="bi bi-menu-button-wide"></i>
                <span>Insertions notes</span>
            </a>
        </li>
        <li class="nav-item">
        <a class="nav-link " href="<?= base_url('admin/import') ?>">
        <img style="max-width: 20px;" src="<?= base_url('assets/icons/PNG/ITU_icon_4.png')?>" alt="icons">
            <span>Import de données</span>
        </a>
        </li>
        <li class="nav-item">
            <center> 
                <form action="<?= base_url('admin/resetables') ?>" method="get">
                    <button style="background-color: #b2d235;color:#283a97;" type="submit" class="btn btn-primary">Réinitialiser la base</button>
                </form>
            </center>
        </li>
        <li class="nav-item">
            <center> 
                <form action="<?= site_url('admin/logout') ?>" method="post">
                    <button style="background-color:#ff4336;" type="submit" class="btn btn-primary">Logout</button>
                </form>
            </center>
        </li>
    </ul>
</aside><!-- End Sidebar-->
