<nav class="navbar navbar-expand-lg sticky-top bg-primary p-0">
    <div class="container-fluid">
        <a class="navbar-brand text-light fw-bold" href="#">
            <div class="d-flex">
                <div class="bg-black d-flex align-items-center px-1 fs-1 rounded-start">
                    <span class="fs-1 material-symbols-rounded text-warning">restaurant_menu</span>FOODIE
                </div>             
                <div class="bg-white d-flex align-items-center text-black fs-1 px-1 rounded-end">SHARE</div>
            </div>
        </a>
        <button class="navbar-toggler text-light" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon text-light"></span>
        </button>

        <div class="collapse navbar-collapse my-0" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link text-light d-flex align-items-centrer px-4" aria-current="page" href="#"><span class="material-symbols-rounded" style="margin-right: 8px">home</span>ACCUEIL</a>
                </li>
                <div class="dropdown">
                    <a class="nav-link text-light dropdown-toggle d-flex align-items-center px-4" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <span class="material-symbols-rounded" style="margin-right: 8px">fastfood</span>LES REPAS
                    </a>
                    <ul class="dropdown-menu bg-primary">
                        <li><a class="dropdown-item text-light d-flex align-items-centrer px-4" href="#" data-bs-toggle="offcanvas" data-bs-target="#offcanvasTop" aria-controls="offcanvasTop"><span style="margin-right: 8px" class="material-symbols-rounded">manage_search</span>Recherche & filtre</a></li>
                        <li><a class="dropdown-item text-light d-flex align-items-center" href="#" data-bs-toggle="modal" data-bs-target="#staticBackdrop"><span class="material-symbols-rounded" style="margin-right: 10px">add_circle</span>Ajouter Nouveau</a></li>
                    </ul>
                </div>
            </ul>
            
            <div id="user-connection" class="d-flex">
                <button class="btn btn-primary btn-outline-light rounded-0 m-0 w-xl-100 rounded-start">SE CONNECTER</button>
                <button class="btn btn-light rounded-0 m-0 w-xl-100 rounded-end fw-bold">NOUVEAU COMPTE</button>
            </div>

            <div class="dropdown d-none" style="margin-right: 20px;">
                <a class="nav-link text-light dropdown-toggle d-flex align-items-center py-1 mx-0 px-4" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    Connecter<span class="px-2 material-symbols-rounded fs-2">account_circle</span>
                </a>
                <ul class="dropdown-menu bg-primary">
                    <li><a class="dropdown-item text-light d-flex align-items-center" href="#"><span class="material-symbols-rounded" style="margin-right: 10px">account_box</span>Profil</a></li>
                    <li><hr class="dropdown-divider text-light"></li>
                    <li><a class="dropdown-item text-light d-flex align-items-center" href="#"><span class="material-symbols-rounded" style="margin-right: 10px">exit_to_app</span>DéConnecter</a></li>
                </ul>
            </div>
        </div>
    </div>
</nav>