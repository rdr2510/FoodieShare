<?php
    require_once('./Modeles/sessions.php');
    $sessions= new Sessions('./Datas/Sessions.json');
    $user;
    if ($_SERVER["REQUEST_METHOD"] == "GET") {
        if (isset($_GET['action'])){
            if ($_GET['action']=='DECONNECTER'){
                $sessions->clear();
            }
        }
    }

    if ($sessions->isActive()){
        $user= $sessions->get();
    }
?>

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
                        <li><a class="dropdown-item text-light d-flex align-items-centrer px-4" href="../index.php?menu=LIST_REPAS"><span style="margin-right: 8px" class="material-symbols-rounded">lunch_dining</span>Les plats</a></li>
                        <li><a class="dropdown-item text-light d-flex align-items-centrer px-4" href="#" data-bs-toggle="offcanvas" data-bs-target="#offcanvasTop" aria-controls="offcanvasTop"><span style="margin-right: 8px" class="material-symbols-rounded">manage_search</span>Recherche & filtre</a></li>
                        <?php if (isset($user)){ ?>
                            <li><a class="dropdown-item text-light d-flex align-items-center" href="#" data-bs-toggle="modal" data-bs-target="#add-repas"><span class="material-symbols-rounded" style="margin-right: 10px">add_circle</span>Ajouter Nouveau</a></li>
                        <?php } ?>
                    </ul>
                </div>
            </ul>
            
            <?php if (!isset($user)){ ?>
                <div id="user-connection" class="d-flex justify-content-center">
                    <a class="btn btn-primary btn-outline-light rounded-0 m-0 w-xl-100 rounded-start" href="../index.php?menu=LOGIN">SE CONNECTER</a>
                    <a class="btn btn-light rounded-0 m-0 w-xl-100 rounded-end fw-bold" href="../index.php?menu=NEW_PROFIL">NOUVEAU COMPTE</a>
                </div>
            <?php } else {?>
                <div class="dropdown" style="margin-right: 20px;">
                    <a class="nav-link text-light dropdown-toggle d-flex align-items-center py-1 mx-0 px-4" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <?= $user->prenom . ' ' . strtoupper($user->nom) ?><span class="px-2 material-symbols-rounded fs-2">account_circle</span>
                    </a>
                    <ul class="dropdown-menu bg-primary">
                        <li><a class="dropdown-item text-light d-flex align-items-center" href=<?= './index?menu=VIEW_PROFIL&userId='.$user->id?>><span class="material-symbols-rounded" style="margin-right: 10px">account_box</span>Profil</a></li>
                        <li><hr class="dropdown-divider text-light"></li>
                        <li><button type="button" class="dropdown-item text-light d-flex align-items-center" href="#" data-bs-toggle="modal" data-bs-target="#logout"><span class="material-symbols-rounded" style="margin-right: 10px">exit_to_app</span>DéConnecter</button></li>
                    </ul>
                </div>
            <?php } ?>
        </div>
    </div>
</nav>

<div class="modal fade" id="logout" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h1 class="modal-title fs-5 text-white d-flex align-items-center" id="staticBackdropLabel"><span class="material-symbols-rounded" style="margin-right: 5px;">person_off</span>DECONNEXION</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Voulez-vous vraiment déconnecter ?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary d-flex align-items-center" data-bs-dismiss="modal"><span class="material-symbols-rounded" style="margin-right: 5px;">cancel</span>Annuler</button>
                <a type="button" class="btn btn-primary d-flex align-items-center" href="./index?menu=LIST_REPAS&action=DECONNECTER">DéConnecter<span class="material-symbols-rounded" style="margin-left: 5px;">output</span></a>
            </div>
        </div>
    </div>
</div>