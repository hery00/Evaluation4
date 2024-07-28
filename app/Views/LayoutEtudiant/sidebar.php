
<aside style="background-color:#536ae4; " id="sidebar" class="sidebar">
    <ul class="sidebar-nav" id="sidebar-nav">
        <li class="nav-item">
            <a class="nav-link " href="<?= base_url('/listesemestre') ?>">
                <img style="max-width: 30px;" src="<?= base_url('assets/icons/PNG/ITU_icon_4.png')?>" alt="icons">
                <span>Liste des semestres</span>
            </a>
        </li>
        <li class="nav-item">
            <center> 
                <form action="<?= site_url('/etudiant/logout') ?>" method="post">
                    <button style="background-color:#ff4336;font-weight:bold;" type="submit" class="btn btn-primary">Logout</button>
                </form>
            </center>
        </li>
    </ul>
</aside><!-- End Sidebar-->
