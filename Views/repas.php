<?php
    require_once('./Modeles/sessions.php');
    $sessions= new Sessions('./Datas/Sessions.json');
    $user;
    if (!$sessions->isActive()){
        echo "<script type='text/javascript'>window.top.location='./index.php?menu=LOGIN';</script>"; 
        exit;
    }
    
    function test_input($data) {
        $data= trim($data);
        $data= stripslashes($data);
        $data= htmlspecialchars($data);
        return $data;
    }

    $errorNom= false;
    $errorPrix= false;
    $errorLocalisation= false;
    $errorDescription= false;
    $nom= '';
    $prix= 0;
    $localisation= 0;
    $description= '';
    $action= '';
    if (isset($_POST['nom']) && isset($_POST['prix']) && isset($_POST['localisation']) && isset($_POST['description']) && isset($_POST['action'])){
        $action= $_POST['action'];
        $nom= $_POST['nom'];
        if (empty($nom)){
            $errorNom= true;
        } else {
            $nom= test_input($nom);
        }
        $prix= $_POST['prix'];
        if (empty($prix)){
            $errorPrix= true;
        } else {
            $prix= (float)test_input($prix);
        }
        $localisation= $_POST['localisation'];
        if (empty($localisation)){
            $errorLocalisation= true;
        } else {
            $localisation= (float)test_input($localisation);
        }
        $description= $_POST['description'];
        if (empty($description)){
            $errorDescription= true;
        } else {
            $description= test_input($description);
        }
        if ($errorNom==false && $errorPrix==false && $errorLocalisation==false && $errorDescription==false && $action=='ADD'){
            require_once('./Modeles/repas.php');
            $repas= new Repas('./Datas/Repas.json');
            $repas->add($nom, $description, $prix, $localisation);
            echo "<script type='text/javascript'>window.top.location='./index.php?menu=ADD_REPAS_SUCCESS';</script>"; 
            exit;
        }
    } else if (isset($_POST['action'])){
        $action= $_POST['action'];
    }
?>

<div class="d-flex justify-content-center align-items-center" style="height: 100%; width: 100%">        
    <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" id="add-profil" class="d-flex justify-content-end position-relative flex-column mx-4" style="height: 450px; width:550px">
            <img id="profil-image" class="d-none d-lg-flex" src="../assets/Images/47492_1.png" alt="" height="35%" width="auto">
            <div id="profil-input" class="d-flex flex-column justify-content-center align-items-center bg-primary p-4">
                <span class="text-white material-symbols-rounded m-0 p-0" style="font-size: 70px; margin-bottom: 15px;">restaurant_menu</span>
                <h3 class="fw-bold text-light" style="margin-bottom: 40px;">NOUVEAU PLAT</h3>
                <div id="input" class="input-group mb-3 rounded">
                    <span class="input-group-text material-symbols-rounded text-primary">lunch_dining</span>
                    <input type="text" class="form-control" placeholder="Nom du plat" name="nom" required>
                </div>
                <div class="d-flex gap-md-4 flex-column flex-md-row w-100">
                    <div id="input" class="input-group mb-3 rounded border-primary ">
                        <span class="input-group-text material-symbols-rounded text-primary">monetization_on</span>
                        <input type="number" class="form-control" step="any" aria-label="Prix unitaire du plat" placeholder="Prix Unitaire" name="prix" required>
                        <span class="input-group-text fw-bold">$</span>
                    </div>
                    <div id="input" class="input-group mb-3 rounded border-primary">
                        <span class="input-group-text material-symbols-rounded text-primary">distance</span>
                        <input type="number" class="form-control" step="any" aria-label="Prix unitaire du plat" placeholder="Localisation" name="localisation" required>
                        <span class="input-group-text fw-bold">Km</span>
                    </div>
                </div>
                <div id="input" class="input-group mb-3 rounded border-primary">
                    <span class="input-group-text material-symbols-rounded text-primary">post</span>
                    <textarea class="form-control" name="description" rows="3" placeholder="Description"></textarea>
                </div>

                <div class="d-flex w-100 justify-content-evenly mt-4">
                    <input type="hidden" name="action" value="ADD">
                    <a type="button" class="btn btn-secondary btn-outline-light d-flex align-items-center" href="./index?menu=LIST_REPAS"><span class="material-symbols-rounded" style="margin-right: 10px;">close</span>Annuler</a>
                    <button name="menu" value="NEW_REPAS" type="submit" class="btn btn-primary btn-outline-light d-flex align-items-center"><span class="material-symbols-rounded" style="margin-right: 10px;">cloud_upload</span>Enregistrer</button>
                </div>
            </div>
    </form>
</div>