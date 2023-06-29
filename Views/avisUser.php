<?php
    require_once('./Modeles/sessions.php');
    $sessions= new Sessions('./Datas/Sessions.json');
    $user;
    if (!$sessions->isActive()){
        echo "<script type='text/javascript'>window.top.location='./index.php?menu=LOGIN';</script>"; 
        exit;
    } else {
        $user= $sessions->get();
    }
    
    require('./Modeles/repas.php');
    $repas= new Repas('./Datas/Repas.json');
    if (isset($platId)){
        $diner= $repas->get($platId);
    }

    function test_input($data) {
        $data= trim($data);
        $data= stripslashes($data);
        $data= htmlspecialchars($data);
        return $data;
    }

    
    $errorRating= false;
    $errorCommentaire= false;
    $rating= 0;
    $commentaire= '';
    $action= '';
    if (isset($platId) && isset($_POST['rating']) && isset($_POST['commentaire']) && isset($_POST['action'])){
        $action= $_POST['action'];
        $rating= $_POST['rating'];
        if ((int)$rating === 0){
            $errorRating= true;
        } else {
            $rating= (int)test_input($rating);
        }
        $commentaire= $_POST['commentaire'];
        if (empty($commentaire)){
            $errorCommentaire= true;
        } else {
            $commentaire= test_input($commentaire);
        }
        if ($errorRating==false && $errorCommentaire==false && $errorUserId==false && $action=='ADD'){
            require_once('./Modeles/avis.php');
            $avis= new Avis('./Datas/Avis.json');
            $avis->add($user->id, $platId, $rating, $commentaire);
            echo "<script type='text/javascript'>window.top.location='./index.php?menu=ADD_AVIS_SUCCESS&platId=".$platId."';</script>"; 
            exit;
        }
    } else if (isset($_POST['action'])){
        $action= $_POST['action'];
    }
?>

<div class="d-flex justify-content-center align-items-center" style="height: 100%; width: 100%">        
    <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" id="add-profil" class="d-flex justify-content-end position-relative flex-column mx-4" style="height: 450px; width:550px">
            <div class="border border-primary border-2 d-flex align-items-end justify-content-between" id= "title-login-failed">
                <span class="material-symbols-rounded ms-4 mt-2" style="font-size: 125px">3p</span>
                <div class="d-flex flex-column justify-content-center me-4">
                    <span class="material-symbols-rounded m-0 p-0 text-center text-primary" style="font-size: 70px">add_comment</span>
                    <h3 class="fw-bold text-primary">NOUVEAU AVIS</h3>
                </div>
            </div>        
    
            <div id="profil-input" class="d-flex flex-column justify-content-center align-items-center bg-primary pt-3 p-4">
                <div class="border border-white w-100 mb-3 pb-2 rounded">
                    <div class="fs-5 d-flex align-items-center rounded-top-1 py-0"><span class="material-symbols-rounded text-warning ms-2">lunch_dining</span><span class="text-white fw-bold ms-2"><?=$diner->nom?></span></div>
                    <div class="d-flex">
                        <div class="d-flex justify-content-center flex-column mt-2">
                            <div style="width: 9rem;" class="text-start m-2 mb-1 mt-0">
                                <span class="badge bg-info rounded-bottom-0 w-100 border-bottom text-black fw-bold border-black">LOCALISATION</span>
                                <h5 style="font-size: 16px; padding-top:2px; padding-bottom:2px" class="card-title badge bg-info text-black d-flex align-items-center justify-content-center rounded-top-0">
                                    <span class="text-danger material-symbols-rounded">distance</span><?=$diner->localisation?>Km
                                </h5>
                            </div>
                            <div style="width: 9rem;" class="text-end m-2 mb-0">
                                <span class="badge bg-warning rounded-bottom-0 w-100 border-bottom text-black fw-bold border-black">PRIX</span> 
                                <h5 style="font-size: 16px; padding-top:2px; padding-bottom:2px" class="card-title badge bg-warning text-black d-flex align-items-center justify-content-center rounded-top-0">
                                    <span class="text-danger material-symbols-rounded">paid</span><?=$diner->prix?>$
                                </h5>
                            </div>
                        </div>
                        <p class="mt-1 w-100 text-white"><?=$diner->description?></p>
                    </div>
                </div>

                <div class="input-group rounded mb-3">
                    <div id="input" class="input-group rounded">
                        <span class="input-group-text material-symbols-rounded text-primary">hotel_class</span>
                        <select class="form-select" id="notes" name="rating" required>
                            <option value="0" selected>Aucun note</option>
                            <option value="1">Note 1</option>
                            <option value="2">Note 2</option>
                            <option value="3">Note 3</option>
                            <option value="4">Note 4</option>
                            <option value="5">Note 5</option>
                        </select>
                        <div class="input-group-text">
                            <span class="material-symbols-rounded text-secondary fw-bold" id="note1">star</span>
                            <span class="material-symbols-rounded text-secondary fw-bold" id="note2">star</span>
                            <span class="material-symbols-rounded text-secondary fw-bold" id="note3">star</span>
                            <span class="material-symbols-rounded text-secondary fw-bold" id="note4">star</span>
                            <span class="material-symbols-rounded text-secondary fw-bold" id="note5">star</span>
                        </div>
                    </div>
                    <?php if ($errorRating==true){?>
                        <div class="text-end text-danger fw-bold w-100">S'il vous plait, Choisisez une note...</div>
                    <?php } ?>
                </div>

                <div id="input" class="input-group rounded border-primary">
                    <span class="input-group-text material-symbols-rounded text-primary">post</span>
                    <textarea class="form-control" name="commentaire" rows="3" placeholder="Commentaire" required></textarea>
                </div>

                <div class="d-flex w-100 justify-content-evenly mt-4">
                    <input type="hidden" name="action" value="ADD">
                    <input type="hidden" name="platId" value=<?= $platId ?>>
                    <a type="button" class="btn btn-secondary btn-outline-light d-flex align-items-center" href="./index.php?menu=LIST_REPAS"><span class="material-symbols-rounded" style="margin-right: 10px;">close</span>Annuler</a>
                    <button name="menu" value="NEW_AVIS" type="submit" class="btn btn-primary btn-outline-light d-flex align-items-center"><span class="material-symbols-rounded" style="margin-right: 10px;">cloud_upload</span>Enregistrer</button>
                </div>
            </div>
    </form>
</div>