<?php
    require_once('./Modeles/sessions.php');
    $sessions= new Sessions('./Datas/Sessions.json');
    $user;
    if ($sessions->isActive()){
        $user= $sessions->get();
    }

    require_once('./Modeles/repas.php');
    $repas= new Repas('./Datas/Repas.json');
    if (isset($platId)){
        $diner= $repas->get($platId);

        require_once('./Modeles/avis.php');
        $avis= new Avis('./Datas/Avis.json');
        $listAvis= $avis->getAllbyPlat($platId);

        require_once('./Modeles/users.php');
        $users= new Users('./Datas/Users.json');

        require_once('./Modeles/photos.php');
        $photos= new Photos('./Datas/Photos.json');
    }
?>

<div class="container-fluid" style="height: 100%";>        
    
        <div id=plat-<?=$diner->id?> class="plat card border-2 border-primary m-4 mx-4" style="height: 85%;">
            <div class="card-header badge bg-primary fs-5 d-flex align-items-center rounded-top-1 py-0"><span class="material-symbols-rounded text-warning">lunch_dining</span>&nbsp;<span class="text-truncate py-3"><?=$diner->nom?></span></div>
            <div class="border-primary" style="border: 2px solid; border-left-width: 0; border-right-width: 0; border-top-width: 0;">
                <div class="card-body pb-0 d-flex flex-column flex-lg-row pt-0">
                    <div class="d-flex justify-content-center flex-lg-column flex-row mt-2">
                        <div style="width: 9rem;" class="text-start me-1 me-lg-2">
                            <span class="badge bg-info rounded-bottom-0 w-100 border-bottom text-black fw-bold border-black">LOCALISATION</span>
                            <h5 style="font-size: 16px; padding-top:2px; padding-bottom:2px" class="card-title badge bg-info text-black d-flex align-items-center justify-content-center rounded-top-0">
                                <span class="text-danger material-symbols-rounded">distance</span><?=$diner->localisation?>Km
                            </h5>
                        </div>
                        <div style="width: 9rem;" class="text-end ms-1 ms-lg-0 me-lg-2">
                            <span class="badge bg-warning rounded-bottom-0 w-100 border-bottom text-black fw-bold border-black">PRIX</span> 
                            <h5 style="font-size: 16px; padding-top:2px; padding-bottom:2px" class="card-title badge bg-warning text-black d-flex align-items-center justify-content-center rounded-top-0">
                                <span class="text-danger material-symbols-rounded">paid</span><?=$diner->prix?>$
                            </h5>
                        </div>
                    </div>
                    <p class="card-text mt-lg-2 w-100"><?=$diner->description?></p>
                    <?php if (isset($user)){
                          if (!$avis->isUserComment($user->id, $platId)){?>
                            <div class="d-flex align-items-center justify-content-center p-2"><a href=<?="../index.php?menu=NEW_AVIS&platId=".$platId?> type="button" class="btn btn-primary d-flex align-items-center justify-content-center"><span class="material-symbols-rounded p-0 me-2 fs-3 d-flex align-items-center">add_comment</span>Ajouter Commentaire</a></div>
                    <?php } else { ?>
                            <div class="d-flex align-items-center justify-content-center p-2"><a href=<?="../index.php?menu=NEW_PHOTO&platId=".$platId?> type="button" class="btn btn-primary d-flex align-items-center justify-content-center"><span class="material-symbols-rounded p-0 me-2 fs-3 d-flex align-items-center">share_reviews</span>Partager Photo</a></div>
                    <?php }
                    } ?>
                </div>
            </div>
            
            <div style="overflow-y: auto;">
            <?php foreach($listAvis as $comm){?>
            <div class="m-4">
                <div class="d-flex justify-content-between">
                    <div class="d-flex align-items-center">
                        <span class="material-symbols-rounded me-1 fw-bold text-primary fs-3">account_circle</span>
                        <span class="text-primary fw-bold d-flex">
                            <?php $user= $users->get($comm->userId); 
                                echo '<span class="d-none d-lg-block">'. $user->prenom.' '.$user->nom.' (</span>'.$user->username.'<span class="d-none d-lg-block">)</span>';
                            ?>
                        </span>
                    </div>
                    <div class="d-flex align-items-center me-2">
                        <span class="text-primary fw-bold me-2 fs-5 d-none d-lg-block">Notes:</span>
                        <?php switch($comm->note){
                            case 0:?>                        
                                <div class="d-flex align-items-center">
                                    <span class="material-symbols-rounded text-secondary fw-bold" id="note1">star</span>
                                    <span class="material-symbols-rounded text-secondary fw-bold" id="note2">star</span>
                                    <span class="material-symbols-rounded text-secondary fw-bold" id="note3">star</span>
                                    <span class="material-symbols-rounded text-secondary fw-bold" id="note4">star</span>
                                    <span class="material-symbols-rounded text-secondary fw-bold" id="note5">star</span>
                                </div>
                                <?php break; 
                            case 1:?>
                                <div class="d-flex align-items-center">
                                    <span class="material-symbols-rounded text-warning fw-bold" id="note1">star</span>
                                    <span class="material-symbols-rounded text-secondary fw-bold" id="note2">star</span>
                                    <span class="material-symbols-rounded text-secondary fw-bold" id="note3">star</span>
                                    <span class="material-symbols-rounded text-secondary fw-bold" id="note4">star</span>
                                    <span class="material-symbols-rounded text-secondary fw-bold" id="note5">star</span>
                                </div>
                                <?php break; 
                            case 2:?>
                                <div class="d-flex align-items-center">
                                    <span class="material-symbols-rounded text-warning fw-bold" id="note1">star</span>
                                    <span class="material-symbols-rounded text-warning fw-bold" id="note2">star</span>
                                    <span class="material-symbols-rounded text-secondary fw-bold" id="note3">star</span>
                                    <span class="material-symbols-rounded text-secondary fw-bold" id="note4">star</span>
                                    <span class="material-symbols-rounded text-secondary fw-bold" id="note5">star</span>
                                </div>
                                <?php break; 
                            case 3:?>
                                <div class="d-flex align-items-center">
                                    <span class="material-symbols-rounded text-warning fw-bold" id="note1">star</span>
                                    <span class="material-symbols-rounded text-warning fw-bold" id="note2">star</span>
                                    <span class="material-symbols-rounded text-warning fw-bold" id="note3">star</span>
                                    <span class="material-symbols-rounded text-secondary fw-bold" id="note4">star</span>
                                    <span class="material-symbols-rounded text-secondary fw-bold" id="note5">star</span>
                                </div>
                                <?php break; 
                            case 4:?>
                                <div class="d-flex align-items-center">
                                    <span class="material-symbols-rounded text-warning fw-bold" id="note1">star</span>
                                    <span class="material-symbols-rounded text-warning fw-bold" id="note2">star</span>
                                    <span class="material-symbols-rounded text-warning fw-bold" id="note3">star</span>
                                    <span class="material-symbols-rounded text-warning fw-bold" id="note4">star</span>
                                    <span class="material-symbols-rounded text-secondary fw-bold" id="note5">star</span>
                                </div>
                                <?php break; 
                            case 5:?>
                                <div class="d-flex align-items-center">
                                    <span class="material-symbols-rounded text-warning fw-bold" id="note1">star</span>
                                    <span class="material-symbols-rounded text-warning fw-bold" id="note2">star</span>
                                    <span class="material-symbols-rounded text-warning fw-bold" id="note3">star</span>
                                    <span class="material-symbols-rounded text-warning fw-bold" id="note4">star</span>
                                    <span class="material-symbols-rounded text-warning fw-bold" id="note5">star</span>
                                </div>
                        <?php } ?>
                    </div>
                </div>    

                <div id="avis" class="bg-primary ms-4 ps-4 p-2 text-white">
                    <?= $comm->commentaire; ?>
                </div>
                <div class="d-flex m-2 ms-4 me-4" style="overflow-x: auto">
                        <?php  
                            $listPhotos= $photos->getAll($platId, $user->id);
                            foreach($listPhotos as $photo){
                                echo '<img class="ms-2 me-2 mb-2" src="'.$photo->urlPhoto.'" width="300px">';
                            }
                        ?>
                    </div>
            </div>
            <?php } ?>
            </div>
        </div>
</div>