<?php
    require_once('./Modeles/sessions.php');
    $sessions= new Sessions('./Datas/Sessions.json');
    $user;
    if (!$sessions->isActive()){
        echo "<script type='text/javascript'>window.top.location='./index.php?menu=LOGIN';</script>"; 
        exit;
    }
?>

<div class="d-flex justify-content-center align-items-center" style="height: 80%; width: 100%">
    <div id="add-profil" class="d-flex justify-content-between flex-column mx-5">

        <div id= "title-login-failed"class="d-flex flex-column justify-content-center align-items-center p-1 bg-success">    
            <span id="icon-login-failed" class="material-symbols-rounded text-white">check_circle</span>
        </div>

        <div class="d-flex flex-column justify-content-start align-items-start p-4">
            <p class="fs-3 text-success w-100 text-center mb-4 fw-bold"><?= $titre?></p>
            <p class="fs-5 text-center w-100"><?= $resultat?></p>
        </div>

        <div class="d-flex justify-content-center w-100 mb-4">
            <a type="button" class="btn btn-success btn-outline-light d-flex align-items-center" href=<?= $url?>><span class="material-symbols-rounded" style="margin-right: 10px;">arrow_back</span>Retour</a>
        </div>
    </div>
</div>