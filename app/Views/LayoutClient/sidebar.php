
<aside id="sidebar" class="sidebar">
    <ul class="sidebar-nav" id="sidebar-nav">
        <li class="nav-item">
            <a class="nav-link " href="<?= base_url('/client/listeloyer') ?>">
                <i class="bi bi-grid"></i>
                <span>Liste des loyer</span>
            </a>
        </li>
        <li class="nav-item">
            <center> 
                <form action="<?= site_url('/client/logout') ?>" method="post">
                    <button type="submit" class="btn btn-primary">Logout</button>
                </form>
            </center>
        </li>
    </ul>
</aside><!-- End Sidebar-->
