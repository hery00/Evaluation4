
<aside id="sidebar" class="sidebar">
    <ul class="sidebar-nav" id="sidebar-nav">
        <li class="nav-item">
            <a class="nav-link " href="<?= base_url('/listesemestre') ?>">
                <i class="bi bi-grid"></i>
                <span>Liste des semestres</span>
            </a>
        </li>
        <li class="nav-item">
            <center> 
                <form action="<?= site_url('/etudiant/logout') ?>" method="post">
                    <button type="submit" class="btn btn-primary">Logout</button>
                </form>
            </center>
        </li>
    </ul>
</aside><!-- End Sidebar-->
