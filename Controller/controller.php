<?php 
        if ($_SERVER["REQUEST_METHOD"] == "GET") {
            if (isset($_GET['menu'])){
                switch($_GET['menu']){
                    case 'LOGIN':
                        include('./Views/login.php');                    
                        break;
                    case 'LOGIN_FAILED':
                        $titre= 'Oops! Échec de la connexion.';
                        $description= 'Erreur d\'authentification, votre nom d\'utilisateur et/ou mot de passe est incorrect.';
                        $resultat= 'Veuillez réessayer s\'il vous plaît...';
                        $menu= 'LOGIN_FALIED';
                        include('./Views/Failed.php');                              
                        break;
                    case 'LIST_REPAS':
                        if (isset($_GET['action'])){
                            $action= $_GET['action'];
                            switch($action){
                                case 'SUPPRIMER':
                                    if (isset($_GET['platId'])){
                                        $platId= $_GET['platId'];
                                    }
                                    break;
                                case 'RECHERCHE':
                                    if (isset($_GET['recherche']) && isset($_GET['critere'])){
                                        $recherche= $_GET['recherche'];
                                        $critere= (int)$_GET['critere'];
                                    }
                                    if (isset($_GET['prix-min']) && isset($_GET['prix-max'])){
                                        $prixMin= (float)$_GET['prix-min'];
                                        $prixMax= (float)$_GET['prix-max'];
                                    }
                                    if (isset($_GET['distance-min']) && isset($_GET['distance-max'])){
                                        $distanceMin= (float)$_GET['distance-min'];
                                        $distanceMax= (float)$_GET['distance-max'];
                                    }
                                    break;
                            }
                        }
                        
                        include('./Views/listRepas.php');                    
                        break;
                    case 'DETAIL_REPAS':
                        if (isset($_GET['platId'])){
                            $platId= $_GET['platId'];
                        }
                        include('./Views/detailRepas.php');                    
                        break;
                    case 'NEW_REPAS':
                        include('./Views/repas.php');                    
                        break;
                    case 'ADD_REPAS_SUCCESS':
                        $titre= 'Création de nouveau plat avec succées.';
                        $resultat= 'Veuillez rétourner sur la liste.';
                        $url= "../index.php?menu=LIST_REPAS";
                        include('./Views/Success.php');                    
                        break;
                    case 'DELETE_REPAS_SUCCESS':
                        $titre= 'Suppression du plat avec succées.';
                        $resultat= 'Veuillez rétourner sur la liste.';
                        $url= "../index.php?menu=LIST_REPAS";
                        include('./Views/Success.php');                    
                        break;
                    case 'NEW_PROFIL':
                        $_POST['action']= 'ADD';
                        include('./Views/Profil.php');                    
                        break;
                    case 'VIEW_PROFIL':
                        require_once('./Modeles/users.php');
                        $users= new Users('./Datas/Users.json');
                        $user= $users->get($_GET['userId']);
                        $_POST['nom']= $user->nom;
                        $_POST['prenom']= $user->prenom;
                        $_POST['username']= $user->username;
                        $_POST['password']= $user->password;
                        $_POST['action']= 'VIEW';
                        include('./Views/Profil.php');                    
                        break;
                    case 'PROFIL_SUCCESS':
                        $titre= 'Création de nouveau profil avec succées.';
                        $resultat= 'Veuillez connecter maintenant.';
                        $url= '../index.php?menu=LOGIN';
                        include('./Views/Success.php');                    
                        break;
                    case 'PROFIL_FAILED':
                        $titre= 'Oops! Échec de la création de nouveau profil.';
                        $description= 'Erreur de création de nouveau profil, Il se peut que les informations que vous avez entrées existe déja dans notre base de donnée.';
                        $resultat= 'Veuillez réessayer s\'il vous plaît...';
                        include('./Views/Failed.php');                    
                        break;
                    case 'NEW_AVIS':
                        if (isset($_GET['platId'])){
                            $platId= $_GET['platId'];
                        }
                        include('./Views/avisUser.php');                    
                        break;
                    case 'ADD_AVIS_SUCCESS':
                        $titre= 'Ajout d\'un avis d\'utilisateur avec succées.';
                        $resultat= 'Veuillez rétourner sur la liste.';
                        $url= "../index.php?menu=LIST_REPAS";
                        include('./Views/Success.php');                    
                        break;
                } 
            } else {
                include('./Views/listRepas.php');
            }
        } else if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (isset($_POST['menu'])){
                switch($_POST['menu']){
                    case 'LOGIN':
                        include('./Views/login.php');                    
                        break;
                    case 'LIST_REPAS':
                        include('./Views/listRepas.php');                    
                        break;
                    case 'NEW_PROFIL':
                        include('./Views/Profil.php');                    
                        break;
                    case 'NEW_REPAS':
                        include('./Views/repas.php');                    
                        break;
                    case 'NEW_AVIS':
                        if (isset($_POST['platId'])){
                            $platId= $_POST['platId'];
                        }
                        include('./Views/avisUser.php');                    
                        break;
                }
            }
        }       
    ?>    