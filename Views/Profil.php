<?php
    function test_input($data) {
        $data= trim($data);
        $data= stripslashes($data);
        $data= htmlspecialchars($data);
        return $data;
    }

    $errorNom= false;
    $errorPrenom= false;
    $errorUsername= false;
    $errorPassword= false;
    $nom= '';
    $prenom= '';
    $username= '';
    $password= '';
    $action= '';
    if (isset($_POST['nom']) && isset($_POST['prenom']) && isset($_POST['username']) && isset($_POST['password']) && isset($_POST['action'])){
        $action= $_POST['action'];
        $nom= $_POST['nom'];
        if (empty($nom)){
            $errorNom= true;
        } else {
            $nom= test_input($nom);
        }
        $prenom= $_POST['prenom'];
        if (empty($prenom)){
            $errorPrenom= true;
        } else {
            $prenom= test_input($prenom);
        }
        $username= $_POST['username'];
        if (empty($username)){
            $errorUsername= true;
        } else {
            $username= test_input($username);
        }
        $password= $_POST['password'];
        if (empty($password)){
            $errorPassword= true;
        } else {
            $password= test_input($password);
        }
        if ($errorNom==false && $errorPrenom==false && $errorUsername==false && $errorPassword==false && $action=='ADD'){
            require_once('./Modeles/users.php');
            $users= new Users('./Datas/Users.json');
            if (!$users->isExist($nom, $prenom, $username)){
                $users->add($nom, $prenom, $username, $password);
                echo "<script type='text/javascript'>window.top.location='./index.php?menu=PROFIL_SUCCESS';</script>"; 
                exit;
            } else {
                echo "<script type='text/javascript'>window.top.location='./index.php?menu=PROFIL_FAILED';</script>"; 
                exit;
            }
        }
    } else if (isset($_POST['action'])){
        $action= $_POST['action'];
    }
?>

<div class="d-flex justify-content-center align-items-center" style="height: 100%; width: 100%">
    <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" id="add-profil" class="d-flex justify-content-end position-relative flex-column" style="height: 440px">
            <img id="profil-image" class="d-none d-lg-flex" src="../assets/Images/about-us-hero-image-t.jpg" alt="" height="35%">
            <div id="profil-input" class="d-flex flex-column justify-content-center align-items-center bg-primary p-4">
                <span class="text-white material-symbols-rounded m-0 p-0" style="font-size: 70px; margin-bottom: 15px;">account_circle</span>
                <h3 class="fw-bold text-light" style="margin-bottom: 40px;">NOUVEAU UTILISATEUR</h3>
                <div class="input-group mb-3">
                    <span class="input-group-text material-symbols-rounded text-primary">badge</span>
                    <input id="input" type="text" class="form-control" placeholder="Nom" name="nom" <?=$action=='VIEW'?'value='.$nom:''?> <?=$action=='VIEW'?'disabled':''?> required>
                </div>
                <div class="input-group mb-3">
                    <span class="input-group-text material-symbols-rounded text-primary">badge</span>
                    <input id="input" type="text" class="form-control" placeholder="Prénom" name="prenom" <?=$action=='VIEW'?'value='.$prenom:''?> <?=$action=='VIEW'?'disabled':''?> required>
                </div>
                <div class="input-group mb-3">
                    <span class="input-group-text material-symbols-rounded text-primary">shield_person</span>
                    <input id="input" type="text" class="form-control" placeholder="Nom d'utilisateur" name="username" <?=$action=='VIEW'?'value='.$username:''?> <?=$action=='VIEW'?'disabled':''?> required>
                </div>
                <div class="input-group">
                    <span class="input-group-text material-symbols-rounded text-primary">password</span>
                    <input id="input" type="password" class="form-control" placeholder="Mot de passe" name="password" <?=$action=='VIEW'?'value='.$password:''?> <?=$action=='VIEW'?'disabled':''?> required>
                </div>
                <div class="d-flex justify-content-evenly w-100" style="margin-top: 35px;">
                    <input type="hidden" name="action" value="ADD">
                    <a type="button" class="btn btn-secondary btn-outline-light d-flex align-items-center" href="./index?menu=LIST_REPAS"><span class="material-symbols-rounded" style="margin-right: 10px;">close</span><?=$action=='ADD'?'Annuler':'Fermer'?></a>
                    <?= $action=='ADD'?'<button name="menu" value="NEW_PROFIL" type="submit" class="btn btn-primary btn-outline-light d-flex align-items-center"><span class="material-symbols-rounded" style="margin-right: 10px;">cloud_upload</span>Enregistrer</button>':''?>
                </div>
            </div>
    </form>
</div>