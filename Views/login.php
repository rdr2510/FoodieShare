<?php
    function test_input($data) {
        $data= trim($data);
        $data= stripslashes($data);
        $data= htmlspecialchars($data);
        return $data;
    }
    $errorUsername= false;
    $errorPassword= false;
    if (isset($_POST['username']) && isset($_POST['password']) && isset($_POST['action'])){
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

        if ($errorUsername==false && $errorPassword==false){
            require_once('./Modeles/users.php');
            $users= new Users('./Datas/Users.json');
            $id= $users->login($username, $password);
            if ($id>0){
                $user= $users->get($id);
                require_once('./Modeles/sessions.php');
                $sessions= new Sessions('./Datas/Sessions.json');
                $sessions->clear();
                $sessions->set($user);
                echo "<script type='text/javascript'>window.top.location='./index.php?menu=LIST_REPAS';</script>"; 
                exit;
            } else {
                echo "<script type='text/javascript'>window.top.location='./index.php?menu=LOGIN_FAILED';</script>"; 
                exit;
            }
        }
    }
?>
    <div class="d-flex justify-content-center align-items-center" style="height: 90%; width: 100%">
        <form id="login" class="d-flex justify-content-end position-relative" style="height: 440px" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
            <img id="login-left" class="d-none d-lg-flex" src="../assets/Images/food_logo.jpg" alt="">
            <div id="login-right" class="d-flex flex-column justify-content-center align-items-center bg-primary p-4">
                <span class="text-white material-symbols-rounded m-0 p-0" style="font-size: 70px; margin-bottom: 15px;">account_circle</span>
                <h3 class="fw-bold text-light" style="margin-bottom: 55px;">AUTHENTIFICATION</h3>
                <div class="input-group mb-3" style="width: 265px;">
                    <span class="input-group-text material-symbols-rounded text-primary">person</span>
                    <input type="text" class="form-control" placeholder="Nom d'utilisateur" name="username" require>
                    <?php echo ($errorUsername==true)?'<span class="input-group-text material-symbols-rounded text-white bg-danger">priority_high</span>':''; ?>
                </div>
                <div class="input-group" style="width: 265px;">
                    <span class="input-group-text material-symbols-rounded text-primary">password</span>
                    <input type="password" class="form-control" placeholder="Mot de passe" name="password" require>
                    <?php echo ($errorPassword==true)?'<span class="input-group-text material-symbols-rounded text-white bg-danger">priority_high</span>':''; ?>
                </div>
                <div style="margin-top: 25px;">
                    <div id="user-connection" class="d-flex flex-column">
                        <input type="hidden" name="action" value="connecter">
                        <button name="menu" value="LOGIN" class="btn btn-primary btn-outline-light m-0 w-xl-100 d-flex align-items-center justify-content-center">SE CONNECTER<span class="material-symbols-rounded" style="margin-left: 8px;">login</span></button>
                        <a class="text-white text-center" style="margin-top: 15px;" href="../index.php?menu=NEW_PROFIL">Nouveau Compte</a>
                    </div>
                </div>
            </div>
        </form>
    </div>